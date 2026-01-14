<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarcodeModel;

class Barcode extends BaseController
{
    protected $barcodeModel;

    public function __construct()
    {
        $this->barcodeModel = new BarcodeModel();
    }

    public function index()
    {
        // Check if user is logged in
        if (!session()->get('nama')) {
            return redirect()->to('/dashboard');
        }

        // Check if user is admin
        if (session()->get('rule') != 1) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'barcodes' => $this->barcodeModel->findAll()
        ];

        return view('barcode', $data);
    }

    public function generate()
    {
        // Check if user is logged in and is admin
        if (!session()->get('nama') || session()->get('rule') != 1) {
            return redirect()->to('/dashboard');
        }

        // Generate 15 tables with unique barcodes
        for ($i = 1; $i <= 15; $i++) {
            $barcodeData = [
                'table_number' => $i,
                'barcode' => 'MEJA' . str_pad($i, 2, '0', STR_PAD_LEFT) . '_' . uniqid(),
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Check if table already exists
            $existing = $this->barcodeModel->where('table_number', $i)->first();
            if (!$existing) {
                $this->barcodeModel->insert($barcodeData);
            }
        }

        session()->setFlashdata('success', 'Barcode untuk 15 meja berhasil dibuat!');
        return redirect()->to('/dashboard/barcode');
    }

    public function regenerate($id)
    {
        // Check if user is logged in and is admin
        if (!session()->get('nama') || session()->get('rule') != 1) {
            return redirect()->to('/dashboard');
        }

        $barcode = $this->barcodeModel->find($id);
        if ($barcode) {
            $newBarcodeData = [
                'barcode' => 'MEJA' . str_pad($barcode['table_number'], 2, '0', STR_PAD_LEFT) . '_' . uniqid(),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->barcodeModel->update($id, $newBarcodeData);
            session()->setFlashdata('success', 'Barcode meja ' . $barcode['table_number'] . ' berhasil diperbarui!');
        }

        return redirect()->to('/dashboard/barcode');
    }

    public function toggleStatus($id)
    {
        // Check if user is logged in and is admin
        if (!session()->get('nama') || session()->get('rule') != 1) {
            return redirect()->to('/dashboard');
        }

        $barcode = $this->barcodeModel->find($id);
        if ($barcode) {
            $newStatus = $barcode['status'] == 'active' ? 'inactive' : 'active';
            $this->barcodeModel->update($id, [
                'status' => $newStatus,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            session()->setFlashdata('success', 'Status meja ' . $barcode['table_number'] . ' berhasil diubah!');
        }

        return redirect()->to('/dashboard/barcode');
    }

    public function order($barcode)
    {
        // Public access for customers to scan barcode and order
        $barcodeData = $this->barcodeModel->where('barcode', $barcode)->where('status', 'active')->first();
        
        if (!$barcodeData) {
            // Debug: log the barcode being searched
            log_message('error', 'Barcode not found or inactive: ' . $barcode);
            return view('errors/html/error_404');
        }

        // Get menu items for ordering (including out of stock items)
        $menuModel = new \App\Models\MenuModel();
        $menuItems = $menuModel->where('hapus', null)->findAll();
        
        // Get best seller items (including out of stock items)
        $bestSeller = $menuModel->where(['best_seller' => 1, 'hapus' => null])->findAll();

        $data = [
            'table' => $barcodeData,
            'barcode' => $barcode,
            'menu_items' => $menuItems,
            'bestSeller' => $bestSeller
        ];

        return view('order', $data);
    }

    public function submitOrder()
    {
        // Handle order submission from customers
        $json = $this->request->getJSON();
        
        if (!$json) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak valid'
            ]);
        }

        // Validate barcode
        $barcodeData = $this->barcodeModel->where('barcode', $json->table_barcode)->where('status', 'active')->first();
        if (!$barcodeData) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Meja tidak valid atau tidak aktif'
            ]);
        }

        // Here you can save the order to database
        // For now, we'll just return success
        // You can implement order saving logic based on your existing order system
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Pesanan berhasil dikirim!',
            'order_id' => uniqid('ORDER_')
        ]);
    }

    public function tambahPesanan()
    {
        $request = service('request');
        
        // Validasi input
        $nama = $request->getPost('nama');
        $noMeja = $request->getPost('noMeja');
        $pesanan = $request->getPost('pesanan');
        
        if (empty($nama) || empty($noMeja) || empty($pesanan)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data tidak lengkap'
            ]);
        }
        
        try {
            $db = \Config\Database::connect();
            
            // Mulai transaksi
            $db->transStart();
            
            // Insert ke tabel antrian
            $antrianModel = new \App\Models\AntrianModel();
            $dataAntrian = [
                'nama' => $nama,
                'noMeja' => $noMeja,
                'status' => 0, // 0 = menunggu
                'tanggal' => date('Y-m-d H:i:s'),
                'idUser' => 1 // Default user untuk pesanan dari barcode (menggunakan user ID yang valid)
            ];
            
            $antrianModel->insert($dataAntrian);
            $idAntrian = $antrianModel->getInsertID();
            
            // Insert ke tabel transaksi untuk setiap item pesanan
            $transaksiModel = new \App\Models\TransaksiModel();
            $currentDateTime = date('Y-m-d H:i:s');
            
            // Pesanan dalam format array [id, nama, jumlah, harga]
            foreach ($pesanan as $item) {
                $dataTransaksi = [
                    'idAntrian' => $idAntrian,
                    'idMenu' => $item[0], // id menu
                    'jumlah' => $item[2],  // jumlah
                    'tanggal' => $currentDateTime
                ];
                
                $transaksiModel->insert($dataTransaksi);
            }
            
            // Selesaikan transaksi
            $db->transComplete();
            
            if ($db->transStatus() === false) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal menyimpan pesanan'
                ]);
            }
            
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Pesanan berhasil disimpan',
                'id_antrian' => $idAntrian
            ]);
            
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}