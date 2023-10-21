<?php

namespace MvcBlog\App\Controllers;

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
}