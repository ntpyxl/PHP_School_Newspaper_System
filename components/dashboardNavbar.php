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

<div>
    <h3 class="pb-3 text-2xl font-semibold text-center">Article Notifications</h3>
    <div class="space-y-3">
        <?php
        $notifications = $notificationObj->getRecentUserNotifications($_SESSION['user_id']);
        if (!$notifications) {
        ?>
            <div class="p-4 mb-3 rounded-lg border-l-4 border-blue-500 bg-blue-50 shadow-sm">
                Nothing to see yet!
            </div>

        <?php
        }

        foreach ($notifications as $notification) {
        ?>
            <div class="p-4 mb-3 rounded-lg border-l-4 border-blue-500 bg-blue-50 shadow-sm">
                <div class="flex items-start space-x-3">

                    <!-- Text -->
                    <div class="flex-1">
                        <p class="text-gray-800">
                            Your article
                            <span class="font-semibold text-gray-900">"<?php echo $notification['article_title']; ?>"</span>
                            was
                            <span class="font-medium text-blue-700"><?php echo $notification['content']; ?></span>
                            by

                            <?php if ($notification['is_admin'] == 1) { ?>
                                <span class="px-1 rounded-md bg-blue-600 text-white text-xs">Admin</span>
                            <?php } elseif ($notification['is_admin'] == 0) { ?>
                                <span class="px-1 rounded-md bg-green-600 text-white text-xs">Writer</span>
                            <?php } ?>

                            <span class="font-semibold"><?php echo $notification['username']; ?></span>.
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            <?php echo date("F j, Y, g:i a", strtotime($notification['notified_at'])); ?>
                        </p>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</div>