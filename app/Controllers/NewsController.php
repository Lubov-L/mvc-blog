<?php

namespace MvcBlog\App\Controllers;

use MvcBlog\App\Models\NewsModel;
use MvcBlog\App\View;

class NewsController
{
    public static function index(): string
    {
        $admin = false;

        if (isset($_SESSION['role'])) {
            $admin = $_SESSION['role'] === 'admin';
        }

        return View::view('news', ['title' => 'News', 'admin' => $admin]);
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
        $limit = 5;
        $page = (int)($_GET['page'] ?? 1);
        $offset = $limit * ($page - 1);

        $newsModel = new NewsModel();
        $news = $newsModel->list($limit, $offset);

        $data = [
            'news' => $news,
            'count' => $newsModel->newsCount(),
            'countPage' => (int)ceil($newsModel->newsCount() / $limit)
        ];

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public static function delete(): false|string
    {
        $body = file_get_contents('php://input');

        $requestData = json_decode($body, true);

        if ($requestData === null) {
            return json_encode(['success' => false, 'error' => 'Invalid JSON data']);
        }

        $newsId = $requestData["id"];
        $newsModel = new NewsModel();

        $result = $newsModel->delete($newsId);

        return json_encode(['success' => $result]);
    }
}