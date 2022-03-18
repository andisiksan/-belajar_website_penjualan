<?php

namespace App\Models;

use CodeIgniter\Model;

class SubMenuModel extends Model
{
    protected $table = 'user_sub_menu';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'menu_id', 'title', 'url', 'icon', 'is_active'];
}
