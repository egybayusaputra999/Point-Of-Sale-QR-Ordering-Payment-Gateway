<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{

    protected $table = "pembelian";
    protected $primaryKey = 'id';
    protected $allowedFields = ['idMenu', 'namaMenu', 'jumlah', 'harga', 'idAntrian', 'namaAntrian', 'noMeja', 'tanggal', 'statusAntrian'];
}
