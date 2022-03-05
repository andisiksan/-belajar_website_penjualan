<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'table_kategori';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = ['id_kategori', 'nama_kategori', 'warna'];


    public function getKategori($id_kategori = false)
    {
        if ($id_kategori == false) {
            return $this
                ->join('buku', 'buku.id_buku=table_kategori.id_buku')
                ->findAll();
        }
        return $this->where(['id_kategori' => $id_kategori])->first();
    }


    // public function getKategori()
    // {
    //     return $this

    //         ->join('table_status', 'table_status.id_status = table_barang.id_status')
    //         ->findAll();
    // }
}
