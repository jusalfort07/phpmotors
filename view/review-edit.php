<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <link rel="stylesheet" href="/phpmotors/css/reviews.css">

    <title>Edit Review | PHP Motors</title>
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
            <h1>Edit Review</h1>

            <p>Vehicle: <?php echo $reviewInfo[0]['invMake'] . " " . $reviewInfo[0]['invModel'] ?></p>
            <p>Date: <?php 
                        $timestamp = strtotime($reviewInfo[0]['reviewDate']);
                        echo date('F j, Y - g:i a', $timestamp);
                    ?></p>
            <p>User: <?php echo substr($reviewInfo[0]['clientFirstname'], 0, 1) . $reviewInfo[0]['clientLastname'] ?></p>

            <form action="/phpmotors/reviews/index.php" method="POST">
                <input type="hidden" name="reviewId" <?php echo 'value="' . $reviewInfo[0]['reviewId'] . '"' ?>>
                <input type="hidden" name="invId" <?php echo 'value="' . $reviewInfo[0]['invId'] . '"' ?>>
                <input type="hidden" name="clientId" <?php echo 'value="' . $reviewInfo[0]['clientId'] . '"' ?>>

                <label for="reviewText" style="display:block">Comment:</label>
                <textarea name="reviewText" id="reviewText" cols="30" rows="10" required><?php echo $reviewInfo[0]['reviewText'] ?></textarea>

                <div class="form-button form-div">
                    <button type="submit">
                        Update Review
                    </button>

                    <input type="hidden" name="action" value="edit_save">
                </div>
            </form>
        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>