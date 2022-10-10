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
            <form action="/phpmotors/vehicles/index.php" method="POST">
                <div  class="form-div car-classification">
                    <label for="classifcationId">Classification</label>
                    <?php echo $classificationList ?>
                </div>
    
                <div class="form-div">
                    <label for="invMake">Make</label>
                    <input type="text" id="invMake" name="invMake">
                </div>
    
                <div class="form-div">
                    <label for="invModel">Model</label>
                    <input type="text" id="invModel" name="invModel">
                </div>
    
                <div class="form-div">
                    <label for="invDescription">Description</label>
                    <input type="text" id="invDescription" name="invDescription">
                </div>
    
                <div class="form-div">
                    <label for="invImage">Image Path</label>
                    <input type="text" id="invImage" name="invImage">
                </div>
    
                <div class="form-div">
                    <label for="invThumbnail">Thumbnail Path</label>
                    <input type="text" id="invThumbnail" name="invThumbnail">
                </div>
    
                <div class="form-div">
                    <label for="invPrice">Price</label>
                    <input type="number" id="invPrice" name="invPrice">
                </div>
    
                <div class="form-div">
                    <label for="invStock">Stock</label>
                    <input type="number" id="invStock" name="invStock">
                </div>
    
                <div class="form-div">
                    <label for="invColor">Color</label>
                    <input type="text" id="invColor" name="invColor">
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