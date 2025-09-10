<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/User.php';

/**
 * Class for handling Article-related operations.
 * Inherits CRUD methods from the Database class.
 */

class Article extends Database
{
    /**
     * Creates a new article.
     * @param string $title The article title.
     * @param string $content The article content.
     * @param int $author_id The ID of the author.
     * @return int The ID of the newly created article.
     */
    public function createArticle($title, $content, $author_id)
    {
        $sql = "INSERT INTO articles (title, content, author_id) VALUES (?, ?, ?)";
        return $this->executeNonQuery($sql, [$title, $content, $author_id]);
    }

    /**
     * Retrieves articles from the database.
     * @param int|null $id The article ID to retrieve, or null for all articles.
     * @return array
     */
    public function getArticles($id = null)
    {
        if ($id) {
            $sql = "SELECT * FROM articles WHERE article_id = ?";
            return $this->executeQuerySingle($sql, [$id]);
        }
        $sql = "SELECT
                articles.article_id,
                articles.title,
                articles.content,
                articles.author_id,
                school_publication_users.username,
                school_publication_users.is_admin,
                articles.status,
                articles.created_at
                FROM articles 
                JOIN school_publication_users ON 
                articles.author_id = school_publication_users.user_id 
                ORDER BY articles.created_at DESC";

        return $this->executeQuery($sql);
    }

    public function getActiveArticles($id = null)
    {
        if ($id) { // TODO: Remove this, use to another func
            $sql = "SELECT * FROM articles WHERE article_id = ?";
            return $this->executeQuerySingle($sql, [$id]);
        }
        $sql = "SELECT
                articles.article_id,
                articles.title,
                articles.content,
                articles.author_id,
                school_publication_users.username,
                school_publication_users.is_admin,
                articles.status,
                articles.created_at
                FROM articles 
                JOIN school_publication_users ON 
                articles.author_id = school_publication_users.user_id 
                WHERE status = 'active' ORDER BY articles.created_at DESC";

        return $this->executeQuery($sql);
    }


    public function getArticlesByUserID($user_id)
    {
        $sql = "SELECT 
                articles.article_id,
                articles.title,
                articles.content,
                articles.author_id,
                school_publication_users.username,
                school_publication_users.is_admin,
                articles.status,
                articles.created_at
                FROM articles 
                JOIN school_publication_users ON 
                articles.author_id = school_publication_users.user_id
                WHERE author_id = ? ORDER BY articles.created_at DESC";
        return $this->executeQuery($sql, [$user_id]);
    }

    /**
     * Updates an article.
     * @param int $id The article ID to update.
     * @param string $title The new title.
     * @param string $content The new content.
     * @return int The number of affected rows.
     */
    public function updateArticle($id, $title, $content)
    {
        $sql = "UPDATE articles SET title = ?, content = ? WHERE article_id = ?";
        return $this->executeNonQuery($sql, [$title, $content, $id]);
    }

    /**
     * Changes the visibility status of an article.
     * This operation is restricted to admin users only.
     * @param int $id The article ID to update.
     * @param string $status The new visibility status.
     * @return int The number of affected rows.
     */
    public function updateArticleVisibility($id, $status)
    {
        $userModel = new User();
        if (!$userModel->isAdmin()) {
            return 0;
        }
        $sql = "UPDATE articles SET status = ? WHERE article_id = ?";
        return $this->executeNonQuery($sql, [$status, $id]);
    }


    /**
     * Deletes an article.
     * @param int $id The article ID to delete.
     * @return int The number of affected rows.
     */
    public function deleteArticle($id)
    {
        $sql = "DELETE FROM articles WHERE article_id = ?";
        return $this->executeNonQuery($sql, [$id]);
    }
}
