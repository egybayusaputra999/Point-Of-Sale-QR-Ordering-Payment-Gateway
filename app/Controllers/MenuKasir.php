<?php

namespace App\Controllers;

use App\Models\MenuModel;

class MenuKasir extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->menuModel = new MenuModel();
    }
    
    public function index()
    {
        // Kasir (rule = 2) bisa akses halaman ini
        if (!session()->get('nama') or (session()->get('rule') != 1 and session()->get('rule') != 2)) {
            return redirect()->to(base_url() . "/dashboard");
        }
        echo view('menu_kasir');
    }
    
    public function muatData()
    {
        echo json_encode($this->menuModel->where("hapus", NULL)->findAll());
    }

    public function ubahStatus()
    {
        $this->menuModel->update($this->request->getPost("id"), ["status" => $this->request->getPost("status")]);
    }
}