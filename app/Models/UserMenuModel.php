<?php

namespace App\Models;

use CodeIgniter\Model;

class UserMenuModel extends Model
{
    protected $table = 'user_menu';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'menu'];


    public function getMenu($id = false)
    {
        if ($id == false) {
            return $this
                ->join('user_access_menu', 'user_access_menu.menu_id=user_menu.id')
                ->findAll();
        }
        return $this->where(['id' => $id])->first();
    }


    // public function getKategori()
    // {
    //     return $this

    //         ->join('table_status', 'table_status.id_status = table_barang.id_status')
    //         ->findAll();
    // }
}
