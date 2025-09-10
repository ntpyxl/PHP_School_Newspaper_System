<?php require_once __DIR__ . '/../core/classloader.php'; ?>

<?php
if (!$userObj->isLoggedIn()) {
    header("Location: ../login.php");
}

// TODO: SHOULD NOT BE ACCESSED BY WRITERS
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Review Articles - School Publication</title>

    <link href="../core/styles.css" rel="stylesheet">
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
                    <div class="bg-white shadow-md rounded-lg p-6">

                        <h2 class="text-xl font-semibold"><?php echo $article['title']; ?></h2>

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

                            <!-- TODO: Don't show these buttons so it can't be deleted before changed from pending -->
                            <button
                                data-article-id="<?php echo $article['article_id']; ?>"
                                data-article-title="<?php echo $article['title']; ?>"
                                data-article-content="<?php echo $article['content']; ?>"
                                data-return-to="review_articles"
                                class="editArticleButton px-3 py-1 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition cursor-pointer">
                                Edit
                            </button>

                            <button
                                data-article-id="<?php echo $article['article_id']; ?>"
                                class="deleteArticleButton px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition cursor-pointer">
                                Delete
                            </button>
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