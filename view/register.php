<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <link rel="stylesheet" href="/phpmotors/css/register.css">

    <title>Account Registration | PHP Motors</title>
</head>
<body>
    <div class="content">
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>

        <nav>
            <?php
            //  require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';
                echo $navList;
            ?>
        </nav>

        <main>
            <h1>Register</h1>

            <form action="POST">
                <div class="first-name form-div">
                    <label for="first-name">
                        First Name
                    </label>

                    <input type="text" name="clientFirstName" id="clientFirstName" require>
                </div>

                <div class="last-name form-div">
                    <label for="last-name">
                        Last Name
                    </label>

                    <input type="text" name="clientLastName" id="clientLastName" require>
                </div>

                <div class="email form-div"">
                    <label for="email">
                        Email
                    </label>

                    <input type="text" name="clientEmail" id="clientEmail" require>
                </div>

                <div class="password form-div">
                    <p>Passwords must be atleast 8 characters and contains at least 1 number,
                         1 capital letter, and 1 special character</p>
                         
                    <label for="password">
                        Password
                    </label>

                    <input type="password" name="clientPassword" id="clientPassword" require>
                    
                    <button type="button">
                        Show Password
                    </button>
                </div>

                <div class="form-button form-div">
                    <button type="submit">
                        Register
                    </button>
                </div>
            </form>
        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>