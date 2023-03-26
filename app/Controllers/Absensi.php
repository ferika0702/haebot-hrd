<?php

namespace App\Controllers;
use App\Models\AbsensiModel;
use App\Models\KaryawanModel;

use CodeIgniter\RESTful\ResourceController;

class Absensi extends ResourceController
{

    public function index()
    {
        $modelKaryawan = new KaryawanModel();
        $modelAbsensi = new AbsensiModel();
        $absensi = $modelAbsensi
            ->select('karyawan.nama_lengkap, karyawan.id as id_karyawan, absensi.*')
            ->join('karyawan', 'karyawan.id = absensi.karyawan_id')
            ->findAll();
        $data = [
            'absensi' => $absensi,
        ];
        return view('absensi/index', $data);
        // var_dump(json_encode($data));
    }

    
    public function show($id = null)
    {
        if ($this->request->isAJAX()) {
            $modelKaryawan = new KaryawanModel();
            $modelAbsensi = new AbsensiModel();
            $karyawan = $modelKaryawan->findAll();
            $absensi      = $modelAbsensi->find($id);

            $data = [
                'absensi' => $absensi,
                'karyawan' => $karyawan
            ];

            $json = [
                'data'   => view('absensi/show', $data),
            ];

            echo json_encode($json);
        } else {
            return 'Tidak bisa load data';
        }
    }


    public function new()
    {
        if ($this->request->isAJAX()) {

            $modelAbsensi = new AbsensiModel();
            $modelKaryawan = new KaryawanModel();
            $karyawan = $modelKaryawan->findAll();
            $absensi = $modelAbsensi->findAll();

            $data = [
                'absensi'        => $karyawan,
            ];

            $json = [
                'data'          => view('absensi/add', $data),
            ];

            echo json_encode($json);
        } else {
            return 'Tidak bisa load';
        }
    }

   
    public function create()
    {
        if ($this->request->isAJAX()) {

            $validasi = [
                'tanggal'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'tanggal harus diisi',
                    ]
                ],
                'nama_lengkap'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'nama lengkap harus diisi',
                    ]
                ],
                'status'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'status harus diisi',
                    ]
                ],
                
            ];

            if (!$this->validate($validasi)) {
                $validation = \Config\Services::validation();

                $error = [
                    'error_nama_lengkap' => $validation->getError('nama_lengkap'),
                    'error_tanggal' => $validation->getError('tanggal'),
                    'error_status' => $validation->getError('status'),
                ];

                $json = [
                    'error' => $error
                ];
            } else {
                // $modelKaryawan = new KaryawanModel();
                $modelAbsensi = new AbsensiModel();
                $data = [
                    'tanggal'       => $this->request->getPost('tanggal'),
                    'karyawan_id'   => $this->request->getPost('nama_lengkap'),
                    'masuk1'        => $this->request->getPost('masuk1'),
                    'masuk2'        => $this->request->getPost('masuk2'),
                    'masuk3'        => $this->request->getPost('masuk3'),
                    'keluar1'       => $this->request->getPost('keluar1'),
                    'keluar2'       => $this->request->getPost('keluar2'),
                    'keluar3'       => $this->request->getPost('keluar3'),
                    'total_menit'   => $this->request->getPost('total_menit'),
                    'status'        => $this->request->getPost('status'),
                ];
                $modelAbsensi->save($data);
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
        if ($this->request->isAJAX()) {
            $modelKaryawan = new KaryawanModel();
            $modelAbsensi = new AbsensiModel();
            $karyawan      = $modelKaryawan->findAll();
            $absensi    = $modelAbsensi->find($id);

            $data = [
                'karyawan' => $karyawan,
                'absensi' => $absensi
            ];
            $json = [
                'data' => view('absensi/edit', $data),
            ];

            echo json_encode($json);
        } else {
            return 'Tidak bisa load';
        }
    }

    
    public function update($id = null)
    {
        if ($this->request->isAJAX()) {

            $validasi = [
                'tanggal'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'tanggal harus diisi',
                    ]
                ],
                'status'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'status harus diisi',
                    ]
                ],
                
            ];

            if (!$this->validate($validasi)) {
                $validation = \Config\Services::validation();

                $error = [
                    
                    'error_tanggal' => $validation->getError('tanggal'),
                    'error_status' => $validation->getError('status'),
                ];

                $json = [
                    'error' => $error
                ];
            } else {
                $modelKaryawan = new KaryawanModel();
                $modelAbsensi = new AbsensiModel();

                $data = [
                    'id' => $id,
                    'tanggal' => $this->request->getPost('tanggal'),
                    'masuk1' => $this->request->getPost('masuk1'),
                    'masuk2' => $this->request->getPost('masuk2'),
                    'masuk3' => $this->request->getPost('masuk3'),
                    'keluar1' => $this->request->getPost('keluar1'),
                    'keluar2' => $this->request->getPost('keluar2'),
                    'keluar3' => $this->request->getPost('keluar3'),
                    'total_menit' => $this->request->getPost('total_menit'),
                    'status' => $this->request->getPost('status'),
                    'keterangan' => $this->request->getPost('keterangan'),
                ];
                $modelAbsensi->save($data);
                $json = [
                    'success' => 'Berhasil update data absensi'
                ];
            }
            echo json_encode($json);
        } else {
            return 'Tidak bisa load';
        }
    }

    
    public function delete($id = null)
    {
        $modelAbsensi = new AbsensiModel();
        $modelAbsensi->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/absensi');
    }
}
