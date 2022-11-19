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
                <div id="img_div">
                    <img src="<?php echo $vehicle['invImage']; ?>" alt="Image of <?php echo $vehicle['invMake'] . ' ' . $vehicle['invModel']; ?>">
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
        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>