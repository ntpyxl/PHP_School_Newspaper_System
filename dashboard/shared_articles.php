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
            Here are the articles <span class="text-green-600">shared</span> to you!
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
                        onclick="window.location.href='published_articles.php'"
                        class="w-full py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition cursor-pointer">
                        My Articles
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

            </div>
        </div>
    </div>

</body>

</html>