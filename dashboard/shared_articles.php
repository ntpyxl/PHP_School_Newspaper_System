<?php require_once __DIR__ . '/../core/classloader.php'; ?>

<?php
if (!$userObj->isLoggedIn()) {
    header("Location: ../login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shared Articles - School Publication</title>

    <link href="../core/styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>

<body class="bg-gray-50 font-sans">
    <?php include __DIR__ . '/../components/navbar.php'; ?>

    <div class="mx-auto px-16 py-3">
        <h1 class="py-3 text-3xl font-bold">
            Hello there <span class="text-green-600 font-semibold"><?php echo $_SESSION['username']; ?></span>!
            Here are the articles <span class="text-green-600">shared with each other</span>!
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-4 mt-3 gap-8">
            <div class="md:col-span-1 space-y-6">
                <?php include __DIR__ . '/../components/dashboardNavbar.php'; ?>
            </div>

            <div class="md:col-span-3 grid grid-cols-2 gap-8">
                <div class="col-span-1">
                    <h3 class="pb-3 text-2xl font-semibold text-center">Share Requests</h3>

                    <div class="space-y-6">
                        <?php
                        $articles = $articleObj->getArticleRequests($_SESSION['user_id']);
                        foreach ($articles as $article) {
                        ?>
                            <div
                                data-article-title="<?php echo $article['title']; ?>"
                                data-article-content="<?php echo $article['content']; ?>"
                                data-author-username="<?php echo $article['author_username']; ?>"
                                data-is-admin="<?php echo $article['author_is_admin']; ?>"
                                data-created-at="<?php echo date("F j, Y g:i A", strtotime($article['created_at'])); ?>"
                                class="bg-white shadow-md rounded-lg p-6  articleCard cursor-pointer">

                                <h2 class="text-xl font-semibold"><?php echo $article['title']; ?></h2>

                                <p class="block text-gray-600 text-sm">
                                    Requested on <?php echo date("F j, Y g:i A", strtotime($article['requested_at'])); ?>
                                </p>

                                <?php
                                $shareStatus = $article['share_status'];
                                $shareStatusTextColor = "";
                                if ($shareStatus == "pending") {
                                    $shareStatusTextColor = "text-teal-600";
                                } else if ($shareStatus == "rejected") {
                                    $shareStatusTextColor = "text-red-600";
                                } else if ($shareStatus == "accepted") {
                                    $shareStatusTextColor = "text-green-600";
                                }
                                ?>
                                <p class="<?php echo $shareStatusTextColor; ?> font-medium">
                                    Share Status: <?php echo strtoupper($shareStatus); ?>
                                </p>

                                <select
                                    name="selectShareStatus"
                                    data-share-id="<?php echo $article['share_id']; ?>"
                                    class="selectShareStatus mt-3 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                                    <option value="pending" disabled <?php if ($shareStatus == "pending") { ?>selected<?php } ?>>Pending</option>
                                    <option value="accepted" <?php if ($shareStatus == "accepted") { ?>selected<?php } ?>>Accept</option>
                                    <option value="rejected" <?php if ($shareStatus == "rejected") { ?>selected<?php } ?>>Reject</option>
                                </select>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-span-1">
                    <h3 class="pb-3 text-2xl font-semibold text-center">Shared To You</h3>

                    <div class="space-y-6">
                        <?php
                        $articles = $articleObj->getSharedArticles($_SESSION['user_id']);
                        foreach ($articles as $article) {
                        ?>
                            <div
                                data-article-title="<?php echo $article['title']; ?>"
                                data-article-content="<?php echo $article['content']; ?>"
                                data-author-username="<?php echo $article['author_username']; ?>"
                                data-is-admin="<?php echo $article['author_is_admin']; ?>"
                                data-created-at="<?php echo date("F j, Y g:i A", strtotime($article['created_at'])); ?>"
                                class="bg-white shadow-md rounded-lg p-6  articleCard cursor-pointer">

                                <h2 class="text-xl font-semibold"><?php echo $article['title']; ?></h2>

                                <p class="block text-gray-600 text-sm">
                                    Requested on <?php echo date("F j, Y g:i A", strtotime($article['requested_at'])); ?>
                                </p>

                                <?php
                                $shareStatus = $article['share_status'];
                                $shareStatusTextColor = "";
                                if ($shareStatus == "pending") {
                                    $shareStatusTextColor = "text-teal-600";
                                } else if ($shareStatus == "rejected") {
                                    $shareStatusTextColor = "text-red-600";
                                } else if ($shareStatus == "accepted") {
                                    $shareStatusTextColor = "text-green-600";
                                }
                                ?>
                                <p class="<?php echo $shareStatusTextColor; ?> font-medium">
                                    Share Status: <?php echo strtoupper($shareStatus); ?>
                                </p>

                                <button
                                    data-article-id="<?php echo $article['article_id']; ?>"
                                    data-article-title="<?php echo $article['title']; ?>"
                                    data-article-content="<?php echo $article['content']; ?>"
                                    data-return-to="shared_articles"
                                    class="editArticleButton mt-3 px-3 py-1 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition cursor-pointer">
                                    Edit
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Related Modals -->
    <?php include __DIR__ . '/../components/readArticleModal.php'; ?>
    <?php include __DIR__ . '/../components/editArticleModal.php'; ?>

    <script src="../core/scripts/articleBoxScript.js"></script>

</body>

</html>