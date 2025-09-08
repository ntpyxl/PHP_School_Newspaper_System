<?php require_once __DIR__ . '/core/classloader.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
        body {
            font-family: "Arial";
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark p-4" style="background-color: #355E3B;">
        <a class="navbar-brand" href="#">School Publication Homepage</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container-fluid">
        <div class="display-4 text-center">Hello there and welcome to the main homepage!</div>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h1>Writer</h1>
                        <img src="https://images.unsplash.com/photo-1577900258307-26411733b430?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-fluid">
                        <p>Content writers create clear, engaging, and informative content that helps businesses communicate their services or products effectively, build brand authority, attract and retain customers, and drive web traffic and conversions.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h1>Admin</h1>
                        <img src="https://plus.unsplash.com/premium_photo-1661582394864-ebf82b779eb0?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-fluid">
                        <p>Admin writers play a key role in content team development. They are the highest-ranking editorial authority responsible for managing the entire editorial process, and aligning all published material with the publication’s overall vision and strategy. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="display-4 text-center mt-4">All articles are below!!</div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php $articles = $articleObj->getActiveArticles(); ?>
                <?php foreach ($articles as $article) { ?>
                    <div class="card mt-4 shadow">
                        <div class="card-body">
                            <h1><?php echo $article['title']; ?></h1>
                            <?php if ($article['is_admin'] == 1) { ?>
                                <p><small class="bg-primary text-white p-1">
                                        Message From Admin
                                    </small></p>
                            <?php } ?>
                            <small><strong><?php echo $article['username'] ?></strong> - <?php echo $article['created_at']; ?> </small>
                            <p><?php echo $article['content']; ?> </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>