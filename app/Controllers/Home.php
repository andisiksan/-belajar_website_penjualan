<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\KategoriModel;

class Home extends BaseController
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
            'buku' => $this->BukuModel->getBuku(),
            'kategori' => $this->KategoriModel->findAll()

        ];

        // cek data base masuk/tdk
        // $buku = $this->KategoriModel->findAll();
        // \dd($buku);

        return view('buku/home', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Form Tambah Buku',
            'buku' => $this->BukuModel->findAll(),
            'kategori' => $this->KategoriModel->findAll(),
            'validation' => \Config\Services::validation()

        ];

        return view('buku/create', $data);
    }
    public function save()
    {
        // harus pke session() di BaseController
        // harus menentukan validation nya di create
        if (!$this->validate(
            [
                'judul' => [
                    'rules' => 'required|is_unique[buku.judul]',
                    'errors' => [
                        'required' => '{field} Buku harus diisi',
                        'is_unique' => '{field} Buku sudah ada'
                    ]
                ],
                'harga' => [
                    'rules' => 'required[buku.harga]',
                    'errors' => [
                        'required' => '{field} Buku harus diisi'
                    ]
                ],
                'stok' => [
                    'rules' => 'required|numeric[buku.jumlah_stok]',
                    'errors' => [
                        'required' => '{field} Buku harus diisi',
                        'numeric' => '{field} Harus berupa angka'
                    ]
                ],
                'sampul' => [
                    //gak boleh ada spasi
                    'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Gambar harus diisi',
                        'max_size' => 'ukuran gambar max 1024 mb',
                        'is_image' => 'file harus berupa gambar',
                        'mime-in' => 'format gambar harus berekstensi jpg,jpeg, atau png',
                    ]
                ],
                'sinopsis' => [
                    'rules' => 'required[buku.sinopsis]',
                    'errors' => [
                        'required' => '{field} Buku harus diisi'
                    ]
                ],
            ]

        )) {
            return \redirect()->to('/home/create')->withInput();
        }
        // ambil gambar
        $fileSampul = $this->request->getFile('sampul');

        // pindahkan file ke folder img 
        $fileSampul->move('img');

        // ambil nama file sampul

        $namaSampul = $fileSampul->getName();

        $this->BukuModel->save(
            [
                // 'id_buku' => $this->request->getVar('id_buku'),
                // 'id' => $this->request->getVar('$id'),
                'judul' => $this->request->getVar('judul'),
                // 'id_kategori' => $this->request->getVar('kategori'),
                'id_kategori' => $this->request->getVar('kategori'),
                'harga' => $this->request->getVar('harga'),
                'stok' => $this->request->getVar('stok'),
                'sampul' => $namaSampul,
                'sinopsis' => $this->request->getVar('sinopsis')
            ]
        );
        // kalimat notifikasi berhasil save 
        session()->setFlashdata('pesan', 'Data berhasil di tambahkan .');
        return redirect()->to('/home');
    }
    // public function update()
    // {
    // }
    // public function delete()
    // {
    // }

    public function detail($id_buku)

    {
        $data = [
            'title' => 'Detail',
            'buku' => $this->BukuModel->getBuku($id_buku),
            'kategori' => $this->KategoriModel->findAll(),


            // 'var' => 'barang'


        ];

        // \dd($data);
        if (empty($data['buku'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('judul buku ' . $id_buku . ' tidak ditemukan. ');
        }



        return view('buku/detail', $data);
    }

    public function delete($id_buku)
    {
        // cari sampul berdasarkan id
        $buku = $this->BukuModel->find($id_buku);

        // hapus sampul yang diupload dan mnghpus yg tersimpan di img
        \unlink('img/' . $buku['sampul']);

        $this->BukuModel->delete($id_buku);


        // kalimat notifikasi berhasil hapus 
        session()->setFlashdata('pesan', 'Data berhasil di hapus .');
        return \redirect()->to('/home');
    }


    public function edit($id_buku)
    {
        $data = [
            'title' => 'Form Edit Buku',
            'validation' => \Config\Services::validation(),
            'buku' => $this->BukuModel->getBuku($id_buku),
            'kategori' => $this->KategoriModel->findAll()
        ];
        return view('buku/edit', $data);
    }
    public function update($id_buku)
    {  //cek judul
        $bukulama = $this->BukuModel->getBuku($this->request->getVar('id_buku'));
        if ($bukulama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[buku.judul]';
        }

        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} buku harus diisi',
                    'is_unique' => '{field} buku sudah ada'
                ]
            ],
            'sampul' => [
                //gak boleh ada spasi
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    // 'uploaded' => 'Gambar harus diisi',
                    'max_size' => 'ukuran gambar max 1024 mb',
                    'is_image' => 'file harus berupa gambar',
                    'mime-in' => 'format gambar harus berekstensi jpg,jpeg, atau png',
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/home/edit/' . $this->request->getVar('id_buku'))->withInput()->with('validation', $validation);
            return redirect()->to('/home/edit/' . $this->request->getVar('id_buku'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');

        // cek gambar apakah tetap gambar lama
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            //generate nama file random
            $namaSampul = $fileSampul->getRandomName();

            //pindahkan gambar
            $fileSampul->move('img', $namaSampul);

            //hapus file yng lama
            \unlink('img/' . $this->request->getVar('sampulLama'));
        }

        // $id_buku = url_title($this->request->getVar('judul'), '-', true);
        $this->BukuModel->save([
            'id_buku' => $id_buku,
            'judul' => $this->request->getVar('judul'),
            'id_kategori' => $this->request->getVar('kategori'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'sampul' => $namaSampul,
            'sinopsis' => $this->request->getVar('sinopsis'),
        ]);

        // kalimat notifikasi berhasil diubah 
        session()->setFlashdata('pesan', 'Data berhasil di ubah .');

        return redirect()->to('/home');
    }
}
