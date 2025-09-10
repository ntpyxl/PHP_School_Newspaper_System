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