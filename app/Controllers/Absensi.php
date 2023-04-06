<?php

namespace App\Controllers;
use App\Models\AbsensiModel;
use App\Models\KaryawanModel;

use CodeIgniter\RESTful\ResourceController;

class Absensi extends ResourceController
{

    public function index()
    {
        return view('absensi/index');
    }

    public function viewAbsensi(){
        $modelKaryawan = new KaryawanModel();
        $karyawan = $modelKaryawan->findAll();

        $data = [
            'karyawan' => $karyawan
        ];

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
