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
    <title>My Articles</title>

    <link href="../core/styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>

<body class="bg-gray-100 font-sans">
    <?php include __DIR__ . '/../components/navbar.php'; ?>

    <div class="mx-auto px-16 py-3">
        <h1 class="py-3 text-3xl font-bold">
            Hello there <span class="text-green-600 font-semibold"><?php echo $_SESSION['username']; ?></span>!
            Here are <span class="text-green-600">your articles</span>!
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-4 mt-3 gap-8">
            <div class="md:col-span-1 space-y-6">
                <div class="space-y-3">
                    <button
                        onclick="window.location.href='./'"
                        class="w-full py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition cursor-pointer">
                        Dashboard
                    </button>

                    <button
                        onclick="window.location.href='shared_articles.php'"
                        class="w-full py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition cursor-pointer">
                        Articles Shared to Me
                    </button>

                    <button
                        onclick="window.location.href='review_articles.php'"
                        class="w-full py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition cursor-pointer">
                        Review Articles
                    </button>

                    <button
                        onclick="window.location.href='../core/handler.php?logoutUserBtn=1'"
                        class="w-full py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition cursor-pointer">
                        Logout
                    </button>
                </div>
            </div>

            <div class="md:col-span-3 space-y-6">
                <?php $articles = $articleObj->getArticles(); ?>
                <?php foreach ($articles as $article) { ?>
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h1 class="text-xl font-bold text-gray-900 mb-2">
                            <?php echo $article['title']; ?>
                        </h1>

                        <small class="block text-gray-600 mb-2">
                            <?php echo $article['username'] ?> - <?php echo $article['created_at']; ?>
                        </small>

                        <?php if ($article['is_active'] == 0) { ?>
                            <p class="text-red-600 font-semibold mb-2">Status: PENDING</p>
                        <?php } ?>
                        <?php if ($article['is_active'] == 1) { ?>
                            <p class="text-green-600 font-semibold mb-2">Status: ACTIVE</p>
                        <?php } ?>

                        <p class="text-gray-700 mb-4"><?php echo $article['content']; ?></p>

                        <!-- Delete Form -->
                        <form class="deleteArticleForm mb-3">
                            <input type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>" class="article_id">
                            <button type="submit"
                                class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition deleteArticleBtn">
                                Delete
                            </button>
                        </form>

                        <!-- Update Status -->
                        <form class="updateArticleStatus mb-3">
                            <input type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>" class="article_id">
                            <select name="is_active" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none is_active_select"
                                article_id="<?php echo $article['article_id']; ?>">
                                <option value="">Select an option</option>
                                <option value="0">Pending</option>
                                <option value="1">Active</option>
                            </select>
                        </form>

                        <!-- Update Article Form (Hidden by default) -->
                        <div class="updateArticleForm hidden">
                            <h4 class="text-lg font-semibold mb-3">Edit the article</h4>
                            <form action="core/handler.php" method="POST" class="space-y-4">
                                <input type="text" name="title" value="<?php echo $article['title']; ?>"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">

                                <textarea name="description"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none"><?php echo $article['content']; ?></textarea>

                                <input type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>">
                                <button type="submit" name="editArticleBtn"
                                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                                    Save Changes
                                </button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</body>

</html>