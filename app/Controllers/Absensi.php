<?php

namespace App\Controllers;
use App\Models\AbsensiModel;
use App\Models\KaryawanModel;
use App\Models\KaryawanAbsenModel;

use CodeIgniter\RESTful\ResourceController;

class Absensi extends ResourceController
{

    public function index()
    {
        return view('absensi/index');
    }


    public function viewAbsensi()
    {
        $modelKaryawan = new KaryawanModel();
        $modelKaryawanAbsen = new KaryawanAbsenModel();
        
        // Mengambil data bulan dan tahun dari form filter tanggal
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');

        // dd($bulan,$tahun);
        $karyawan = $modelKaryawan
            ->select('karyawan.*')
            ->findAll();
        $data = [];
        foreach ($karyawan as $row) {
            // Menambahkan kondisi bulan dan tahun pada pemanggilan method total_menit
            $total_menit = $modelKaryawanAbsen->total_menit($row['id'], $bulan, $tahun);
            $row['total_menit'] = $total_menit;
            $data['karyawan'][] = $row;
        }

        return view('absensi/v_absensi', $data);
    }

    public function viewLaporan(){
        return view('absensi/v_laporan');
    }

    
    public function show($id = null)
    {
    
    }


    public function new()
    {
        
    }

   
    public function create()
    {
        
    }


    public function edit($id = null)
    {
        
    }

    
    public function update($id = null)
    {
        
    }

    
    public function delete($id = null)
    {

    }
}
