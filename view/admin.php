<?php 
    if($_SESSION['loggedin'] != TRUE){
       header('Location: /phpmotors/');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <link rel="stylesheet" href="/phpmotors/css/admin.css">

    <title>Admin | PHP Motors</title>
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
            <h1><?php echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname'] ?></h1>
            
            <?php
                if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                }
            ?>
            
            <h3>You are logged in.</h3>
            
            <ul>
                <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname'] ?></li>
                <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname'] ?></li>
                <li>Email: <?php echo $_SESSION['clientData']['clientEmail'] ?></li>
            </ul>

            <br>

            <div id="account_management">
                <h3>Account Management:</h3>
                <p>Use this link to update account information.</p>
                <a href="/phpmotors/accounts/index.php?action=mod">Update Account Information</a>
            </div>

            <br>

            <div id="inventory_management">
                <?php 
                    if($_SESSION['clientData']['clientLevel'] != 1){
                        echo "<h3>Inventory Management: </h3>";
                        echo "<p>Use this link to manage the inventory</p>";
                        echo "<a href='/phpmotors/vehicles'>Vehicle Management</a>";
                    }
                ?>
            </div>

            <div class="reviews-div">
                <h3>Reviews Made:</h3>

                <?php if(isset($review_message)){ echo $review_message; } ?>

                <div class="reviews">
                    <?php 
                        $reviews_table = '<table>';

                        $reviews_table .= 
                            '
                            <tr>
                                <th>Vehicle</th>
                                <th>Review Date</th>
                                <th>Actions</th>
                            </tr>
                            ';

                        foreach($reviews as $review){
                            $time_stamp = strtotime($review['reviewDate']);

                            $reviews_table .= 
                                '
                                <tr>
                                    <td>'. $review['invMake']." " . $review['invModel'] .'</td>
                                    <td>'. date('F j, Y', $time_stamp) .'</td>
                                    <td>
                                        <a class="edit" href="/phpmotors/reviews/?action=edit_review&reviewId='. urlencode($review['reviewId']) .'">Edit</a>
                                        <a class="delete" href="/phpmotors/reviews/?action=delete_review&reviewId='. urlencode($review['reviewId']) .'">Delete</a>
                                    </td>
                                </tr>
                                ';
                        }

                        $reviews_table .= '</table>';

                        echo $reviews_table;
                    ?>
                </div>
            </div>
            
        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>
<?php unset($_SESSION['message']); ?>