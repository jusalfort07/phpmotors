<?php
//Model for Reviews

function getReviews(){
    exit;
}

function addReview($reviewText, $invId, $clientId){
    $db = phpmotorsConnect();

    $sql = 'INSERT INTO reviews (reviewText, invId, clientId)
            VALUES (:reviewText, :invId, :clientId)';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);

    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;

}

function getReviewByInventoryId($invId){
    $db = phpmotorsConnect(); 
    $sql = ' SELECT * FROM reviews INNER JOIN clients ON clients.clientId = reviews.clientId  WHERE invId = :invId ORDER BY reviewDate DESC'; 

    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT); 
    $stmt->execute(); 

    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    $stmt->closeCursor(); 
    
    return $reviews; 
}

function getReviewsByClientId($clientId){
    $db = phpmotorsConnect(); 
    $sql = ' SELECT * FROM reviews INNER JOIN inventory ON reviews.invId = inventory.invId WHERE clientId = :clientId ORDER BY reviewDate DESC'; 

    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); 
    $stmt->execute(); 

    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    $stmt->closeCursor(); 
    
    return $reviews; 
}

function getReviewById($reviewId){
    $db = phpmotorsConnect(); 
    $sql = ' SELECT * FROM reviews 
            INNER JOIN inventory ON reviews.invId = inventory.invId 
            INNER JOIN clients ON reviews.clientId = clients.clientId
            WHERE reviewId = :reviewId'; 

    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT); 
    $stmt->execute(); 

    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    $stmt->closeCursor(); 
    
    return $reviews; 
    exit;
}

function updateReview($reviewId, $reviewText, $invId, $clientId){
    $db = phpmotorsConnect();

    $sql = 'UPDATE reviews
            SET reviewText = :reviewText, 
                invId = :invId, 
	            clientId = :clientId
            WHERE reviewId = :reviewId';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_STR);

    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
}

function deleteReview($reviewId){
    $db = phpmotorsConnect();

    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);

    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
}
?>