<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\UtamaModel;

class Utama extends BaseController
{
    protected $BukuModel;
    protected $KategoriModel;
    protected $UtamaModel;

    public function __construct()
    {
        $this->BukuModel = new BukuModel();
        $this->KategoriModel = new KategoriModel();
        $this->UtamaModel = new UtamaModel();
        helper('number');
    }


    public function index()
    {
        $keyword = $this->request->getPost('kategorikeyword');

        // \var_dump($keyword);

        if ($keyword) {
            $buku = $this->BukuModel->selectkategori($keyword);
        } else {
            $buku = $this->BukuModel->selectkategori();
        }

        // \var_dump($keyword);
        $data = [

            'title' => 'Daftar Buku',
            'buku' => $buku,
            'kategori' => $this->KategoriModel->findAll()

        ];
        // \dd($data);

        // cek data base masuk/tdk
        // $buku = $this->KategoriModel->findAll();
        // \dd($buku);

        return view('utama/index', $data);
    }


    public function detailkeranjang($id_user = 2)
    {



        $data = [
            'title' => 'keranjang',
            'keranjang' => $this->UtamaModel->getKeranjang($id_user),

        ];


        return \view('/utama/keranjang', $data);
    }





    public function savekeranjang()
    {
        $id_user = $this->request->getvar('id_user');
        $id_buku = $this->request->getvar('id_buku');
        // $stok = $this->request->getvar('stok');
        $jumlahbeli = $this->request->getvar('jumlah_beli');
        $bukulama = $this->UtamaModel->getChekout($id_user, $id_buku);

        // if ($stok > 0) {



        if ($bukulama) {

            $hasiljumlah = $jumlahbeli + $bukulama['jumlah_beli'];

            $this->UtamaModel->save(
                [
                    'id_keranjang' => $bukulama['id_keranjang'],
                    'jumlah_beli' => $hasiljumlah,

                ]
            );
        } else {
            $this->UtamaModel->save(
                [
                    'jumlah_beli' => $this->request->getVar('jumlah_beli'),
                    'id_user' => $this->request->getVar('id_user'),
                    'id_buku' => $this->request->getVar('id_buku'),

                ]
            );
        }



        // $this->UtamaModel->save(
        //     [
        //         'jumlah_beli' => $this->request->getVar('jumlah_beli'),
        //         'id_user' => $this->request->getVar('id_user'),
        //         'id_buku' => $this->request->getVar('id_buku'),

        //     ]
        // );

        session()->setFlashdata('pesan', 'Data masuk ke keranjang .');
        return redirect()->to('/utama');
        // } else {

        //     return redirect()->to('/utama');
        // }
    }

    // public function chekout($id_keranjang)
    // {
    //     $data = [
    //         'title' => 'keranjang',
    //         'keranjang' => $this->UtamaModel->getChekout($id_keranjang)
    //     ];



    //     return \view('/utama/chekout', $data);
    // }



    public function cancel($id_keranjang)
    {

        $this->UtamaModel->delete($id_keranjang);

        session()->setFlashdata('pesan', 'Data berhasil di hapus .');
        // kalimat notifikasi berhasil hapus 
        return \redirect()->to('/utama/detailkeranjang');
    }
}
