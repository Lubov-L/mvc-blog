<?php

namespace MvcBlog\App\Controllers;

use MvcBlog\App\Models\NewsModel;
use MvcBlog\App\View;

class NewsController
{
    public static function index(): string
    {
        $isAdmin = false;

        if (isset($_SESSION['role'])) {
            $isAdmin = $_SESSION['role'] === 'admin';
        }

        return View::view('news', ['title' => 'News', 'isAdmin' => $isAdmin]);
    }

    /**
     * Создание новости
     */
    public static function create(): string
    {
        $body = file_get_contents('php://input');

        $requestData = json_decode($body, true);

        if ($requestData === null) {
            return json_encode(['success' => false, 'error' => 'Invalid JSON data']);
        }

        if (empty($requestData["title"]) || empty($requestData["content"])) {
            return json_encode(['success' => false, 'error' => 'Title and content must not be empty']);
        }

        $news = new NewsModel();
        $news->crateNews($requestData["title"], $requestData["content"]);

        return json_encode(['success' => true]);
    }

    public static function list(): false|string
    {
        $news = new NewsModel();
        $news = $news->list();

        $data = [
            'news' => $news
        ];

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}