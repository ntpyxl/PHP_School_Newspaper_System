<nav class="p-4 bg-green-900 text-white">
    <div class="container mx-auto flex items-center justify-between">

        <a href="index.php" class="text-white text-xl font-semibold">
            School Publication Homepage
        </a>

        <button class="lg:hidden focus:outline-none" id="menu-toggle">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <div class="hidden lg:flex space-x-6" id="menu">
            <a
                href="index.php"
                class="text-white hover:underline underline-offset-4">
                Home
            </a>

            <a
                href="allArticles.php"
                class="text-white hover:underline underline-offset-4">
                Articles
            </a>

            <a
                href="index.php#aboutUs"
                class="text-white hover:underline underline-offset-4">
                About Us
            </a>

            <a
                href="dashboard/"
                class="text-white hover:underline underline-offset-4">
                Publish
            </a>
        </div>
    </div>
</nav>

<script>
    document.getElementById("menu-toggle").addEventListener("click", function() {
        document.getElementById("menu").classList.toggle("hidden");
    });
</script>