<?php

namespace MvcBlog\App\Models;

use Exception;
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
        $stmt = $this->pdo->prepare('SELECT * FROM news 
                                         ORDER BY publication_date DESC
                                         LIMIT :limit OFFSET :offset');
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

    public function show(int $id): array|bool
    {
        $stmt = $this->pdo->prepare('SELECT id, title, content FROM news WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function edit($id, $title, $content): false|string
    {
        try {
            $stmt = $this->pdo->prepare('UPDATE news 
                                     SET title = :title, content = :content
                                     WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $result = $stmt->execute();

            if ($result) {
                return json_encode(['success' => true, 'message' => 'News is updated successfully']);
            } else {
                return json_encode(['success' => false, 'message' => 'Error updating news']);
            }

        } catch (Exception) {
            return json_encode(['success' => false, 'message' => 'Error updating news']);
        }
    }
}