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

            <?php
                if(isset($message)){
                    echo $_SESSION['message'];
                }
            ?>

            <form action="/phpmotors/accounts/" method="POST" class="log-in-form">
                <div class="email form-div">
                    <label for="clientEmail">
                        Email:
                    </label>

                    <input type="email" name="clientEmail" id="clientEmail" required value="<?php if(isset($clientEmail)){echo $clientEmail;}  ?>">
                </div>

                <div class="password form-div">
                    <label for="clientPassword">
                        Password:
                    </label>

                    <span>Passwords must be atleast 8 characters and contains at least 1 number,
                        1 capital letter, and 1 special character</span>

                    <input 
                    type="password" 
                    name="clientPassword" 
                    id="clientPassword" 
                    pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                    required>
                </div>

                <div class="form-button form-div">
                    <button type="submit">
                        Sign-in
                    </button>

                    <input type="hidden" name="action" value="Login">
                </div>
            </form>

            <a class="register-link" href="/phpmotors/accounts/index.php?action=registration">Not a member yet?</a>
        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>