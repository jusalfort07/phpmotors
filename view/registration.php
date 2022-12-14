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

            <?php
                if(isset($message)){
                    echo $message;
                }
            ?>

            <form action="/phpmotors/accounts/index.php" method="POST">
                <div class="first-name form-div">
                    <label for="clientFirstname">
                        First Name
                    </label>

                    <input type="text" name="clientFirstname" id="clientFirstname" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>>
                </div>

                <div class="last-name form-div">
                    <label for="clientLastname">
                        Last Name
                    </label>

                    <input type="text" name="clientLastname" id="clientLastname" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>>
                </div>

                <div class="email form-div">
                    <label for="clientEmail">
                        Email
                    </label>

                    <input type="email" name="clientEmail" id="clientEmail" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>>
                </div>

                <div class="password form-div">
                    <label for="clientPassword">
                        Password
                    </label>

                    <span>Passwords must be atleast 8 characters and contains at least 1 number,
                        1 capital letter, and 1 special character</span>

                    <input 
                    type="password" 
                    name="clientPassword" 
                    id="clientPassword" 
                    pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                    required>
                    
                    <button type="button">
                        Show Password
                    </button>
                </div>

                <div class="form-button form-div">
                    <button type="submit" name="submit" id="regbtn" value="Register">
                        Register
                    </button>

                    <input type="hidden" name="action" value="register">
                </div>
            </form>
        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>