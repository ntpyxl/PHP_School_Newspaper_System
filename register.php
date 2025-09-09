<?php require_once __DIR__ . '/core/classloader.php'; ?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Publication - Register</title>

    <link href="core/styles.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-cover bg-center bg-no-repeat"
    style="background-image: url('https://nondoc.com/wp-content/uploads/2022/12/Pile-of-papers.jpg');">

    <div class="absolute inset-0 bg-black/50"></div>

    <div class="flex relative z-10 min-h-screen px-4 items-center justify-center">
        <div class="w-full max-w-lg p-8 bg-white rounded-xl shadow-lg">

            <?php if (isset($_SESSION['message']) && isset($_SESSION['status'])): ?>
                <div class="mb-4 text-center font-semibold 
                    <?= $_SESSION['status'] == "200" ? 'text-green-600' : 'text-red-600' ?>">
                    <?= htmlspecialchars($_SESSION['message']); ?>
                </div>
                <?php
                unset($_SESSION['message']);
                unset($_SESSION['status']);
                ?>
            <?php endif; ?>

            <h2 class="mb-6 text-2xl font-bold text-center text-gray-800">
                Register your own writer account!
            </h2>

            <form action="core/handler.php" method="POST" class="space-y-4">
                <div>
                    <label for="username" class="text-gray-700 font-medium mb-1">Username</label>
                    <input type="text" id="username" placeholder="John" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label for="email" class="text-gray-700 font-medium mb-1">Email</label>
                    <input type="email" id="email" placeholder="example@email.com" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label for="password" class="text-gray-700 font-medium mb-1">Password</label>
                    <input type="password" id="password" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label for="confirm_password" class="text-gray-700 font-medium mb-1">Confirm Password</label>
                    <input type="password" id="confirm_password" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label for="role" class="text-gray-700 font-medium mb-1">User Role</label>
                    <select id="role" name="role" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="" disabled selected>Select role</option>
                        <option value="1">Admin</option>
                        <option value="0">Writer</option>
                    </select>
                </div>

                <div class="pt-4">
                    <input type="submit" id="insertNewUserBtn" value="Register"
                        class="w-full py-2 bg-green-600 rounded-lg text-white font-semibold hover:bg-green-700 transition cursor-pointer">
                </div>
            </form>
        </div>
    </div>
</body>

</html>