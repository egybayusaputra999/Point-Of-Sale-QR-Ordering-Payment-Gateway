<?php

namespace App\Controllers;

use App\Models\MenuModel;

class MenuKaryawan extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }

    public function index()
    {
        // Karyawan (rule = 0) dan Kasir (rule = 2) yang bisa mengakses
        if (!session()->get('nama') || (session()->get('rule') != 0 && session()->get('rule') != 2)) {
            return redirect()->to(base_url() . "/dashboard");
        }
        return view('menu_karyawan');
    }

    public function muatData()
    {
        // Clear any output buffer
        if (ob_get_level()) {
            ob_clean();
        }
        
        // Karyawan (rule = 0) dan Kasir (rule = 2) yang bisa mengakses
        if (session()->get('rule') != 0 && session()->get('rule') != 2) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }
        
        $data = $this->menuModel->where("hapus", NULL)->findAll();
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function ubahStatus()
    {
        // Clear any output buffer
        if (ob_get_level()) {
            ob_clean();
        }
        
        // Karyawan (rule = 0) dan Kasir (rule = 2) yang bisa mengubah status
        if (session()->get('rule') != 0 && session()->get('rule') != 2) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Unauthorized']);
            exit;
        }

        $id = $this->request->getPost("id");
        $status = $this->request->getPost("status");
        
        if ($id && ($status == '0' || $status == '1')) {
            try {
                $this->menuModel->update($id, ["status" => $status]);
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Status berhasil diubah']);
                exit;
            } catch (\Exception $e) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Gagal mengubah status: ' . $e->getMessage()]);
                exit;
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Data tidak valid']);
            exit;
        }
    }
}