<?php

namespace App\Models;

use CodeIgniter\Model;

class BarcodeModel extends Model
{
    protected $table = 'table_barcodes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'table_number',
        'barcode',
        'status',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'table_number' => 'required|integer|is_unique[table_barcodes.table_number,id,{id}]',
        'barcode' => 'required|string|is_unique[table_barcodes.barcode,id,{id}]',
        'status' => 'required|in_list[active,inactive]'
    ];
    protected $validationMessages = [
        'table_number' => [
            'required' => 'Nomor meja harus diisi',
            'integer' => 'Nomor meja harus berupa angka',
            'is_unique' => 'Nomor meja sudah ada'
        ],
        'barcode' => [
            'required' => 'Barcode harus diisi',
            'string' => 'Barcode harus berupa string',
            'is_unique' => 'Barcode sudah ada'
        ],
        'status' => [
            'required' => 'Status harus diisi',
            'in_list' => 'Status harus active atau inactive'
        ]
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Get active tables
     */
    public function getActiveTables()
    {
        return $this->where('status', 'active')->orderBy('table_number', 'ASC')->findAll();
    }

    /**
     * Get table by barcode
     */
    public function getTableByBarcode($barcode)
    {
        return $this->where('barcode', $barcode)->first();
    }

    /**
     * Check if table number exists
     */
    public function tableExists($tableNumber)
    {
        return $this->where('table_number', $tableNumber)->first() !== null;
    }

    /**
     * Get table statistics
     */
    public function getTableStats()
    {
        $total = $this->countAll();
        $active = $this->where('status', 'active')->countAllResults();
        $inactive = $this->where('status', 'inactive')->countAllResults();

        return [
            'total' => $total,
            'active' => $active,
            'inactive' => $inactive
        ];
    }
}