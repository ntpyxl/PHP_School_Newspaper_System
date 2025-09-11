<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<div class="space-y-3">
    <button
        onclick="window.location.href='./'"
        class="w-full py-2 rounded-lg transition cursor-pointer
           <?php echo $currentPage === "index.php"
                ? 'border border-teal-600 bg-white text-teal-600 hover:bg-teal-50'
                : 'border border-white bg-teal-600 text-white hover:bg-teal-700'; ?>">
        Dashboard
    </button>

    <button
        onclick="window.location.href='published_articles.php'"
        class="w-full py-2 rounded-lg transition cursor-pointer
           <?php echo $currentPage === "published_articles.php"
                ? 'border border-indigo-600 bg-white text-indigo-600 hover:bg-indigo-50'
                : 'border border-white bg-indigo-600 text-white hover:bg-indigo-700'; ?>">
        My Articles
    </button>

    <button
        onclick="window.location.href='shared_articles.php'"
        class="w-full py-2 rounded-lg transition cursor-pointer
           <?php echo $currentPage === "shared_articles.php"
                ? 'border border-indigo-600 bg-white text-indigo-600 hover:bg-indigo-50'
                : 'border border-white bg-indigo-600 text-white hover:bg-indigo-700'; ?>">
        Articles Shared to Me
    </button>

    <?php if ($userObj->isAdmin()) { ?>
        <button
            onclick="window.location.href='review_articles.php'"
            class="w-full py-2 rounded-lg transition cursor-pointer
           <?php echo $currentPage === "review_articles.php"
                ? 'border border-amber-600 bg-white text-amber-600 hover:bg-amber-50'
                : 'border border-white bg-amber-600 text-white hover:bg-amber-700'; ?>">
            Review Articles
        </button>
    <?php } ?>

    <button
        onclick="window.location.href='../core/handler.php?logoutUserBtn=1'"
        class="w-full py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition cursor-pointer">
        Logout
    </button>
</div>