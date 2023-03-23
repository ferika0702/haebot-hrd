<?php

namespace App\Controllers;
use App\Models\CalonKaryawanModel;
use CodeIgniter\RESTful\ResourceController;

class Rekrutmen extends ResourceController
{

    public function index()
    {
        $modelCalonKaryawan = new CalonKaryawanModel();
        $calonkaryawan = $modelCalonKaryawan->findAll();

        $data = [
            'karyawan' => $calonkaryawan
        ];

        return view('rekrutmen/index',$data);
    }


    public function show($id = null)
    {
        if ($this->request->isAJAX()) {
            $modelCalonKaryawan = new CalonKaryawanModel();
            $calonkaryawan = $modelCalonKaryawan->find($id);

            $data = [
                'karyawan' => $calonkaryawan,
            ];
            $json = [
                'data' => view('rekrutmen/show', $data),
            ];

            echo json_encode($json);
        } else {
            return 'Tidak bisa load';
        }
    }

    
    public function new()
    {
        if ($this->request->isAJAX()) {

            $modelCalonKaryawan = new CalonKaryawanModel();
            $calonkaryawan = $modelCalonKaryawan->findAll();

            $data = [
                'karyawan'        => $calonkaryawan,
            ];

            $json = [
                'data'          => view('rekrutmen/add', $data),
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
                'nik'  => [
                    'rules'     => 'required|is_unique[karyawan.nik]',
                    'errors'    => [
                        'required' => 'nik harus diisi',
                    ]
                ],
                'nama'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'nama lengkap harus diisi',
                    ]
                ],
                'alamat'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'alamat harus diisi',
                    ]
                ],
                'jenis_kelamin'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'jenis kelamin harus diisi',
                    ]
                ],
                'tempat_lahir'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'tempat lahir harus diisi',
                    ]
                ],
                'tanggal_lahir'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'tanggal lahir harus diisi',
                    ]
                ],
                'agama'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'agama harus diisi',
                    ]
                ],
                'pendidikan'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'pendidikan harus diisi',
                    ]
                ],
                'no_telp'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'no telepon harus diisi',
                    ]
                ],
                'email'  => [
                    'rules'     => 'required|valid_email|is_unique[karyawan.email]',
                    'errors'    => [
                        'required' => 'email harus diisi',
                    ]
                ],
            ];

            if (!$this->validate($validasi)) {
                $validation = \Config\Services::validation();

                $error = [
                    'error_nik' => $validation->getError('nik'),
                    'error_nama' => $validation->getError('nama'),
                    'error_alamat' => $validation->getError('alamat'),
                    'error_jenis_kelamin' => $validation->getError('jenis_kelamin'),
                    'error_tempat_lahir' => $validation->getError('tempat_lahir'),
                    'error_tanggal_lahir' => $validation->getError('tanggal_lahir'),
                    'error_agama' => $validation->getError('agama'),
                    'error_pendidikan' => $validation->getError('pendidikan'),
                    'error_no_telp' => $validation->getError('no_telp'),
                    'error_email' => $validation->getError('email'),
                ];

                $json = [
                    'error' => $error
                ];
            } else {
                $modelCalonKaryawan = new CalonKaryawanModel();

                $data = [
                    'nik' => $this->request->getPost('nik'),
                    'nama' => $this->request->getPost('nama'),
                    'alamat' => $this->request->getPost('alamat'),
                    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                    'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                    'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                    'agama' => $this->request->getPost('agama'),
                    'pendidikan' => $this->request->getPost('pendidikan'),
                    'no_telp' => $this->request->getPost('no_telp'),
                    'email' => $this->request->getPost('email'),
                ];
                $modelCalonKaryawan->save($data);
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
            $modelCalonKaryawan = new CalonKaryawanModel();
            $karyawan      = $modelCalonKaryawan->find($id);

            $data = [
                'karyawan' => $karyawan,
            ];
            $json = [
                'data' => view('rekrutmen/edit', $data),
            ];

            echo json_encode($json);
        } else {
            return 'Tidak bisa load';
        }
    }

    
    public function update($id = null)
    {
        $validasi = [
            'nik'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'nik harus diisi',
                ]
            ],
            'nama'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'nama lengkap harus diisi',
                ]
            ],
            'alamat'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'alamat harus diisi',
                ]
            ],
            'jenis_kelamin'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'jenis kelamin harus diisi',
                ]
            ],
            'tempat_lahir'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'tempat lahir harus diisi',
                ]
            ],
            'tanggal_lahir'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'tanggal lahir harus diisi',
                ]
            ],
            'agama'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'agama harus diisi',
                ]
            ],
            'pendidikan'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'pendidikan harus diisi',
                ]
            ],
            'no_telp'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'no telepon harus diisi',
                ]
            ],
            'email'  => [
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'email harus diisi',
                ]
            ],
        ];

        if (!$this->validate($validasi)) {
            $validation = \Config\Services::validation();

            $error = [
                'error_nik' => $validation->getError('nik'),
                'error_nama' => $validation->getError('nama'),
                'error_alamat' => $validation->getError('alamat'),
                'error_jenis_kelamin' => $validation->getError('jenis_kelamin'),
                'error_tempat_lahir' => $validation->getError('tempat_lahir'),
                'error_tanggal_lahir' => $validation->getError('tanggal_lahir'),
                'error_agama' => $validation->getError('agama'),
                'error_pendidikan' => $validation->getError('pendidikan'),
                'error_no_telp' => $validation->getError('no_telp'),
                'error_email' => $validation->getError('email'),
            ];

            $json = [
                'error' => $error
            ];
        } else {
            $modelCalonKaryawan = new CalonKaryawanModel();

            $data = [
                'id' => $id,
                'nik' => $this->request->getPost('nik'),
                'nama' => $this->request->getPost('nama'),
                'alamat' => $this->request->getPost('alamat'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'agama' => $this->request->getPost('agama'),
                'pendidikan' => $this->request->getPost('pendidikan'),
                'no_telp' => $this->request->getPost('no_telp'),
                'email' => $this->request->getPost('email'),
            ];
            $modelCalonKaryawan->save($data);

            $json = [
                'success' => 'Berhasil Update data karyawan'
            ];
        }
        echo json_encode($json);
    }

    
    public function delete($id = null)
    {
        $modelCalonKaryawan = new CalonKaryawanModel();


        $modelCalonKaryawan->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->back();
    }


}
