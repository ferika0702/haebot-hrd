<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\GroupModel;
use App\Models\GroupUserModel;


use CodeIgniter\RESTful\ResourceController;

class ListGroup extends ResourceController
{
    
    public function index($id_user = null)
    {
        $modelUser = new UserModel();
        $modelGroup = new GroupModel();
        $modelGroupUser = new GroupUserModel();
        
        
        $groupuser = $modelGroupUser
        ->select('auth_groups_users.group_id, auth_groups.name, auth_groups.description')
        ->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id')
        ->join('users', 'users.id = auth_groups_users.user_id')
        ->where('auth_groups_users.user_id', $id_user)
        ->findAll();      
        $data = [
            'user' => $groupuser
        ];
        return view('user/group/index', $data);
        
    }

    
    public function show($id = null)
    {
        //
    }

    
    public function new()
    {
        if ($this->request->isAJAX()) {

            $modelUser = new UserModel();
            $modelGroup = new GroupModel();
            $user = $modelUser->findAll();
            $group = $modelGroup->findAll();

            $data = [
                'user'        => $user,
                'group'        => $group,
            ];

            $json = [
                'data'          => view('user/group/add', $data),
            ];

            echo json_encode($json);
        } else {
            return 'Tidak bisa load';
        }
    }

    
    public function create()
    {
        if ($this->request->isAJAX()) {
            $modelUser = new UserModel();
            $modelGroup = new GroupModel();
            $modelGroupUser = new GroupUserModel();

            $validasi = [
                'group'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'group harus diisi',
                    ]
                ],
                'user'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'user harus diisi',
                    ]
                ]
            ];

            if (!$this->validate($validasi)) {
                $validation = \Config\Services::validation();

                $error = [
                    'error_group_id' => $validation->getError('group_id'),
                    'error_user_id' => $validation->getError('user_id'),
                ];

                $json = [
                    'error' => $error
                ];
            }
            else {
                $data = [
                    'group_id' => $this->request->getPost('group'),
                    'user_id' => $this->request->getPost('user'),
                ];
                $modelGroupUser->save($data);
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
        //
    }
}
