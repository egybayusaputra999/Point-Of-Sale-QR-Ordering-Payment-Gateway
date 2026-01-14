<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\AntrianModel;
use App\Models\TransaksiModel;

class Antrian extends BaseController
{
    protected $menuModel;
    protected $antrianModel;
    protected $transaksiModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->antrianModel = new AntrianModel();
        $this->transaksiModel = new TransaksiModel();
    }
    public function index()
    {
        // Temporarily disable session check for debugging
        // if (!session()->get('nama')) {
        //     return redirect()->to(base_url() . "/dashboard");
        // }
        $data['url'] = $this->request->getUri();
        return view('antrian', $data);
    }

    public function dataAntrian()
    {
        echo json_encode($this->antrianModel->where("status !=", 2)->findAll());
    }

    public function dataAntrianSelesai()
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date('Y-m-d', strtotime('today')) . " 00:00:00";
        echo json_encode($this->antrianModel->where(["status" => 2, "tanggal >=" =>  $tanggal])->findAll());
    }

    public function proses()
    {
        $id = $this->request->getPost("idTransaksi");
        $status = $this->request->getPost("statusTransaksi");
        $data = ["status" => $status + 1];
        if ($status == 0) {
            $data["idUser"] = session()->get('id');
            date_default_timezone_set("Asia/Jakarta");
            $data["tanggal"] = date('Y-m-d H:i:s', strtotime('today'));
        } elseif ($status == 1) {
            // Update tanggal ketika antrian selesai (status berubah dari 1 ke 2)
            date_default_timezone_set("Asia/Jakarta");
            $data["tanggal"] = date('Y-m-d H:i:s', strtotime('today'));
            
            // Pastikan semua transaksi dengan jumlah 0 diupdate menjadi 1
            // agar muncul di laporan (karena laporan filter jumlah > 0)
            $transaksiDenganJumlahNol = $this->transaksiModel->where('idAntrian', $id)->where('jumlah', 0)->findAll();
            if (!empty($transaksiDenganJumlahNol)) {
                foreach ($transaksiDenganJumlahNol as $transaksi) {
                    $this->transaksiModel->update($transaksi['id'], ['jumlah' => 1]);
                }
            }
        }

        $this->antrianModel->update($id, $data);

        echo json_encode("");
    }

    public function rincianPesanan()
    {
        $idAntrian = $this->request->getPost("idAntrian");

        $pesanan = $this->transaksiModel->where("idAntrian", $idAntrian)->findAll();
        for ($i = 0; $i < count($pesanan); $i++) {
            $menu = $this->menuModel->where("id", $pesanan[$i]["idMenu"])->first();
            $pesanan[$i]["nama"] = $menu["nama"];
            $pesanan[$i]["harga"] = $menu["harga"];
        }
        echo json_encode($pesanan);
    }
    

}
