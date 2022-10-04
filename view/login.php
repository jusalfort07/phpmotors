<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <link rel="stylesheet" href="/phpmotors/css/login.css">
    <title>Account Login | PHP Motors</title>
</head>
<body>
    <div class="content">
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>

        <nav>
            <?php
                // require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';
                echo $navList;
            ?>
        </nav>

        <main>
            <h1>Sign In</h1>

            <form action="GET" class="log-in-form">
                <div class="email form-div">
                    <label for="email">
                        Email:
                    </label>

                    <input type="text" name="clientEmail" id="clientEmail">
                </div>

                <div class="password form-div">
                    <label for="password">
                        Password:
                    </label>

                    <input type="text" name="clientPassword" id="clientPassword">
                </div>

                <div class="form-button form-div">
                    <button type="submit">
                        Sign-in
                    </button>
                </div>
            </form>

            <a class="register-link" href="/phpmotors/accounts/index.php?action=register">Not a member yet?</a>
        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>