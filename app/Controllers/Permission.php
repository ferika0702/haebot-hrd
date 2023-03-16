<?php

namespace App\Controllers;
use App\Models\GroupModel;
use App\Models\PermissionModel;
use App\Models\GroupPermissionModel;

use CodeIgniter\RESTful\ResourceController;

class Permission extends ResourceController
{
    
    public function index($id_permission = null)
    {
        $modelPermission = new PermissionModel();
        $modelGroup = new GroupModel();
        $modelGroupPermsission = new GroupPermissionModel();
    
        $grouppermission = $modelGroupPermsission
        ->select('auth_groups_permissions.group_id, auth_groups.name, auth_groups.description')
        ->join('auth_groups', 'auth_groups_permissions.group_id = auth_groups.id')
        ->join('auth_permissions', 'auth_permissions.id = auth_groups_permissions.permission_id')
        ->where('auth_groups_permissions.permission_id', $id_permission)
        ->findAll();      
        $data = [
            'permission' => $grouppermission
        ];
        return view('user/permission/index', $data);
        
    }

    
    public function show($id = null)
    {
        //
    }

    
    public function new()
    {
        if ($this->request->isAJAX()) {

            $modelPermission = new PermissionModel();
            $modelGroup = new GroupModel();
            $permission = $modelPermission->findAll();
            $group = $modelGroup->findAll();

            $data = [
                'permission'        => $permission,
                'group'        => $group,
            ];

            $json = [
                'data'          => view('user/permission/add', $data),
            ];

            echo json_encode($json);
        } else {
            return 'Tidak bisa load';
        }
    }

    
    public function create()
    {
        if ($this->request->isAJAX()) {
            $modelPermission = new PermissionModel();
            $modelGroup = new GroupModel();
            $modelGroupPermission = new GroupPermissionModel();

            $validasi = [
                'group'  => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' => 'group harus diisi',
                    ]
                ],
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
                    'error_group_id' => $validation->getError('group_id'),
                    'error_permission_id' => $validation->getError('permission_id'),
                ];

                $json = [
                    'error' => $error
                ];
            }
            else {
                $data = [
                    'group_id' => $this->request->getPost('group'),
                    'permission_id' => $this->request->getPost('permission'),
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
