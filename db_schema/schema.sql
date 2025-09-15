CREATE TABLE school_publication_users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE articles (
    article_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category_id INT NOT NULL DEFAULT '0',
    image_url TEXT,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    status ENUM('pending', 'active', 'inactive', 'rejected') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES school_publication_users(user_id) ON DELETE CASCADE
);

CREATE TABLE shared_articles (
    share_id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    requested_by INT NOT NULL,
    status ENUM('pending', 'accepted', 'rejected') NOT NULL DEFAULT 'pending',
    requested_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE article_notifications (
    notification_id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT,
    article_title TEXT,
    article_owner INT NOT NULL,
    content TEXT NOT NULL,
    user_id INT NOT NULL,
    notified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE article_category (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(128)
);