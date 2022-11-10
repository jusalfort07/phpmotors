<?php
// Accounts Model

// Register a new client

function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
    $db = phpmotorsConnect();

    $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
            VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);

    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
}

// Function to check if email exists
function isEmailExist($clientEmail){
    $db = phpmotorsConnect();

    $sql = 'SELECT clientEmail From clients WHERE clientEmail = :email ';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();

    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();

    if(empty($matchEmail)){
        return 0;
    } else {
        return 1;
    }
}

// Get client data based on an email address
function getClient($clientEmail){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
    return $clientData;
}

function getClientById($clientId){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientId = :clientId';
    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
    return $clientData;
}

function updateClient($clientEmail, $clientFirstname, $clientLastname, $clientId){
    $db = phpmotorsConnect();

    $sql = 'UPDATE clients
            SET clientEmail = :clientEmail, 
                clientFirstname = :clientFirstname, 
	            clientLastname = :clientLastname
            WHERE clientId = :clientId';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
}

function updateClientPassword($hashedPassword, $clientId){
    $db = phpmotorsConnect();

    $sql = 'UPDATE clients
            SET clientPassword = :hashedPassword
            WHERE clientId = :clientId';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
}
?>