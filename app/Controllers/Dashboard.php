<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\AntrianModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    protected $menuModel;
    protected $antrianModel;
    protected $transaksiModel;
    protected $userModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->antrianModel = new AntrianModel();
        $this->transaksiModel = new TransaksiModel();
        $this->userModel = new UserModel();
    }
    
    public function index()
    {
        if (session()->get('nama')) {
            return redirect()->to(base_url() . "/antrian");
        }
        $user = $this->userModel->where('hapus', NULL)->findAll();
        unset($user["password"]);
        $data = [
            "user" => $user,
            "makanan" => $this->menuModel->where(["jenis" => 1, "hapus" => NULL])->findAll(),
            "snack" => $this->menuModel->where(["jenis" => 2, "hapus" => NULL])->findAll(),
            "minumanDingin" => $this->menuModel->where(["jenis" => 3, "hapus" => NULL])->findAll(),
            "minumanPanas" => $this->menuModel->where(["jenis" => 4, "hapus" => NULL])->findAll(),
            "bestSeller" => $this->menuModel->where(["best_seller" => 1, "hapus" => NULL])->findAll(),
        ];
        return view('dashboard', $data);
    }

    public function tambahPesanan()
    {
        $nama = $this->request->getPost("nama");
        $noMeja = $this->request->getPost("noMeja");
        $pesanan = $this->request->getPost("pesanan");
        $total = $this->request->getPost("total");
        $transactionId = $this->request->getPost("transaction_id");
        $orderId = $this->request->getPost("order_id");

        // Validasi input
        if (empty($nama) || empty($noMeja) || empty($pesanan)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data tidak lengkap'
            ]);
        }

        try {
            // Insert ke tabel antrian
            $antrian = [
                "nama" => $nama,
                "noMeja" => $noMeja,
                "status" => 0, // 0 = bayar (pesanan dari dashboard belum dibayar, perlu konfirmasi bayar)
                "tanggal" => date('Y-m-d H:i:s'),
                "idUser" => session()->get('id') ?? 1
            ];

            $idAntrian = $this->antrianModel->insert($antrian);

            // Insert detail pesanan ke tabel transaksi
            $currentDateTime = date('Y-m-d H:i:s');
            foreach ($pesanan as $item) {
                $menu = [
                    "idMenu" => $item[0],  // id menu
                    "jumlah" => $item[2],  // jumlah pesanan
                    "idAntrian" => $idAntrian,
                    "tanggal" => $currentDateTime
                ];
                $this->transaksiModel->save($menu);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Pesanan berhasil ditambahkan',
                'idAntrian' => $idAntrian
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menyimpan pesanan: ' . $e->getMessage()
            ]);
        }
    }

    public function tambahPesananMeja()
    {
        $nama = $this->request->getPost("nama");
        $noMeja = $this->request->getPost("noMeja");
        $pesanan = $this->request->getPost("pesanan");
        $total = $this->request->getPost("total");
        $transactionId = $this->request->getPost("transaction_id");
        $orderId = $this->request->getPost("order_id");

        // Validasi input
        if (empty($nama) || empty($noMeja) || empty($pesanan)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data tidak lengkap'
            ]);
        }

        try {
            // Insert ke tabel antrian
            $antrian = [
                "nama" => $nama,
                "noMeja" => $noMeja,
                "status" => 1, // 1 = memasak (pesanan dari order meja sudah dibayar via payment gateway)
                "tanggal" => date('Y-m-d H:i:s'),
                "idUser" => session()->get('id') ?? 1
            ];

            $idAntrian = $this->antrianModel->insert($antrian);

            // Insert detail pesanan ke tabel transaksi
            $currentDateTime = date('Y-m-d H:i:s');
            foreach ($pesanan as $item) {
                $menu = [
                    "idMenu" => $item[0],  // id menu
                    "jumlah" => $item[2],  // jumlah pesanan
                    "idAntrian" => $idAntrian,
                    "tanggal" => $currentDateTime
                ];
                $this->transaksiModel->save($menu);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Pesanan berhasil ditambahkan',
                'idAntrian' => $idAntrian
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menyimpan pesanan: ' . $e->getMessage()
            ]);
        }
    }

    public function auth()
    {
        $usersModel = new UserModel();
        $id = $this->request->getPost('idUser');
        $password = $this->request->getPost('pass');
        $user = $usersModel->where('id', $id)->first();

        if (empty($user)) {
            echo json_encode('<span class="badge badge-danger">Username Salah :(</span>');
        } else if (password_verify($password, $user['password'])) {
            session()->set('nama', $user["nama"]);
            session()->set('rule', $user["rule"]);
            session()->set('id', $user["id"]);
            echo json_encode("");
        } else {
            echo json_encode('<span class="badge badge-danger">Password Salah :(</span>');
        }
    }

    public function logout()
    {
        session()->remove('nama');
        session()->remove('rule');
        return redirect()->to(base_url() . "/dashboard");
    }
}
