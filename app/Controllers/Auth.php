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
                    // 'rules' => 'required|is_unique[user.name]',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        // 'is_unique' => '{field} sudah ada'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[user.email]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'valid_email' => 'harus berupa Email',
                        'is_unique' => '{field} sudah ada'
                    ]
                ],
                'password1' => [
                    'rules' => 'required',
                    'errors' => [
                        "required" => 'password harus diisi'
                    ]
                ],
                'password2' => [
                    'rules' => 'required|matches[password1]',
                    'errors' => [
                        'required' => 'Ulangi Password harus diisi',
                        'matches' => '{field} harus sama dengan password'
                    ]
                ]
            ]
        )) {
            return redirect()->to('auth/register')->withInput();
        }

        $this->UserModel->save(
            [
                // 'name' => htmlspecialchars($this->request->getVar('name')),
                // 'email' => htmlspecialchars($this->request->getVar('email')),
                //menambahkan true agar menghindari serangan xss
                // Cross site scripting ini sering digunakan untuk mencuri session cookies, 
                // yang memungkinkan penyerang untuk menyamar sebagai korban. Dengan cara inilah
                // , peretas bisa mengetahui data-data sensitif milik korban.

                // Perlu Anda ketahui, serangan cross site scripting disingkat menjadi XSS
                'name' => htmlspecialchars($this->request->getVar('name', true)),
                'email' => htmlspecialchars($this->request->getVar('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->request->getVar('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1

            ]
        );
        // kalimat notifikasi berhasil save 
        // session()->setFlashdata('pesan', 'kamu berhasil di tambahkan .');
        session()->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Selamat! Akun anda telah terdaftar. Silahkan login');

        return redirect()->to('/auth');
    }

    public function login()
    {
        if (!$this->validate(
            [
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field}  harus diisi',
                        'valid_email' => 'harus berupa Email,'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
            ]
        )) {
            return redirect()->to('auth/index')->withInput();
        }
        // KETIKA VALIDASI SUKSES
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->UserModel->where(['email' => $email])->first();

        // user ada
        if ($user) {

            // jika user aktiv
            if ($user['is_active'] == 1) {

                // cek password
                // if (password_verify($password, $user['password'])) 
                // { yang artinya $password diambil dri inputan
                // dan $user ['paswword] dari database

                if (password_verify($password, $user['password'])) {
                    $data = [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'image' => $user['image'],
                        'role_id' => $user['role_id']
                    ];


                    // session()->set($data);berfungsi sebagai variabel yang 
                    // dmana dpat diakses disemua halaman

                    session()->set($data);

                    return redirect()->to('/admin/index');
                } else {
                    session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Worng password!');
                    return redirect()->to('/auth');
                }
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">This Email has not been activated!');

                return redirect()->to('/auth');
            }
        } else {

            session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Email is not registered!');

            return redirect()->to('/auth');
        }
    }

    public function logout()
    {

        // remove sama seperti unset

        session()->remove('email');
        session()->remove('role_id');


        session()->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">anda berhasil keluar');

        return redirect()->to('/auth');
    }
}
