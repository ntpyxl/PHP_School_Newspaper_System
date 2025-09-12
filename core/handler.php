<?php
require_once __DIR__ . '/classloader.php';

if (isset($_POST['insertNewUserBtn'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);
    $is_admin = $_POST['role'];
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['message'] = "Please make sure there are no empty input fields";
        $_SESSION['status'] = '400';
        header("Location: ../register.php");
        exit;
    }

    if ($password != $confirm_password) {
        $_SESSION['message'] = "Please make sure both passwords are equal";
        $_SESSION['status'] = '400';
        header("Location: ../register.php");
        exit;
    }

    if ($userObj->usernameExists($username)) {
        $_SESSION['message'] = $username . " as username is already taken";
        $_SESSION['status'] = '400';
        header("Location: ../register.php");
        exit;
    }

    if ($userObj->registerUser($username, $email, $password, $is_admin)) {
        header("Location: ../login.php");
        exit;
    } else {
        $_SESSION['message'] = "An error occured with the query!";
        $_SESSION['status'] = '400';
        header("Location: ../register.php");
        exit;
    }
}

if (isset($_POST['loginUserBtn'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $_SESSION['message'] = "Please make sure there are no empty input fields";
        $_SESSION['status'] = '400';
        header("Location: ../login.php");
        exit;
    }

    if ($userObj->loginUser($email, $password)) {
        header("Location: ../dashboard/");
        exit;
    } else {
        $_SESSION['message'] = "Username/password invalid";
        $_SESSION['status'] = "400";
        header("Location: ../login.php");
        exit;
    }
}

if (isset($_GET['logoutUserBtn'])) {
    $userObj->logout();
    header("Location: ../index.php");
}

if (isset($_POST['insertArticleBtn'])) {
    $title = $_POST['title'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    $author_id = $_SESSION['user_id'];

    if ($articleObj->createArticle($title, $image, $description, $author_id)) {
        header("Location: ../dashboard/");
        exit;
    }
}

if (isset($_POST['editArticleBtn'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $article_id = $_POST['article_id'];
    $return_to = $_POST['return_to'] ?? '';


    if ($articleObj->updateArticle($article_id, $title, $content)) {
        if ($return_to === '') {
            header("Location: ../dashboard/");
        } else {
            header("Location: ../dashboard/" . $return_to . ".php");
        }
        exit;
    }
}

if (isset($_POST['deleteArticleBtn'])) {
    $article_id = $_POST['article_id'];

    echo $articleObj->deleteArticle($article_id);
}

if (isset($_POST['updateArticleVisibility'])) {
    $article_id = $_POST['article_id'];
    $status = $_POST['status'];

    echo $articleObj->updateArticleVisibility($article_id, $status);
}

if (isset($_POST['deleteArticleButton'])) {
    $article_id = $_POST['article_id'];
    $user_id = $_SESSION['user_id'];

    if ($articleObj->deleteArticle($article_id)) {
        header("Location: ../dashboard/");
        exit;
    }
}

if (isset($_POST['isDeletedByAdmin']) && $_POST['isDeletedByAdmin'] == 1) {
    $article_title = $_POST['article_title'];
    $article_owner = $_POST['article_owner'];
    $user_id = $_SESSION['user_id'];

    $notificationObj->createNotification($article_title, $article_owner, "deleted", $user_id);
}



if (isset($_POST['requestShareArticle'])) {
    $article_id = $_POST['article_id'];
    $requested_by = $_POST['requested_by'];

    echo ($articleObj->requestAccess($article_id, $requested_by));
}

if (isset($_POST['editShareStatusRequest'])) {
    $share_id = $_POST['share_id'];
    $share_status = $_POST['share_status'];

    echo $articleObj->updateShareStatus($share_id, $share_status);
}
