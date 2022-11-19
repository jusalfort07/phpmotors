<?php
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function navList($classifications){
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";

    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }

    $navList .= '</ul>';

    return $navList;
}

function buildClassificationsList($classifications){
    $classificationList = '<select name="classificationId" id="classificationList">';

    $classificationList .= '<option value="0" selected>Choose Car Classification</option>';

    foreach($classifications as $classification){
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    }

    $classificationList .= '</select>';

    return $classificationList;
}

function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';

    foreach ($vehicles as $vehicle) {
        $dv .= '<li>';
        $dv .= "<div><a href='/phpmotors/vehicles/?action=vehicle_detail&invId=".urlencode($vehicle['invId'])."'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a></div>";
        $dv .= '<hr>';
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicle_detail&invId=".urlencode($vehicle['invId'])."'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
        $dv .= "<span>$vehicle[invPrice] $</span>";
        $dv .= '</li>';
    }
    
    $dv .= '</ul>';
    
    return $dv;
   }
?>