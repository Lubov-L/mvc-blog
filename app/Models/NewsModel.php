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

    public function newsCount()
    {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM news');
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function list(int $limit, int $offset = 0): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM news LIMIT :limit OFFSET :offset');
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($news === false) {
            return null;
        }

        return $news;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM news WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return false;
        }

        return true;
    }
}