<?php
// Vehicles Controller
require_once '../library/connections.php';
require_once '../model/main-model.php';

//Get the vehicles model
require_once '../model/vehicles-model.php';

$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";

foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}

// Build dynamic select using the $classifications array
$navList .= '</ul>';

$classificationList = '<select name="classificationId">';

$classificationList .= '<option value="0" selected>Choose Car Classification</option>';

foreach($classifications as $classification){
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
}

$classificationList .= '</select>';

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case "add_classification":
        include '../view/add-classification.php';
        break;

    case "save_classification":
        $classificationName = filter_input(INPUT_POST, 'classificationName');

        if(empty($classificationName)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-classification.php';
            exit;
        }

        $regOutcome = addCarClassification($classificationName);

        if($regOutcome === 1){
            $message = "<p>Successfully added $classificationName to car classifications.</p>";
            include '../view/vehicle-management.php';
            exit;
        } else {
            $message = "<p>Sorry, $classificationName has not been added successfully.</p>";
            include '../view/add-classification.php';
            exit;
        }

        break;

    case "add_vehicle":
        include '../view/add-vehicle.php';
        break;

    case "save_vehicle":
        $classificationId = filter_input(INPUT_POST, 'classificationId');
        $invMake = filter_input(INPUT_POST, 'invMake');
        $invModel = filter_input(INPUT_POST, 'invModel');
        $invDescription = filter_input(INPUT_POST, 'invDescription');
        $invImage = filter_input(INPUT_POST, 'invImage');
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invColor = filter_input(INPUT_POST, 'invColor');

        if(empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || 
            empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-vehicle.php';
            exit;
        }

        $regOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        if($regOutcome === 1){
            $message = "<p>Successfully added $invMake $invModel to inventory.</p>";
            include '../view/vehicle-management.php';
            exit;
        } else {
            $message = "<p>Sorry, $invMake $invModel has not been added successfully.</p>";
            include '../view/add-vehicle.php';
            exit;
        }

        break;

    default:
        include '../view/vehicle-management.php';
        break;
}

?>