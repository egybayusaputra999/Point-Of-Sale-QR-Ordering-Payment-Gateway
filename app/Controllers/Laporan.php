<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\AntrianModel;
use App\Models\MenuModel;
use App\Models\PembelianModel;

class Laporan extends BaseController
{
    protected $transaksiModel;
    protected $antrianModel;
    protected $menuModel;
    protected $pembelianModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->antrianModel = new AntrianModel();
        $this->menuModel = new MenuModel();
        $this->pembelianModel = new PembelianModel();
    }

    public function index()
    {
        if (!session()->get('nama')) {
            return redirect()->to(base_url() . "/dashboard");
        }
        return view('laporan');
    }
    

    
    public function debugData()
    {
        // Ambil semua data pembelian tanpa filter
        $semuaData = $this->pembelianModel->findAll();
        
        // Ambil data dengan filter jumlah > 0
        $dataJumlahValid = $this->pembelianModel->where(["jumlah >" => 0])->findAll();
        
        // Ambil data dalam rentang tanggal 2022
        $dataTanggal2022 = $this->pembelianModel->where([
            "tanggal >=" => "2022-01-01 00:00:00", 
            "tanggal <=" => "2022-12-31 23:59:59", 
            "jumlah >" => 0
        ])->findAll();
        
        $debugInfo = [
            'totalSemuaData' => count($semuaData),
            'totalDataJumlahValid' => count($dataJumlahValid),
            'totalDataTanggal2022' => count($dataTanggal2022),
            'contohSemuaData' => array_slice($semuaData, 0, 5),
            'contohDataJumlahValid' => array_slice($dataJumlahValid, 0, 5),
            'contohDataTanggal2022' => array_slice($dataTanggal2022, 0, 5)
        ];
        
        return $this->response->setJSON($debugInfo);
    }
    
    public function getDataPendapatanMingguan()
    {
        $tanggalMulai = $this->request->getPost('tanggalMulai');
        $tanggalSelesai = $this->request->getPost('tanggalSelesai');
        
        // Validasi tanggal
        if (empty($tanggalMulai) || empty($tanggalSelesai)) {
            return $this->response->setJSON([]);
        }
        
        $tanggalAwal = $tanggalMulai . " 00:00:00";
        $tanggalAkhir = $tanggalSelesai . " 23:59:59";
        
        // Ambil data pembelian berdasarkan rentang tanggal
        $pembelian = $this->pembelianModel->where([
            "tanggal >=" => $tanggalAwal, 
            "tanggal <=" => $tanggalAkhir, 
            "jumlah >" => 0
        ])->findAll();
        
        // Inisialisasi array untuk menyimpan pendapatan per hari
        $pendapatanPerHari = [];
        
        // Buat array tanggal dalam rentang yang dipilih
        $startDate = new \DateTime($tanggalMulai);
        $endDate = new \DateTime($tanggalSelesai);
        $interval = new \DateInterval('P1D');
        $dateRange = new \DatePeriod($startDate, $interval, $endDate->modify('+1 day'));
        
        // Inisialisasi pendapatan untuk setiap hari dengan 0
        foreach ($dateRange as $date) {
            $tanggal = $date->format('Y-m-d');
            $hari = $this->getNamaHari($date->format('N'));
            $pendapatanPerHari[$tanggal] = [
                'hari' => $hari,
                'tanggal' => $tanggal,
                'pendapatan' => 0
            ];
        }
        
        // Hitung pendapatan per hari dari data pembelian
        foreach ($pembelian as $item) {
            $tanggalTransaksi = date('Y-m-d', strtotime($item['tanggal']));
            if (isset($pendapatanPerHari[$tanggalTransaksi])) {
                $pendapatanPerHari[$tanggalTransaksi]['pendapatan'] += ($item['harga'] * $item['jumlah']);
            }
        }
        
        // Konversi ke array numerik untuk Chart.js
        $result = array_values($pendapatanPerHari);
        
        return $this->response->setJSON($result);
    }
    
    private function getNamaHari($dayNumber)
    {
        $namaHari = [
            1 => 'Senin',
            2 => 'Selasa', 
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu'
        ];
        
        return $namaHari[$dayNumber] ?? 'Unknown';
    }

    public function laporanSemua()
    {
        $tanggalMulai = $this->request->getPost('tanggalMulai');
        $tanggalSelesai = $this->request->getPost('tanggalSelesai');
        
        $tanggalAwal = $tanggalMulai . " 00:00:00";
        $tanggalAkhir = $tanggalSelesai . " 23:59:59";
        
        $pembelian = $this->pembelianModel->where([
            "tanggal >=" => $tanggalAwal, 
            "tanggal <=" => $tanggalAkhir, 
            "jumlah >" => 0
        ])->findAll();
        
        return $this->response->setJSON($pembelian);
    }

    public function laporanMenu()
    {
        // Log untuk debugging
        log_message('debug', 'laporanMenu() dipanggil');
        
        $tanggalMulai = $this->request->getPost("tanggalMulai");
        $tanggalSelesai = $this->request->getPost("tanggalSelesai");
        
        log_message('debug', 'Tanggal yang diterima: ' . $tanggalMulai . ' sampai ' . $tanggalSelesai);
        
        // Validasi tanggal
        if (empty($tanggalMulai) || empty($tanggalSelesai)) {
            log_message('error', 'Tanggal mulai atau tanggal selesai kosong');
            return $this->response->setJSON(['error' => 'Tanggal mulai atau tanggal selesai kosong']);
        }
        
        $tanggalAwal = $tanggalMulai . " 00:00:00";
        $tanggalAkhir = $tanggalSelesai . " 23:59:59";
        
        log_message('debug', 'Query dengan tanggal: ' . $tanggalAwal . ' sampai ' . $tanggalAkhir);
        
        // Ambil data pembelian
        $pembelian = $this->pembelianModel->where([
            "tanggal >=" => $tanggalAwal, 
            "tanggal <=" => $tanggalAkhir, 
            "jumlah >" => 0
        ])->findAll();
        
        log_message('debug', 'Jumlah data pembelian: ' . count($pembelian));
        
        // Jika tidak ada data, kembalikan array kosong
        if (empty($pembelian)) {
            log_message('debug', 'Tidak ada data pembelian yang ditemukan');
            return $this->response->setJSON([]);
        }
        
        // Proses data untuk laporan menu
        $dataLaporan = [];
        for ($i = 0; $i < count($pembelian); $i++) {
            $tidakAda = true;
            for ($j = 0; $j < count($dataLaporan); $j++) {
                if ($dataLaporan[$j]["id"] == $pembelian[$i]["idMenu"]) {
                    $tidakAda = false;
                    $dataLaporan[$j]["jumlah"] += $pembelian[$i]["jumlah"];
                    break;
                }
            }
            if ($tidakAda) {
                $menu = [
                    "id" => $pembelian[$i]["idMenu"],
                    "nama" => $pembelian[$i]["namaMenu"],
                    "jumlah" => $pembelian[$i]["jumlah"],
                    "harga" => $pembelian[$i]["harga"]
                ];
                array_push($dataLaporan, $menu);
            }
        }
        
        log_message('debug', 'Jumlah data laporan menu: ' . count($dataLaporan));
        
        // Gunakan response->setJSON untuk mengembalikan data dalam format JSON
        return $this->response->setJSON($dataLaporan);
    }

    public function laporanAntrian()
    {
        $tanggalMulai = $this->request->getPost("tanggalMulai") . " 00:00:00";
        $tanggalSelesai = $this->request->getPost("tanggalSelesai") . " 23:59:59";

        $pembelian = $this->pembelianModel->where(["tanggal >=" => $tanggalMulai, "tanggal <=" => $tanggalSelesai, "jumlah >" => 0])->findAll();
        $dataLaporan = [];
        for ($i = 0; $i < count($pembelian); $i++) {
            $tidakAda = true;
            for ($j = 0; $j < count($dataLaporan); $j++) {
                if ($dataLaporan[$j]["id"] == $pembelian[$i]["idAntrian"]) {
                    $tidakAda = false;
                    $dataLaporan[$j]["jumlahPesan"] += 1;
                    $dataLaporan[$j]["pembayaran"] += $pembelian[$i]["jumlah"] * $pembelian[$i]["harga"];
                    break;
                }
            }
            if ($tidakAda) {
                $menu = [
                    "id" => $pembelian[$i]["idAntrian"],
                    "nama" => $pembelian[$i]["namaAntrian"],
                    "noMeja" => $pembelian[$i]["noMeja"],
                    "jumlahPesan" => 1,
                    "pembayaran" => $pembelian[$i]["jumlah"] * $pembelian[$i]["harga"]
                ];
                array_push($dataLaporan, $menu);
            }
        }

        echo json_encode($dataLaporan);
    }


}
