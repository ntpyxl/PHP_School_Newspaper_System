<?php require_once __DIR__ . '/../core/classloader.php'; ?>

<?php
if (!$userObj->isLoggedIn()) {
    header("Location: login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Publication - Publish</title>

    <link href="../core/styles.css" rel="stylesheet">
</head>

<body class="font-sans bg-gray-50 min-h-screen">
    <?php include __DIR__ . '/../components/navbar.php'; ?>

    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-center mb-6">
            Hello there and welcome
            <span class="text-green-600 font-semibold">
                <?php echo $_SESSION['username']; ?>
            </span>!
        </h1>

        <div class="max-w-2xl mx-auto">
            <form action="../core/handler.php" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-4">
                <div>
                    <input type="text" name="title" placeholder="Input title here" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <textarea name="description" placeholder="Submit an article!" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 h-32 focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                </div>
                <div>
                    <button type="submit" name="insertArticleBtn"
                        class="w-full py-2 bg-green-600 rounded-lg hover:bg-green-700 text-white font-semibold transition">
                        Submit Article
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>