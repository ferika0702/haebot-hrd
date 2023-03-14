<?php

namespace App\Controllers;
use App\Models\KaryawanModel;
use App\Models\DivisiModel;
use App\Models\KaryawanDivisiModel;
use \Hermawan\DataTables\DataTable;
use CodeIgniter\RESTful\ResourceController;


class DivisiList extends ResourceController
{


    public function index($id_divisi = null)
    {
        $modelKaryawan = new KaryawanModel();
        $modelDivisi = new DivisiModel();
        $karyawan = $modelKaryawan
        ->select('karyawan.id_divisi,karyawan.id,karyawan.nama_lengkap, karyawan.jabatan, karyawan.pendidikan, karyawan.no_telp, karyawan.email')
        ->join('karyawan_divisi', 'karyawan_divisi.id_karyawan = karyawan.id')
        ->where('karyawan_divisi.id_divisi', $id_divisi)
        ->findAll();        
        $data = [
            'karyawan' => $karyawan
        ];
        return view('divisi/list/index', $data);
    }


    public function show($id = null)
    {
    if ($this->request->isAJAX()) {
        $modelKaryawan = new KaryawanModel();
        $modelDivisi = new DivisiModel();
        $karyawan      = $modelKaryawan->find($id);

        $data = [
            'karyawan' => $karyawan,
        ];
        $json = [
            'data' => view('divisi/list/show', $data),
        ];

        echo json_encode($json);
    } else {
        return 'Tidak bisa load';
    }
    }

    
    public function new()
    {
        if ($this->request->isAJAX()) {

            $modelKaryawan = new KaryawanModel();
            $modelDivisi = new DivisiModel();
            $karyawan = $modelKaryawan->findAll();
            $divisi = $modelDivisi->findAll();

            $data = [
                'karyawan'        => $karyawan,
                'divisi'        => $divisi,
            ];

            $json = [
                'data'          => view('divisi/list/add', $data),
            ];

            echo json_encode($json);
        } else {
            return 'Tidak bisa load';
        }
    }

    
    public function create()
    {
        if ($this->request->isAJAX()) {
            $modelKaryawan = new KaryawanModel();
            $modelDivisi = new DivisiModel();
            $modelKaryawanDivisi = new KaryawanDivisiModel();

            $validasi = [
                'karyawan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'karyawan harus diisi',
                    ]
                ],
                'divisi'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'divisi lengkap harus diisi',
                    ]
                ],
            ];

            if (!$this->validate($validasi)) {
                $validation = \Config\Services::validation();

                $error = [
                    'error_karyawan' => $validation->getError('karyawan'),
                    'error_divisi' => $validation->getError('divisi'),
                ];

                $json = [
                    'error' => $error
                ];
            }
            else {
                $data = [
                    'id_divisi' => $this->request->getPost('divisi'),
                    'id_karyawan' => $this->request->getPost('karyawan'),
                ];
                $modelKaryawanDivisi->save($data);
                $json = [
                    'success' => 'Berhasil menambah data karyawan'
                ];
                
            }
            echo json_encode($json);
                } else {
                    return 'Tidak bisa load';
                }
    }
    
    
    public function edit($id = null)
    {
        //
    }

    
    public function update($id = null)
    {
        //
    }

    
    public function delete($id = null)
    {
        $modelKaryawanDivisi = new KaryawanDivisiModel();

        $modelKaryawanDivisi->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/divisi');
    }
    
}
