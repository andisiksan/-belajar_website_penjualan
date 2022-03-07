<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\KategoriModel;

class Auth extends BaseController
{
    protected $BukuModel;
    protected $KategoriModel;

    public function __construct()
    {
        $this->BukuModel = new BukuModel();
        $this->KategoriModel = new KategoriModel();
        helper('number');
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }
    public function register()
    {
        $data = [
            'title' => 'Register',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/register', $data);
    }
}
