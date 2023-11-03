<?php

namespace Admin;

use database\DataBase;

class Category extends Admin
{

    public function index()
    {
        $db = new DataBase();
        $categories = $db->select('SELECT * FROM categories ORDER BY `id` DESC');
        require_once(BASE_PATH . '/template/admin/categories/index.php');
    }
}
