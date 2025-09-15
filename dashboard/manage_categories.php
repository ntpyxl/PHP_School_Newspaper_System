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
    <title>Writer Articles - School Publication</title>

    <link href="../core/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>

<body class="bg-gray-100 font-sans">
    <?php include __DIR__ . '/../components/navbar.php'; ?>

    <div class="mx-auto px-16 py-3">
        <h1 class="py-3 text-3xl font-bold">
            Hello there <span class="text-green-600 font-semibold"><?php echo $_SESSION['username']; ?></span>!
            Here are the <span class="text-green-600">article categories</span>!
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-4 mt-3 gap-8">
            <div class="md:col-span-1 space-y-6">
                <?php include __DIR__ . '/../components/dashboardNavbar.php'; ?>
            </div>

            <div class="md:col-span-3 space-y-6">
                <div>
                    <form action="../core/handler.php" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-4">
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Category Name</label>
                            <input type="text" name="category" placeholder="New Category Here" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>

                        <div>
                            <button type="submit" name="insertCategoryBtn"
                                class="w-full py-2 bg-green-600 rounded-lg hover:bg-green-700 text-white font-semibold transition cursor-pointer">
                                <i class="fa-solid fa-arrow-up-from-bracket"></i> Add Category
                            </button>
                        </div>
                    </form>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <?php
                    $categories = $articleObj->getCategories();
                    foreach ($categories as $category) {
                    ?>
                        <div class="bg-white shadow-md rounded-lg px-6 py-4">
                            <p class="text-xs text-gray-500">
                                ID: <?php echo $category['category_id']; ?>
                            </p>
                            <p class="text-lg font-semibold">
                                <?php echo $category['category_name']; ?>
                            </p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

</body>

</html>