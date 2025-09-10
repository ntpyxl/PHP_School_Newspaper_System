<?php require_once __DIR__ . '/core/classloader.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage - School Publication</title>

    <link href="core/styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>

<body class="font-sans bg-gray-50 text-gray-800">
    <?php include 'components/navbar.php'; ?>

    <div class="max-w-7xl mx-auto px-4">
        <h1 class="m-1 p-3 text-4xl font-bold text-center">Recent Articles</h1>

        <div class="flex justify-center">
            <div class="w-full md:w-2/3">
                <?php
                $articles = $articleObj->getActiveArticles(); // TODO: should just return 4/5 articles next time
                foreach ($articles as $article) { ?>
                    <div class="my-3 p-5 rounded-lg bg-white shadow">
                        <h2 class="mb-2 text-2xl font-bold">
                            <?php echo $article['title']; ?>
                        </h2>

                        <p class="block mb-3 text-gray-600 text-sm">
                            Published by

                            <?php if ($article['is_admin'] == 1) { ?>
                                <span class="px-1 rounded-md bg-blue-600 text-white text-xs">Admin</span>
                            <?php } elseif ($article['is_admin'] == 0) { ?>
                                <span class="px-1 rounded-md bg-green-600 text-white text-xs">Writer</span>
                            <?php } ?>

                            <span class="font-bold"><?php echo $article['username'] ?></span>

                            on <?php echo date("F j, Y g:i A", strtotime($article['created_at'])); ?>
                        </p>

                        <p class="mt-2 text-gray-700"><?php echo $article['content']; ?></p>
                    </div>
                <?php } ?>

                <div class="flex justify-center items-center">
                    <button type="button" class="mt-6 px-4 py-2 rounded-md bg-green-600 shadow text-white hover:bg-green-700 cursor-pointer">
                        View More Articles
                    </button>
                </div>

            </div>
        </div>

        <div id="aboutUs">
            <h2 class="my-4 py-4 text-4xl font-bold text-center">
                Discover the roles that shape our publication
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-6 bg-white rounded-lg shadow">
                    <h3 class="mb-4 text-2xl font-semibold text-center">Writer</h3>
                    <img
                        src="https://images.unsplash.com/photo-1577900258307-26411733b430?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="mb-4 w-full h-64 rounded-md object-cover">
                    <p class="text-gray-700 text-justify">
                        Content writers create clear, engaging, and informative content that helps businesses communicate their
                        services or products effectively, build brand authority, attract and retain customers, and drive web
                        traffic and conversions.
                    </p>
                </div>

                <div class="p-6 bg-white rounded-lg shadow">
                    <h3 class="mb-4 text-2xl font-semibold text-center">Admin</h3>
                    <img
                        src="https://plus.unsplash.com/premium_photo-1661582394864-ebf82b779eb0?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="mb-4 w-full h-64 rounded-md object-cover">
                    <p class="text-gray-700 text-justify">
                        Admin writers play a key role in content team development. They are the highest-ranking editorial
                        authority responsible for managing the entire editorial process, and aligning all published material with
                        the publication’s overall vision and strategy.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 py-4 flex flex-col items-center space-y-2">
        <h2 class="text-4xl font-bold text-center">
            Would you like to contribute?
        </h2>

        <div class="py-3 flex space-x-4">
            <button
                onclick="window.location.href='register.php'"
                class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition cursor-pointer">
                Register
            </button>
            <button
                onclick="window.location.href='login.php'"
                class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition cursor-pointer">
                Log In
            </button>
        </div>

    </div>

    <footer class="flex flex-col px-32 py-6 items-center justify-center bg-green-800 text-white text-center space-y-2">
        <div class="text-2xl font-semibold">
            School Publication
        </div>
    </footer>
</body>

</html>