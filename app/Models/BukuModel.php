<?php


namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table      = 'buku';
    protected $primaryKey = 'id_buku';

    // protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_buku', 'id_kategori', 'judul', 'slug', 'sampul', 'harga', 'aksi', 'sinopsis', 'stok', 'sampul'];

    protected $useTimestamps = true;

    // public function detail($id_buku)
    // {
    //     return $this->where(['id_buku' => $id_buku])->first();
    // }

    public function getBuku($id_buku = false)
    {
        if ($id_buku == false) {
            return $this
                ->join('table_kategori', 'table_kategori.id_kategori=buku.id_kategori')
                ->findAll();
        }
        return $this->where(['id_buku' => $id_buku])->first();
    }

    public function selectkategori($kategori = false)
    {
        if ($kategori == false) {
            return $this
                ->findAll();
        }

        //
        return $this
            ->like('id_kategori', $kategori)
            ->findAll();

        // return $this->findAll();
    }



    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;
}
