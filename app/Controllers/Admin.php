<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    protected $BukuModel;
    protected $KategoriModel;
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        // helper('number');
    }

    //     public function index()
    //     {
    //         $data = [
    //             'title' => 'hai',
    //             // 'user' => $this->UserModel->findAll(),
    //             'user' => $this->UserModel->get_where('user', ['email' =>
    //             $this->session->userdata('email')])->first(),
    //             'validation' => \Config\Services::validation()
    //         ];
    //         return view('user/admin', $data);
    //     }
    // }




    //     public function index()
    //     {

    //    $data['user'] => $this->UserModel->get_where('user', ['email' => $this->session->set('email')])->first();
    //             echo 'selamat datang'. $data['user']['name'];
    //     }
    // }

    public function index()
    {
        $user = $this->UserModel->where(['email' => session()->get('email')])->first();
        // kenapa get?

        $data = [
            'title' => 'My Profile',
            'user' => $user,
            'var' => 'user',
        ];
        return view('user/admin', $data);
    }
}
