<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/home.css" media="screen">

    <title>Home | PHP Motors</title>
</head>
<body>
    <div class="content" id="content">
        <header>
            <?php 
                require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; 
            ?>

            <br>
        </header>

        <nav>
            <?php
                // require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navigation.php';
                echo $navList;
            ?>
        </nav>

        <main>
            <h2>Welcome to PHP Motors!</h2>

            <div class="delorean">
                <img src="images/vehicles/delorean.jpg" alt="">

                <div class="delorean-card">
                    <div class="card-text">
                        <h3>DMC Delorean</h3>
                        <p>3 cup holders!</p>
                        <p>Superman doors</p>
                        <p>Fuzzy Dice</p>
                    </div>
                    
                    <div class="card-btn">
                        <button>Own Today</button>
                    </div>
                </div>

            </div>

            <div class="delorean-info">
                <div class="delorean-reviews">
                    <h2>DMC Delorean Reviews</h2>
                    <ul>
                        <li>"So fast its almost like traveling in time." (4/5)</li>
                        <li>"Coolest ride on the road." (4/5)</li>
                        <li>"I'm feeling Marty McFly!" (5/5)</li>
                        <li>"The most futuristic ride of our day." (4.5/5)</li>
                        <li>"80's livin and I love it!" (5/5)</li>
                    </ul>
                </div>

                <div class="delorean-upgrades">
                    <h2>Delorean Upgrades</h2>
                    <div class="upgrade-items">
                        <div class="upgrade">
                            <img src="images/upgrades/flux-cap.png" alt="">
                        </div>

                        <div class="upgrade">
                            <img src="images/upgrades/flame.jpg" alt="">
                        </div>

                        <div class="upgrade-name">
                            <a href="">Flux Capacitor</a>
                        </div>

                        <div class="upgrade-name">
                            <a href="">Flame Decals</a>
                        </div>

                        <div class="upgrade">
                            <img src="images/upgrades/bumper_sticker.jpg" alt="">
                        </div>

                        <div class="upgrade">
                            <img src="images/upgrades/hub-cap.jpg" alt="">
                        </div>

                        <div class="upgrade-name">
                            <a href="">Bumper Stickers</a>
                        </div>

                        <div class="upgrade-name">
                            <a href="">Hub Caps</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>
</html>