<?php

namespace App\Controllers;

use App\Models\CustomerRekeningModel;
use CodeIgniter\RESTful\ResourcePresenter;

class CustomerRekening extends ResourcePresenter
{
    public function index()
    {
        //
    }


    public function show($id = null)
    {
        //
    }


    public function new()
    {
        //
    }


    public function create()
    {
        $modelCustomerRekening = new CustomerRekeningModel();
        $id_customer = $this->request->getPost('id_customer');

        $data = [
            'id_customer'   => $this->request->getPost('id_customer'),
            'nama'          => $this->request->getPost('nama'),
            'no_rekening'   => $this->request->getPost('no_rekening'),
        ];
        $modelCustomerRekening->save($data);

        session()->setFlashdata('pesan', 'Rekening Baru berhasil ditambahkan.');

        return redirect()->to('/customer/' . $id_customer . '/edit');
    }


    public function edit($id = null)
    {
        //
    }


    public function update($id = null)
    {
        //
    }


    public function remove($id = null)
    {
        //
    }


    public function delete($id = null)
    {
        $id_customer = $this->request->getPost('id_customer');

        $modelCustomerRekening = new CustomerRekeningModel();

        $modelCustomerRekening->delete($id);

        session()->setFlashdata('pesan', 'Rekening berhasil dihapus.');
        return redirect()->to('/customer/' . $id_customer . '/edit');
    }
}
