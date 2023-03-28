<?php

namespace App\Controllers;
use App\Models\UserModel;
use Myth\Auth\Models\PermissionModel;
use App\Models\UserPermissionModel;

use CodeIgniter\RESTful\ResourceController;

class UserPermission extends ResourceController
{
    
    public function index($id_user = null)
    {
        $modelPermission = new PermissionModel();
        $modelUser = new UserModel();
        $modelUserPermission = new UserPermissionModel();
        $user = $modelUser->find($id_user);
        $permission = $modelPermission->findAll();
        $userpermission = $modelUserPermission
        ->select('ap.id,ap.name, ap.description,auth_users_permissions.permission_id,auth_users_permissions.user_id')
        ->join('auth_permissions ap', 'auth_users_permissions.permission_id = ap.id','LEFT')
        ->where('auth_users_permissions.user_id', $id_user)
        ->findAll();
        $data = [
            
            'user' => $userpermission ,
            'id_user'=>$id_user,
            'permission'=>$permission,
            'nama_user' => $user->name
        ];
        return view('user/user_permission/index', $data);
    }

    
    public function show($id = null)
    {
        //
    }

    
    public function new()
    {
        if ($this->request->isAJAX()) {

            $modelPermission = new PermissionModel();
            $modelUser = new UserModel();
            $permission = $modelPermission->findAll();

            $data = [
                'id_user'      => $this->request->getPost('id'),
                'permission'   => $permission,
            ];

            $json = [
                'data'          => view('user/user_permission/add', $data),
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
                'permission'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'permission harus diisi',
                    ]
                ]
            ];

            if (!$this->validate($validasi)) {
                $validation = \Config\Services::validation();

                $error = [
                    'error_permission' => $validation->getError('permission'),
                ];

                $json = [
                    'error' => $error
                ];
            }
            else {
                $modelPermission = new PermissionModel();
                $modelUser = new UserModel();
                $modelUserPermission = new UserPermissionModel();
                $data = [
                    'permission_id' => $this->request->getPost('permission'),
                    'user_id' => $this->request->getPost('user_id'),
                ];
                $modelUserPermission->save($data);

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

    
    public function delete($permission_id = null,$user_id = null)
    {
        $modelUserPermission = new UserPermissionModel();

        $modelUserPermission->where(['permission_id' => $permission_id, 'user_id' => $user_id])->delete();
    
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->back();
    }

}
