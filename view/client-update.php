<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <link rel="stylesheet" href="/phpmotors/css/register.css">

    <title>Update Account | PHP Motors
</title>
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
            <h1>Update Account Information</h1>

            <div class="error-message">
                <?php
                    if(isset($account_message)){
                        echo $account_message;
                    }

                    if(isset($message)){
                        echo $message;
                    }
                ?>
            </div>

            <form action="/phpmotors/accounts/index.php" method="POST">
                <div class="first-name form-div">
                    <label for="clientFirstname">
                        First Name
                    </label>

                    <input type="text" name="clientFirstname" id="clientFirstname" required value="<?php if(isset($_SESSION['clientData'])){echo $_SESSION['clientData']['clientFirstname'];} else { echo $clientFirstname; } ?>">
                </div>

                <div class="last-name form-div">
                    <label for="clientLastname">
                        Last Name
                    </label>

                    <input type="text" name="clientLastname" id="clientLastname" required value="<?php if(isset($_SESSION['clientData'])){echo $_SESSION['clientData']['clientLastname'];} else { echo $clientLastname; } ?>">
                </div>

                <div class="email form-div">
                    <label for="clientEmail">
                        Email
                    </label>

                    <input type="email" name="clientEmail" id="clientEmail" required value="<?php if(isset($_SESSION['clientData'])){echo $_SESSION['clientData']['clientEmail'];} else { echo $clientEmail; } ?>">
                </div>

                <div class="form-button form-div">
                    <button type="submit" name="submit" value="Update Account">
                        Update Account
                    </button>
                    <input type="hidden" name="action" value="update_account">
                    <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">
                </div>
            </form>
            

            <h1>Update Password</h1>

            <div class="error-message">
                <?php
                    if(isset($password_message)){
                        echo $password_message;
                    }
                ?>
            </div>

            <form action="/phpmotors/accounts/index.php" method="POST">
                <div class="password form-div">
                    <label for="clientPassword">Password</label>

                    <span>*This will update your password and cannot be undone</span>

                    <br><br>

                    <span>*Passwords must be atleast 8 characters and contains at least 1 number, 1 capital letter, and 1 special character</span>

                    <input 
                        type="password" 
                        name="clientPassword" 
                        id="clientPassword" 
                        pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                        required
                    >


                    <div class="form-button form-div">
                        <button type="submit" name="submit" value="Update Password">
                            Update Password
                        </button>
                        <input type="hidden" name="action" value="update_password">
                        <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">
                    </div>
                </div>
            </form>
        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>