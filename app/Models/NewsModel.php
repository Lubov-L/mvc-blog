<?php

namespace MvcBlog\App\Models;

use PDO;

class NewsModel extends Model
{
    public function crateNews($title, $content): void
    {
        $query = $this->pdo->prepare('INSERT INTO News (title, content)
                    VALUES (:title, :content)');

        $query->execute(['title' => $title, 'content' => $content]);
    }

    public function list(): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM news');

        $stmt->execute();

        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($news === false) {
            return null;
        }

        return $news;
    }
}