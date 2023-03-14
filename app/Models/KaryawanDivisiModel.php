<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanDivisiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'karyawan_divisi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_karyawan','id_divisi'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getKaryawanDivisi(){
        $data =  $this->db->table($this->table)
        ->select('karyawan.id_divisi,karyawan.nama_lengkap, karyawan.jabatan, karyawan.pendidikan, karyawan.no_telp, karyawan.email')
        ->join('karyawan_divisi', 'karyawan_divisi.id_karyawan = karyawan.id_divisi')
        ->where('karyawan_divisi.id_divisi', $id_divisi)
        ->get(); 

        return $data;
    }

    public function getKaryawanByDivisi($id_divisi) {
        $query = $this->db->table('karyawan')
            ->select('nama_lengkap, jabatan, pendidikan, no_telp, email')
            ->join('karyawan_divisi', 'karyawan_divisi.id_karyawan = karyawan.id')
            ->where('karyawan_divisi.id_divisi', $id_divisi)
            ->get();
    
        return $query->getResultArray();
    }
}
