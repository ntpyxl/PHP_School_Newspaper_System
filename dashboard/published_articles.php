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

                    <!-- TODO: SHOULD NOT BE SEEN BY WRITERS -->
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
                <h1 class="text-2xl font-bold mb-6">Double click to edit article</h1>

                <?php $articles = $articleObj->getArticlesByUserID($_SESSION['user_id']); ?>
                <?php foreach ($articles as $article) { ?>
                    <div class="bg-white shadow-md rounded-lg p-6 mb-6 articleCard cursor-pointer">
                        <h2 class="text-xl font-semibold"><?php echo $article['title']; ?></h2>
                        <small class="text-gray-500"><?php echo $article['username'] ?> - <?php echo $article['created_at']; ?></small>

                        <!-- Status -->
                        <?php if ($article['is_active'] == 0) { ?>
                            <p class="text-red-600 font-medium mt-2">Status: PENDING</p>
                        <?php } ?>
                        <?php if ($article['is_active'] == 1) { ?>
                            <p class="text-green-600 font-medium mt-2">Status: ACTIVE</p>
                        <?php } ?>

                        <p class="mt-4 text-gray-700"><?php echo $article['content']; ?> </p>

                        <!-- Delete Button -->
                        <form class="deleteArticleForm mt-4">
                            <input type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>" class="article_id">
                            <input type="submit" value="Delete"
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 cursor-pointer">
                        </form>

                        <!-- Hidden Edit Form -->
                        <div class="updateArticleForm hidden mt-6">
                            <h4 class="text-lg font-semibold mb-2">Edit the article</h4>
                            <form action="core/handler.php" method="POST" class="space-y-4">
                                <div>
                                    <input type="text" name="title" value="<?php echo $article['title']; ?>"
                                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
                                </div>
                                <div>
                                    <textarea name="description"
                                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"><?php echo $article['content']; ?></textarea>
                                    <input type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>">
                                    <input type="submit" name="editArticleBtn" value="Update"
                                        class="mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 cursor-pointer float-right">
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        // Double click to toggle edit form
        $('.articleCard').on('dblclick', function(event) {
            var updateArticleForm = $(this).find('.updateArticleForm');
            updateArticleForm.toggleClass('hidden');
        });

        // Delete article via AJAX
        $('.deleteArticleForm').on('submit', function(event) {
            event.preventDefault();
            var formData = {
                article_id: $(this).find('.article_id').val(),
                deleteArticleBtn: 1
            }
            if (confirm("Are you sure you want to delete this article?")) {
                $.ajax({
                    type: "POST",
                    url: "core/handler.php",
                    data: formData,
                    success: function(data) {
                        if (data) {
                            location.reload();
                        } else {
                            alert("Deletion failed");
                        }
                    }
                })
            }
        })
    </script>

</body>

</html>