<?php

namespace MvcBlog\App\Controllers;

use Exception;
use MvcBlog\App\Models\NewsModel;
use MvcBlog\App\View;

class NewsController
{
    public static function index(): string
    {
        return View::view('news', ['title' => 'News']);
    }

    /**
     * Создание новости
     */
    public static function createNews(): string
    {
        try {
            $news = new NewsModel();

            var_dump($_POST); die();
            $news->crateNews($_POST);
        } catch (Exception) {
            return View::view('errors', ['error' => 'Error creating news']);
        }
        // Редирект на страницу news
        header('Location: /news');
        die();
    }
}