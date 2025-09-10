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
    <title>Writer Dashboard - School Publication</title>

    <link href="../core/styles.css" rel="stylesheet">
</head>

<body class="font-sans bg-gray-50 min-h-screen">
    <?php include __DIR__ . '/../components/navbar.php'; ?>

    <div class="mx-auto px-16 py-3">
        <h1 class="py-3 text-3xl font-bold">
            Hello there <span class="text-green-600 font-semibold"><?php echo $_SESSION['username']; ?></span>!
            What would you like to <span class="text-green-600">publish</span> today?
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-4 mt-3 gap-8">
            <div class="md:col-span-1 space-y-6">
                <?php include __DIR__ . '/../components/dashboardNavbar.php'; ?>
            </div>

            <div class="md:col-span-3 space-y-6">
                <form action="../core/handler.php" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Article Title</label>
                        <input type="text" name="title" placeholder="Your Title Here" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Article Content</label>
                        <textarea name="description" placeholder="Your Article Here" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 h-32 focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                    </div>
                    <div>
                        <button type="submit" name="insertArticleBtn"
                            class="w-full py-2 bg-green-600 rounded-lg hover:bg-green-700 text-white font-semibold transition cursor-pointer">
                            Submit Article
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>