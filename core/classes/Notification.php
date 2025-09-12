<?php

require_once __DIR__ . '/Database.php';

/**
 * Class for handling notification-related operations.
 * Inherits CRUD methods from the Database class.
 */

class Notification extends Database
{
    public function createNotification($article_title, $article_owner, $content, $user_id)
    {
        $sql = "INSERT INTO article_notifications (article_title, article_owner, content, user_id) VALUES (?, ?, ?, ?)";
        return $this->executeNonQuery($sql, [$article_title, $article_owner, $content, $user_id]);
    }

    public function getUserNotifications($user_id)
    {
        $sql = "SELECT
                an.notification_id,
                an.article_id,
                an.article_title,
                a.title,
                an.article_owner,
                an.content,
                an.user_id,
                spu.username,
                an.notified_at
                FROM article_notifications an
                LEFT JOIN articles a ON 
                an.article_id = a.article_id
                JOIN school_publication_users spu
                on an.user_id = spu.user_id
                WHERE an.article_owner = ?
                ORDER BY an.notified_at DESC";

        return $this->executeQuery($sql, [$user_id]);
    }

    public function getRecentUserNotifications($user_id)
    {
        $sql = "SELECT
                an.notification_id,
                an.article_id,
                an.article_title,
                a.title,
                an.article_owner,
                an.content,
                an.user_id,
                spu.username,
                spu.is_admin,
                an.notified_at
                FROM article_notifications an
                LEFT JOIN articles a ON 
                an.article_id = a.article_id
                JOIN school_publication_users spu
                on an.user_id = spu.user_id
                WHERE an.article_owner = ?
                ORDER BY an.notified_at DESC
                LIMIT 5";

        return $this->executeQuery($sql, [$user_id]);
    }
}
