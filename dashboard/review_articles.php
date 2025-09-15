<?php require_once __DIR__ . '/../core/classloader.php'; ?>

<?php
if (!$userObj->isLoggedIn()) {
    header("Location: ../login.php");
}

if (!$userObj->isAdmin()) {
    header("Location: ../dashboard");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Review Articles - School Publication</title>

    <link href="../core/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>

<body class="bg-gray-50 font-sans">
    <?php include __DIR__ . '/../components/navbar.php'; ?>

    <div class="mx-auto px-16 py-3">
        <h1 class="py-3 text-3xl font-bold">
            Hello there <span class="text-green-600 font-semibold"><?php echo $_SESSION['username']; ?></span>!
            Here are the articles for you to <span class="text-green-600">review</span>!
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-4 mt-3 gap-8">
            <div class="md:col-span-1 space-y-6">
                <?php include __DIR__ . '/../components/dashboardNavbar.php'; ?>
            </div>

            <div class="md:col-span-3 space-y-6">
                <?php
                $articles = $articleObj->getArticles();
                foreach ($articles as $article) {
                ?>
                    <div
                        data-article-title="<?php echo $article['title']; ?>"
                        data-article-category-name="<?php echo $article['category_name']; ?>"
                        data-article-image-url="<?php echo $article['image_url']; ?>"
                        data-article-content="<?php echo $article['content']; ?>"
                        data-author-username="<?php echo $article['username']; ?>"
                        data-is-admin="<?php echo $article['is_admin']; ?>"
                        data-created-at="<?php echo date("F j, Y g:i A", strtotime($article['created_at'])); ?>"
                        class="bg-white shadow-md rounded-lg p-6 articleCard cursor-pointer">
                        <h2 class="text-xl font-semibold flex items-center space-x-2">
                            <span class="px-2 py-0.5 text-xs font-medium text-indigo-700 bg-indigo-100 rounded">
                                <?php echo $article['category_name']; ?>
                            </span>
                            <span><?php echo $article['title']; ?></span>
                        </h2>

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

                        <?php
                        $articleStatus = $article['status'];
                        $statusTextColor = "";
                        if ($articleStatus == "pending" || $articleStatus == "inactive") {
                            $statusTextColor = "text-teal-600";
                        } else if ($articleStatus == "rejected" || $articleStatus == "removed") {
                            $statusTextColor = "text-red-600";
                        } else if ($articleStatus == "active") {
                            $statusTextColor = "text-green-600";
                        }
                        ?>
                        <p class="<?php echo $statusTextColor; ?> font-medium mt-2">
                            Status: <?php echo strtoupper($articleStatus); ?>
                        </p>

                        <div class="flex flex-row mt-5 py-2 space-x-3">
                            <select
                                name="selectArticleStatus"
                                data-article-id="<?php echo $article['article_id']; ?>"
                                class="selectArticleStatus px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                                <option value="pending" <?php if ($articleStatus == "pending") { ?>selected<?php } ?>>Pending</option>
                                <option value="rejected" <?php if ($articleStatus == "rejected") { ?>selected<?php } ?>>Rejected</option>
                                <option value="active" <?php if ($articleStatus == "active") { ?>selected<?php } ?>>Active</option>
                                <option value="inactive" <?php if ($articleStatus == "inactive") { ?>selected<?php } ?>>Inactive</option>
                            </select>

                            <?php if ($articleStatus != "pending") { ?>
                                <button
                                    data-article-id="<?php echo $article['article_id']; ?>"
                                    data-article-title="<?php echo $article['title']; ?>"
                                    data-article-category-id="<?php echo $article['category_id']; ?>"
                                    data-article-image-url="<?php echo $article['image_url']; ?>"
                                    data-article-content="<?php echo $article['content']; ?>"
                                    data-return-to="review_articles"
                                    class="editArticleButton px-3 py-1 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition cursor-pointer">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>

                                <button
                                    data-article-id="<?php echo $article['article_id']; ?>"
                                    data-article-title="<?php echo $article['title']; ?>"
                                    data-article-owner="<?php echo $article['author_id']; ?>"
                                    data-delete-by-admin="true"
                                    class="deleteArticleButton px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition cursor-pointer">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Article Related Modals -->
    <?php include __DIR__ . '/../components/readArticleModal.php'; ?>
    <?php include __DIR__ . '/../components/editArticleModal.php'; ?>

    <script src="../core/scripts/articleBoxScript.js"></script>
    <script src="../core/scripts/adminReviewScript.js"></script>

</body>

</html>