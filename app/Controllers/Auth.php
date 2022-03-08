<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $BukuModel;
    protected $KategoriModel;
    protected $UserModel;

    public function __construct()
    {
        $this->BukuModel = new BukuModel();
        $this->KategoriModel = new KategoriModel();
        $this->UserModel = new UserModel();
        // helper('number');
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
            'user' => $this->UserModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }
    public function register()
    {
        $data = [
            'title' => 'Register',
            'user' => $this->UserModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('auth/register', $data);
    }

    public function save()
    {

        if (!$this->validate(
            [
                'name' => [
                    'rules' => 'required|is_unique[user.name]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'is_unique' => '{field} sudah ada'
                    ]
                ],
                'email' => [
                    'rules' => 'required[user.email]',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
                'password1' => [
                    'rules' => 'required',
                    'errors' => [
                        "required" => '{field} harus diisi'
                    ]
                ],
                'password2' => [
                    'rules' => 'required|matches[password1]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'matches' => '{field} harus sama dengan password'
                    ]
                ]
            ]
        )) {
            return redirect()->to('auth/register')->withInput();
        }

        $this->UserModel->save(
            [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password1'),

            ]
        );
        // kalimat notifikasi berhasil save 
        session()->setFlashdata('pesan', 'kamu berhasil di tambahkan .');
        return redirect()->to('auth/index');
    }

    public function login()
    {
        if (!$this->validate(
            [
                'email' => [
                    'rules' => 'required|matches[user.email]',
                    'errors' => [
                        'required' => '{field}  harus diisi',
                        'matches' => '{field} kamu tidak terdaftar'
                    ]
                ],
                'password' => [
                    'rules' => 'required[buku.harga]',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
            ]
        )) {
            return redirect()->to('auth/index')->withInput();
        }
    }
}
