<?php

namespace MvcBlog\App\Controllers;

use MvcBlog\App\Models\NewsModel;
use MvcBlog\App\Models\UserModel;
use MvcBlog\App\View;

class AdminPanelController
{
    public static function index(): string
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            return View::view('admin-panel/index', ['title' => 'Admin panel']);
        }

        return View::view('notFound', ['title' => 'Error']);
    }

    public static function showStat(): false|string
    {
        $users = new UserModel();
        $news = new NewsModel();

        $usersCount = $users->usersCount();
        $newsCount = $news->newsCount();

        $data = [
            'users' => $usersCount,
            'news' => $newsCount
        ];

        return json_encode($data);
    }
}