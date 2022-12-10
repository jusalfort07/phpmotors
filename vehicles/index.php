<?php
session_start();
// Vehicles Controller
require_once '../library/connections.php';
require_once '../model/main-model.php';

//Get the vehicles model
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';
require_once '../model/reviews-model.php';
require_once '../library/functions.php';

$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = navList($classifications);

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case "add_classification":
        include '../view/add-classification.php';
        break;

    case "save_classification":
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        if(empty($classificationName)){
            $message = '<p>*Please provide information for all empty form fields.</p>';
            include '../view/add-classification.php';
            exit;
        }

        $regOutcome = addCarClassification($classificationName);

        if($regOutcome === 1){
            header('Location: http://localhost/phpmotors/vehicles/index.php'); 
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
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        if(empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || 
            empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-vehicle.php';
            exit;
        }

        $regOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        if($regOutcome === 1){
            $message = "<p>Successfully added $invMake $invModel to inventory.</p>";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = "<p>Sorry, $invMake $invModel has not been added successfully.</p>";
            include '../view/add-vehicle.php';
            exit;
        }

        break;

    case 'update_vehicle':
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        if(empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || 
            empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/vehicle-update.php';
            exit;
        }

        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

        if($updateResult){
            $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;

            header('location: /phpmotors/vehicles/');

            exit;
        } else {
            $message = "<p>Sorry, $invMake $invModel has not been updated successfully.</p>";
            include '../view/vehicle-update.php';

            exit;
        }

        break;

    case 'delete_vehicle':
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteVehicle($invId);

        if($deleteResult){
            $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully deleted.</p>";
            $_SESSION['message'] = $message;

            header('location: /phpmotors/vehicles/');

            exit;
        } else {
            $message = "<p>Sorry, $invMake $invModel has not been deleted successfully.</p>";
            $_SESSION['message'] = $message;
            
	        header('location: /phpmotors/vehicles/');

            exit;
        }

        break;

    case 'getInventoryItems': 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        $inventoryArray = getInventoryByClassification($classificationId); 

        echo json_encode($inventoryArray); 
        break;

    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);

        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }

        include '../view/vehicle-update.php';

        break;

    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);

        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }

        include '../view/vehicle-delete.php';

        break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);

        if(!count($vehicles)){
            $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }

        include '../view/classification.php';
        
        break;

    case 'vehicle_detail':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $vehicle = getVehicleDetail($invId);
        $otherImages = getOtherImages($invId);
        $otherImagesList = buildOtherImagesList($otherImages);

        $reviews = getReviewByInventoryId($invId);

        if($vehicle == false) {
            $message = 'Sorry, we cannot find that vehicle.';

            include '../view/vehicle-detail.php';
            exit;
        }

        include '../view/vehicle-detail.php';

        break;
    default:
        $classificationList = buildClassificationsList($classifications);
        
        include '../view/vehicle-management.php';
        break;
}

?>