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
    <link rel="stylesheet" href="/phpmotors/css/add-vehicle.css">
    <title>
        <?php 
            if(isset($invInfo['invMake'])){ 
	            echo "Delete $invInfo[invMake] $invInfo[invModel]";
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
            <h1>
                <?php 
                    if(isset($invInfo['invMake'])){ 
	                    echo "Delete $invInfo[invMake] $invInfo[invModel]";
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
                <div class="form-div">
                    <label for="invMake">Make</label>
                    <input type="text" name="invMake" id="invMake" readonly <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
                </div>
    
                <div class="form-div">
                    <label for="invModel">Model</label>
                    <input type="text" name="invModel" id="invModel" readonly <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
                </div>
    
                <div class="form-div">
                    <label for="invDescription">Description</label>
                    <input type="text" name="invDescription" id="invDescription" readonly <?php if(isset($invDescription)){ echo "value='$invDescription'"; } elseif(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'"; }?>>
                </div>
    
    
                <div class="form-button form-div">
                    <button type="submit" name="submit" value="Delete Vehicle">
                        Delete Vehicle
                    </button>
                    <input type="hidden" name="action" value="delete_vehicle">
                    <input type="hidden" name="invId" value="
                        <?php 
                            if(isset($invInfo['invId'])){
                                echo $invInfo['invId'];
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