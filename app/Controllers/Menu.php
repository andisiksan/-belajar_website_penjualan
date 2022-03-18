<?php

namespace App\Controllers;

use App\Models\UserModel;

class Menu extends BaseController
{
    protected $BukuModel;
    protected $KategoriModel;
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        // helper('number');
    }

    public function index()
    {
        $user = $this->UserModel->where(['email' => session()->get('email')])->first();
        // kenapa get?

        $data = [
            'title' => 'My Profile',
            'user' => $user,
            'var' => 'user',
        ];
        return view('menu/index', $data);
    }
}
