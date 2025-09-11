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
     * Retrieves all articles from the database.
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

    /**
     * Retrieves approved articles (active or inactive) from the database.
     * @return array
     */
    public function getApprovedArticles()
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
                WHERE status IN ('active', 'inactive') ORDER BY articles.created_at DESC";

        return $this->executeQuery($sql);
    }

    /**
     * Retrieves active articles from the database.
     * @return array
     */
    public function getActiveArticles()
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
                WHERE status = 'active' ORDER BY articles.created_at DESC";

        return $this->executeQuery($sql);
    }

    /**
     * Retrieves articles published by a specific user from the database.
     * @return array
     */
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
     * Creates a share request to an article.
     * @param int $article_id The article ID to create request to.
     * @param int $requested_by The author who requests to edit an article.
     * @return int The result of the action.
     */
    public function requestAccess($article_id, $requested_by)
    {
        $sql = "INSERT INTO shared_articles (article_id, requested_by) VALUES (?, ?)";
        return $this->executeNonQuery($sql, [$article_id, $requested_by]);
    }

    /**
     * Gets the share requests of an author.
     * @param int $author_id The author ID of the articles to retreive.
     * @return array
     */
    public function getArticleRequests($author_id)
    {
        $sql = "SELECT 
                    sa.share_id,
                    a.article_id,
                    a.title,
                    a.content,
                    a.author_id,
                    au.username AS author_username,
                    au.is_admin AS author_is_admin,
                    a.status AS article_status,
                    sa.requested_by,
                    ru.username AS requester_username,
                    ru.is_admin AS requester_is_admin,
                    sa.status AS share_status,
                    a.created_at,
                    sa.requested_at
                FROM shared_articles sa
                JOIN articles a 
                    ON a.article_id = sa.article_id
                JOIN school_publication_users au 
                    ON a.author_id = au.user_id
                JOIN school_publication_users ru 
                    ON sa.requested_by = ru.user_id
                WHERE a.author_id = ? AND
                sa.status IN ('pending', 'rejected')
                ORDER BY sa.requested_at DESC;";
        return $this->executeQuery($sql, [$author_id]);
    }

    /**
     * Gets the share request of an article.
     * @param int $article_id The article ID of the article.
     * @param int $requested_by The user ID of the requester.
     * @return bool
     */
    public function doesShareRequestExist($article_id, $requested_by)
    {
        $sql = "SELECT 1 
            FROM shared_articles 
            WHERE article_id = ? AND requested_by = ? 
            LIMIT 1";
        $result = $this->executeQuery($sql, [$article_id, $requested_by]);

        return !empty($result);
    }


    public function updateShareStatus($id, $status)
    {
        $sql = "UPDATE shared_articles
                SET status = ? WHERE share_id = ?";
        return $this->executeNonQuery($sql, [$status, $id]);
    }

    public function getSharedArticles($user_id)
    {
        $sql = "SELECT 
                    sa.share_id,
                    a.article_id,
                    a.title,
                    a.content,
                    a.author_id,
                    au.username AS author_username,
                    au.is_admin AS author_is_admin,
                    a.status AS article_status,
                    sa.requested_by,
                    ru.username AS requester_username,
                    ru.is_admin AS requester_is_admin,
                    sa.status AS share_status,
                    a.created_at,
                    sa.requested_at
                FROM shared_articles sa
                JOIN articles a 
                    ON a.article_id = sa.article_id
                JOIN school_publication_users au 
                    ON a.author_id = au.user_id
                JOIN school_publication_users ru 
                    ON sa.requested_by = ru.user_id
                WHERE sa.requested_by = ? AND
                sa.status = 'accepted'
                ORDER BY sa.requested_at DESC;";
        return $this->executeQuery($sql, [$user_id]);
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
