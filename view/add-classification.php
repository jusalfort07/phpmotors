<?php
    if(!isset($_SESSION['loggedin'])){
        header("Location: /phpmotors/");
    } else if ($_SESSION['clientData']['clientLevel'] == 1){
        header("Location: /phpmotors/");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <link rel="stylesheet" href="/phpmotors/css/add-classification.css">

    <title>Add Classification | PHP Motors</title>
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
            <h1>Add Classification</h1>

            <div class="error-message">
                <?php
                    if(isset($message)){
                        echo $message;
                    }
                ?>
            </div>

            <form action="/phpmotors/vehicles/index.php" method="POST">
                <div class="form-div classification-name">
                    <label for="classificationName">
                        Classification Name
                    </label>

                    <input 
                        type="text" 
                        maxlength="30" 
                        id="classificationName" 
                        name="classificationName" 
                        value="<?php if(isset($classificationName)){
                                        echo $classificationName;
                                    }?>" 
                        required>

                    <span>*Input is limited to 30 characters.</span>
                </div>

                <div class="form-button form-div">
                    <button type="submit">
                        Add Classification
                    </button>

                    <input type="hidden" name="action" value="save_classification">
                </div>
            </form>

        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>