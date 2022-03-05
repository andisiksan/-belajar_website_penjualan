<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\KategoriModel;

class Kategori extends BaseController
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

            'title' => 'Daftar Buku',
            'buku' => $this->BukuModel->findAll(),
            'kategori' => $this->KategoriModel->findAll()

        ];

        // cek data base masuk/tdk
        // $buku = $this->KategoriModel->findAll();
        // \dd($buku);

        return view('kategori/index', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Form Tambah Kategori',
            'buku' => $this->BukuModel->findAll(),
            'kategori' => $this->KategoriModel->findAll(),
            'validation' => \Config\Services::validation()

        ];

        return view('kategori/create', $data);
    }

    public function delete($id_kategori)
    {
        // cari sampul berdasarkan id
        // $kategori = $this->KategoriModel->find($id_kategori);

        // hapus sampul yang diupload dan mnghpus yg tersimpan di img
        // \unlink('img/' . $kategori['sampul']);

        $this->KategoriModel->delete($id_kategori);


        // kalimat notifikasi berhasil hapus 
        session()->setFlashdata('pesan', 'Data berhasil di hapus .');
        return \redirect()->to('/home');
    }

    public function save()
    {
        // harus pke session() di BaseController
        // harus menentukan validation nya di create
        if (!$this->validate(
            [
                'nama_kategori' => [
                    'rules' => 'required[kategori.judul]',
                    'errors' => [
                        'required' => '{field} Buku harus diisi',
                        // 'is_unique' => '{field} Buku sudah ada'
                    ]
                ],
                // 'sampul_kategori' => [
                //     //gak boleh ada spasi
                //     'rules' => 'uploaded[sampul_kategori]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                //     'errors' => [
                //         'uploaded' => 'Gambar harus diisi',
                //         'max_size' => 'ukuran gambar max 1024 mb',
                //         'is_image' => 'file harus berupa gambar',
                //         'mime-in' => 'format gambar harus berekstensi jpg,jpeg, atau png',
                //     ]
                // ],
            ]

        )) {
            return \redirect()->to('/kategori/create')->withInput();
        }
        // ambil gambar
        // $fileSampul = $this->request->getFile('sampul_kategori');

        // pindahkan file ke folder img 
        // $fileSampul->move('img');

        // ambil nama file sampul

        // $namaSampul = $fileSampul->getName();

        $this->KategoriModel->save(
            [
                // 'id_buku' => $this->request->getVar('id_buku'),
                // 'id' => $this->request->getVar('$id'),
                'nama_kategori' => $this->request->getVar('nama_kategori'),
                'sampul_kategori' => $this->request->getVar('sampul_kategori'),
                // 'sampul_kategori' => $namaSampul,

            ]
        );
        // kalimat notifikasi berhasil save 
        session()->setFlashdata('pesan', 'Data berhasil di tambahkan .');
        return redirect()->to('/kategori');
    }
}
