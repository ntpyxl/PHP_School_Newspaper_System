<?php
define("BASE_URL", "/php_school_newspaper_system/src/");
$currentFile = basename($_SERVER['PHP_SELF']);
$currentDir = basename(dirname($_SERVER['PHP_SELF']));

$title = "School Publication";

if ($currentDir === "src" && $currentFile === "index.php") {
    $title = "School Publication Homepage";
} elseif ($currentDir === "src" && $currentFile === "allArticles.php") {
    $title = "School Publication Articles";
} elseif ($currentDir === "dashboard") {
    $title = "School Publication Dashboard";
}
?>

<nav class="p-4 bg-green-900 text-white">
    <div class="container mx-auto flex items-center justify-between">
        <a href="index.php" class="text-white text-xl font-semibold">
            <?php echo $title; ?>
        </a>

        <button class="lg:hidden focus:outline-none" id="menu-toggle">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <div class="hidden lg:flex space-x-6" id="menu">
            <a
                href="<?php echo BASE_URL; ?>index.php"
                class="text-white hover:underline underline-offset-4 
                        <?php echo ($currentDir === 'src' && $currentFile === 'index.php') ? 'underline' : ''; ?>">
                Home
            </a>

            <a
                href="<?php echo BASE_URL; ?>allArticles.php"
                class="text-white hover:underline underline-offset-4
                        <?php echo ($currentDir === 'src' && $currentFile === 'allArticles.php') ? 'underline' : ''; ?>">
                Articles
            </a>

            <a
                href="<?php echo BASE_URL; ?>index.php#aboutUs"
                class="text-white hover:underline underline-offset-4">
                About Us
            </a>

            <a
                href="<?php echo BASE_URL; ?>dashboard/"
                class="text-white hover:underline underline-offset-4
                        <?php echo ($currentDir === 'dashboard') ? 'underline' : ''; ?>">
                Dashboard
            </a>
        </div>
    </div>
</nav>

<script>
    document.getElementById("menu-toggle").addEventListener("click", function() {
        document.getElementById("menu").classList.toggle("hidden");
    });
</script>