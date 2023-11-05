<?php

namespace Admin;

use database\DataBase;

class Post extends Admin
{

    public function index()
    {
        $db = new DataBase();
        $posts = $db->select('SELECT * FROM posts ORDER BY `id` DESC');
        require_once(BASE_PATH . '/template/admin/posts/index.php');
    }

    public function create()
    {
        require_once(BASE_PATH . '/template/admin/posts/create.php');
    }

    // public function store($request)
    // {
    //     $db = new DataBase();
    //     $db->insert('posts', array_keys($request), $request);
    //     $this->redirect('admin/post');
    // }

    // public function edit($id)
    // {
    //     $db = new DataBase();
    //     $post = $db->select('SELECT * FROM posts WHERE id = ?;', [$id])->fetch();
    //     require_once(BASE_PATH . '/template/admin/posts/edit.php');
    // }

    // public function update($request, $id)
    // {
    //     $db = new DataBase();
    //     $db->update('posts', $id, array_keys($request), $request);
    //     $this->redirect('admin/post');
    // }

    // public function delete($id)
    // {
    //     $db = new DataBase();
    //     $db->delete('posts', $id);
    //     $this->redirect('admin/post');
    // }
}
