<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <link rel="stylesheet" href="/phpmotors/css/vehicle-detail.css">

    <title>
        <?php
            if($vehicle != false){
                echo $vehicle['invMake'] . " " . $vehicle['invModel'];
            } else {
                echo "Vehicle Detail";
            }
        ?> | PHP Motors
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
            <div class="error-message">
                <?php 
                    if (isset($message)) { 
                        echo $message; 
                    }
                ?>
            </div>

            <h1>
                <?php
                    if($vehicle != false){
                        echo $vehicle['invMake'] . " " . $vehicle['invModel'];
                    } else {
                        echo "Vehicle Detail";
                    }
                ?>
            </h1>
            
            <div id="flex_container">
                <div id="other_images_div">
                    <?php
                        echo $otherImagesList;
                    ?>
                </div>
                
                <div id="img_div">
                    <img src="<?php echo $vehicle['imgPath']; ?>" alt="Image of <?php echo $vehicle['invMake'] . ' ' . $vehicle['invModel']; ?>">
                </div>

                <div id="other_images_div_2">
                    <?php
                        echo $otherImagesList;
                    ?>
                </div>

                <div id="table_div">
                    <table>
                        <tr>
                            <td>Price:</td>
                            <td>$ <?php echo number_format($vehicle['invPrice']) ?></td>

                        </tr>

                        <tr>
                            <td>Color:</td>
                            <td><?php echo $vehicle['invColor'] ?></td>
                        </tr>

                        <tr>
                            <td>Description:</td>
                            <td><?php echo $vehicle['invDescription'] ?></td>
                        </tr>

                        <tr>
                            <td>Stocks Left: </td>
                            <td><?php echo $vehicle['invStock'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div id="reviews-container">
                <h3>Customer Reviews:</h3>
                
                <?php 
                    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != TRUE){
                        echo 
                            '<div class="login-div">
                                <a href="/phpmotors/accounts/index.php?action=login">Log in to leave a review</a>
                            </div>
                            ';
                    } else {
                        echo substr($_SESSION['clientData']['clientFirstname'], 0, 1) . ". " . $_SESSION['clientData']['clientLastname'];
                        echo
                            '
                            <form action="/phpmotors/reviews/index.php" method="POST">
                                <input type="hidden" name="clientId" value="' . $_SESSION['clientData']['clientId'] . '">
                                <input type="hidden" name="invId" value="' . $invId . '">
                                <label for="reviewText" style="display:block; margin-top: 10px;">Comment:</label>
                                <textarea name="reviewText" id="reviewText" required cols="30" rows="10" style="width: 100%; height: 50px; font-size: large;" placeholder="Type your review."></textarea>

                                <div class="form-button form-div">
                                    <button type="submit">
                                        Add Review
                                    </button>

                                    <input type="hidden" name="action" value="add_review">
                                </div>
                            </form>
                            ';
                    }
                ?>

                <div class="vehicle-reviews">
                    <?php 
                        
                        $review_list = "<ul class=". "review-list" .">";

                        foreach($reviews as $review){
                            $timestamp  = strtotime($review['reviewDate']);
                            
                            $review_list .= "<li>
                                                <div class=". "name" .">". substr($review['clientFirstname'], 0 , 1) . $review['clientLastname'] ."</div>
                                                <div class=". "review" .">". $review['reviewText'] ."</div>
                                                <div class=". "reviewDate" ."> review date: ". date('F j, Y, g:i a', $timestamp) . "</div>
                                            </li>";
                        }

                        $review_list .= "</ul>";

                        echo $review_list;

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