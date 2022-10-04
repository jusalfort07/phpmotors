<?php
// Proxy Connection to the phpmotors database

function phpmotorsConnect(){
    $server = 'localhost';
    $dbname= 'phpmotors';
    $username = 'phpmotors_client';
    $password = 'x4DYu3RmmwDkWcly'; 
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
   
    try {
    $link = new PDO($dsn, $username, $password, $options);
        // if(is_object($link)){
        //     echo "Success";
        // }
        return $link;
    } catch(PDOException $error) {
        // echo "It didn't work, error: " . $error->getMessage();
        header('Location: /phpmotors/view/500.php');
        exit;
    }
}

phpmotorsConnect();
?>