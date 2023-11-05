<?php

namespace MvcBlog\App\Models;

class NewsModel extends Model
{
    public function crateNews($title, $content, $publication_date): void
    {
        $query = $this->pdo->prepare('INSERT INTO News (title, content, publication_date)
                    VALUES (:title, :content, :publication_date)');

        $query->execute(['title' => $title, 'content' => $content, 'publication_date' => $publication_date]);
    }
}