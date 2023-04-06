<?php

namespace App\Models;

use CodeIgniter\Model;

class LogAbsenModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'log_absen';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_absen','log_time','log_date','keterangan'
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

    public function getTotalMinutes($id_karyawan_absen) {
        $this->builder()
            ->select('log_absen.*,karyawan_absen.id as absen_id')
            ->join('karyawan_absen', 'log_absen.id_absen=karyawan_absen.id')
            ->where('log_absen.id_absen',$id_karyawan_absen);
        $log = $this->builder()->get()->getResultArray();
        $total_minutes = 0;
        $time_out = 0;
        foreach ($log as $row) {
            if ($row['keterangan'] == 'Masuk') {
                $time_in = strtotime($row['log_time']);
            } else if ($row['keterangan'] == 'Pulang') {
                $time_out = strtotime($row['log_time']);
                $diff_minutes = round(($time_out - $time_in) / 60);
                $total_minutes += $diff_minutes;
            } else if ($row['keterangan'] == 'Lembur') {
                $lembur_time = strtotime($row['log_time']);
                $diff_minutes = round(($lembur_time - $time_out) / 60);
                $total_minutes += $diff_minutes;
                $time_out = $lembur_time;
            }
        }
        return $total_minutes;
    }

}
