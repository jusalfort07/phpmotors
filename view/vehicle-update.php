<?php
    if(!isset($_SESSION['loggedin'])){
        header("Location: /phpmotors/");
    } else if ($_SESSION['clientData']['clientLevel'] == 1){
        header("Location: /phpmotors/");
    }

    // Build dynamic select using the $classifications array
    $classificationList = '<select name="classificationId">';

    $classificationList .= '<option value="0" selected>Choose Car Classification</option>';

    foreach($classifications as $classification){
        $classificationList .= "<option value='$classification[classificationId]' ";

        if(isset($classificationId)){
            if($classificationId == $classification['classificationId'] || $invInfo['classificationId'] == $classification['classificationId']){
                $classificationList .= "selected";
            }
        } else if (isset($invInfo['classificationId'])) {
            if($invInfo['classificationId'] == $classification['classificationId']){
                $classificationList .= "selected";
            }
        }

        $classificationList .= " >$classification[classificationName]</option>";
    }

    $classificationList .= '</select>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/phpmotors/css/style.css">
    <link rel="stylesheet" href="/phpmotors/css/add-vehicle.css">
    <title>
        <?php 
            if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	            echo "Modify $invInfo[invMake] $invInfo[invModel]";
            } elseif(isset($invMake) && isset($invModel)) { 
		        echo "Modify $invMake $invModel"; 
            }
        ?> 
        | PHP Motors
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
            <h1>
                <?php 
                    if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	                    echo "Modify $invInfo[invMake] $invInfo[invModel]";
                    } elseif(isset($invMake) && isset($invModel)) { 
	                    echo "Modify$invMake $invModel"; 
                    }
                ?>
            </h1>

            <div class="error-message">
                <?php
                    if(isset($message)){
                        echo $message;
                    }
                ?>
            </div>

            <form action="/phpmotors/vehicles/index.php" method="POST">
                <div  class="form-div car-classification">
                    <label>Classification</label>
                    <?php echo $classificationList ?>
                </div>
    
                <div class="form-div">
                    <label for="invMake">Make</label>
                    <input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
                </div>
    
                <div class="form-div">
                    <label for="invModel">Model</label>
                    <input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
                </div>
    
                <div class="form-div">
                    <label for="invDescription">Description</label>
                    <input type="text" name="invDescription" id="invDescription" required <?php if(isset($invDescription)){ echo "value='$invDescription'"; } elseif(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'"; }?>>
                </div>
    
                <div class="form-div">
                    <label for="invImage">Image Path</label>
                    <input type="text" name="invImage" id="invImage" required <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>>
                </div>
    
                <div class="form-div">
                    <label for="invThumbnail">Thumbnail Path</label>
                    <input type="text" name="invThumbnail" id="invThumbnail" required <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>>
                </div>
    
                <div class="form-div">
                    <label for="invPrice">Price</label>
                    <input type="number" name="invPrice" id="invPrice" required <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>>
                </div>
    
                <div class="form-div">
                    <label for="invStock">Stock</label>
                    <input type="number" name="invStock" id="invStock" required <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>>
                </div>
    
                <div class="form-div">
                    <label for="invColor">Color</label>
                    <input type="text" name="invColor" id="invColor" required <?php if(isset($invColor)){ echo "value='$invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>>
                </div>
    
                <div class="form-button form-div">
                    <button type="submit" name="submit" value="Update Vehicle">
                        Modify Vehicle
                    </button>
                    <input type="hidden" name="action" value="update_vehicle">
                    <input type="hidden" name="invId" value="
                        <?php 
                            if(isset($invInfo['invId'])){ 
                                echo $invInfo['invId'];
                            } elseif(isset($invId)){ 
                                echo $invId; 
                            } 
                        ?>
                    ">
                </div>
            </form>
        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>