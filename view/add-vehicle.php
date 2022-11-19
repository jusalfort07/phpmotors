<?php
    if(!isset($_SESSION['loggedin'])){
        header("Location: /phpmotors/");
    } else if ($_SESSION['clientData']['clientLevel'] == 1){
        header("Location: /phpmotors/");
    }
?>
<?php 
// Build dynamic select using the $classifications array
$classificationList = '<select name="classificationId">';

$classificationList .= '<option value="0" selected>Choose Car Classification</option>';

foreach($classifications as $classification){
    $classificationList .= "<option value='$classification[classificationId]' ";

    if(isset($classificationId)){
        if($classificationId == $classification['classificationId']){
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
    <title>Add Vehicle | PHP Motors</title>
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
            <h1>Add Vehicle</h1>

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
                    <input type="text" id="invMake" name="invMake" value="<?php if(isset($invMake)){ echo $invMake; }?>" required>
                </div>
    
                <div class="form-div">
                    <label for="invModel">Model</label>
                    <input type="text" id="invModel" name="invModel" value="<?php if(isset($invModel)){ echo $invModel; }?>" required>
                </div>
    
                <div class="form-div">
                    <label for="invDescription">Description</label>
                    <input type="text" id="invDescription" name="invDescription" value="<?php if(isset($invDescription)){ echo $invDescription; }?>" required>
                </div>
    
                <div class="form-div">
                    <label for="invImage">Image Path</label>
                    <input type="text" id="invImage" name="invImage" value="<?php if(isset($invImage)){ echo $invImage ;} else { echo "/phpmotors/images/vehicles/no-image.png"; } ?>" required>
                </div>
    
                <div class="form-div">
                    <label for="invThumbnail">Thumbnail Path</label>
                    <input type="text" id="invThumbnail" name="invThumbnail" value="<?php if(isset($invThumbnail)){ echo $invThumbnail ;} else { echo "/phpmotors/images/vehicles/no-image.png"; } ?>" required>
                </div>
    
                <div class="form-div">
                    <label for="invPrice">Price</label>
                    <input type="number" id="invPrice" name="invPrice" value="<?php if(isset($invPrice)){ echo $invPrice; }?>" required>
                </div>
    
                <div class="form-div">
                    <label for="invStock">Stock</label>
                    <input type="number" id="invStock" name="invStock" value="<?php if(isset($invStock)){ echo $invStock; }?>" required>
                </div>
    
                <div class="form-div">
                    <label for="invColor">Color</label>
                    <input type="text" id="invColor" name="invColor" value="<?php if(isset($invColor)){ echo $invColor; }?>" required>
                </div>
    
                <div class="form-button form-div">
                    <button type="submit">
                        Add Vehicle
                    </button>
                    <input type="hidden" name="action" value="save_vehicle">
                </div>
            </form>
        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>