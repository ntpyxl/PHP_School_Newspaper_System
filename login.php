<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - School Publication</title>

    <link href="core/styles.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-cover bg-center bg-no-repeat flex items-center justify-center"
    style="background-image: url('https://images.unsplash.com/photo-1501504905252-473c47e087f8?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0');">

    <div class="absolute inset-0 bg-black/50"></div>

    <div class="flex relative z-10 min-h-screen px-4 items-center justify-center">
        <div class="w-full max-w-lg p-8 bg-white rounded-xl shadow-lg">

            <?php
            if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
                if ($_SESSION['status'] == "200") {
                    echo "<p class='text-green-600 font-semibold'>{$_SESSION['message']}</p>";
                } else {
                    echo "<p class='text-red-600 font-semibold'>{$_SESSION['message']}</p>";
                }
            }
            unset($_SESSION['message']);
            unset($_SESSION['status']);
            ?>

            <h2 class="mb-6 text-2xl font-bold text-center text-gray-800">Log in to your writer account!</h2>

            <form action="core/handler.php" method="POST" class="space-y-4">
                <div>
                    <label for="email" class="text-gray-700 font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email" placeholder="example@email.com" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label for="password" class="text-gray-700 font-medium mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div class="pt-4">
                    <button type="submit" id="loginUserBtn" name="loginUserBtn"
                        class="w-full py-2 bg-green-600 rounded-lg hover:bg-green-700 text-white font-semibold transition cursor-pointer">
                        Log In
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>