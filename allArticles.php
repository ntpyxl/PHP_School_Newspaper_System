<?php
require_once __DIR__ . '/core/classloader.php';
require_once __DIR__ . "/core/helperFunctions.php"; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Articles - School Publication</title>

    <link href="core/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>

<body class="font-sans bg-gray-50 text-gray-800">
    <?php include 'components/navbar.php'; ?>

    <div class="max-w-7xl mx-auto px-4">
        <h1 class="m-1 p-3 text-4xl font-bold text-center">
            <i class="fa-solid fa-newspaper"></i> Articles
        </h1>

        <div class="flex justify-center">
            <div class="w-full md:w-2/3">
                <?php
                $articles = $articleObj->getApprovedArticles();
                foreach ($articles as $article) { ?>
                    <div class="my-3 p-5 rounded-lg bg-white shadow">
                        <div class="flex justify-between items-center">
                            <h2 class="mb-2 text-2xl font-bold"><?php echo $article['title']; ?></h2>

                            <?php
                            $isLoggedIn = $userObj->isLoggedIn();
                            $isUserTheAuthor = $_SESSION['user_id'] == $article['author_id'];
                            $isRequestAlreadyExist = $articleObj->doesShareRequestExist($article['article_id'], $_SESSION['user_id']);

                            if ($isLoggedIn && !$isUserTheAuthor && !$isRequestAlreadyExist) {
                            ?>
                                <button
                                    data-article-id="<?php echo $article['article_id']; ?>"
                                    data-requested-by="<?php echo $_SESSION['user_id']; ?>"
                                    class="requestShareArticleButton px-2 py-1 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition cursor-pointer">
                                    Request Edit
                                </button>
                            <?php } ?>
                        </div>

                        <p class="block text-gray-600 text-sm">
                            Published by

                            <?php if ($article['is_admin'] == 1) { ?>
                                <span class="px-1 rounded-md bg-blue-600 text-white text-xs">Admin</span>
                            <?php } elseif ($article['is_admin'] == 0) { ?>
                                <span class="px-1 rounded-md bg-green-600 text-white text-xs">Writer</span>
                            <?php } ?>

                            <span class="font-bold"><?php echo $article['username'] ?></span>

                            on <?php echo date("F j, Y g:i A", strtotime($article['created_at'])); ?>
                        </p>

                        <?php list($previewContent, $fullContent) = limit_words($article['content'], 96); ?>
                        <div class="article-preview space-y-2">
                            <p class="text-gray-700 whitespace-pre-line short-content">
                                <?php echo $previewContent; ?>
                            </p>

                            <p class="text-gray-700 whitespace-pre-line full-content hidden">
                                <?php echo $fullContent; ?>
                            </p>

                            <?php if ($previewContent !== $fullContent) { ?>
                                <button class="toggleContent text-green-600 font-medium hover:underline cursor-pointer">
                                    Read more →
                                </button>
                            <?php } ?>
                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="my-4 py-4 flex flex-col items-center space-y-2">
        <h2 class="text-4xl font-bold text-center">
            Would you like to contribute?
        </h2>

        <div class="py-3 flex space-x-4">
            <button
                onclick="window.location.href='register.php'"
                class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition cursor-pointer">
                <i class="fa-solid fa-user-plus"></i> Register
            </button>
            <button
                onclick="window.location.href='login.php'"
                class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition cursor-pointer">
                <i class="fa-solid fa-door-open"></i> Log In
            </button>
        </div>

    </div>

    <footer class="flex flex-col px-32 py-6 items-center justify-center bg-green-800 text-white text-center space-y-2">
        <div class="text-2xl font-semibold">
            School Publication
        </div>
    </footer>

    <script src="core/scripts/articleExpander.js"></script>
    <script src="core/scripts/articleSharing.js"></script>

</body>

</html>