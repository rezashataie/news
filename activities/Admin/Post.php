<?php

namespace Admin;

use database\DataBase;

class Post extends Admin
{

    public function index()
    {
        $db = new DataBase();
        $posts = $db->select('SELECT posts.*, users.username AS user, categories.name AS category FROM ((posts INNER JOIN users ON posts.user_id = users.id) INNER JOIN categories ON posts.cat_id = categories.id) ORDER BY posts.id DESC');
        require_once(BASE_PATH . '/template/admin/posts/index.php');
    }

    public function create()
    {
        $db = new DataBase();
        $categories = $db->select('SELECT * FROM categories ORDER BY `id` DESC');
        require_once(BASE_PATH . '/template/admin/posts/create.php');
    }

    public function store($request)
    {
        $realTimestamp = substr($request['published_at'], 0, 10);
        $request['published_at'] = date('Y-m-d H:i:s', (int) $realTimestamp);
        $db = new DataBase();
        if ($request['cat_id'] != null) {
            $request['image'] = $this->saveImage($request['image'], 'post-image');
            if ($request['image']) {
                $request = array_merge($request, ['user_id' => 1]);
                $db->insert('posts', array_keys($request), $request);
                $this->redirect('admin/post');
            } else {
                dd('hi-1');
                $this->redirect('admin/post');
            }
        } else {
            dd('hi-2');
            $this->redirect('admin/post');
        }
    }

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
