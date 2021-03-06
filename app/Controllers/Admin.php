<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SubMenuModel;
use App\Models\UserMenuModel;

class Admin extends BaseController
{
    protected $BukuModel;
    protected $KategoriModel;
    protected $UserModel;
    protected $SubMenuModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->SubMenuModel = new SubMenuModel();
        $this->UserMenuModel = new UserMenuModel();
        // helper('number');
    }

    public function index()
    {
        $user = $this->UserModel->where(['email' => session()->get('email')])->first();

        // kenapa get?


        $submenu = $this->SubMenuModel->findAll();
        $data = [
            'title' => 'My Profile',
            'user' => $user,
            'var' => 'user',
            'submenu' => $submenu,
            'usermenu' => $this->UserMenuModel->getMenu(),

        ];
        // dd($data);
        return view('user/admin', $data);
    }
}
