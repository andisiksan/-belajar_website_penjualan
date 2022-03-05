<?php

namespace App\Models;

use CodeIgniter\Model;

class UtamaModel extends Model
{
    protected $table = 'table_keranjang';
    protected $primaryKey = 'id_keranjang';
    protected $allowedFields = ['id_user', 'id_buku', 'jumlah_beli'];



    public function getKeranjang($id_user = false)
    {
        if ($id_user != false) {
            return $this
                ->join('buku', 'buku.id_buku=table_keranjang.id_buku')
                ->where(['id_user' => $id_user])
                ->findAll();
        }
        $data = 'user tidak ditemukan';
        return $data;
    }

    // public function getChekout($id_keranjang)
    // {
    //     return $this
    //         ->join('buku', 'buku.id_buku=table_keranjang.id_buku')
    //         ->where(['id_keranjang' => $id_keranjang])
    //         ->first();
    // }
    public function getChekout($id_user, $id_buku)
    {

        return $this
            ->where(['id_user' => $id_user, 'id_buku' => $id_buku])
            ->first();
    }
}
