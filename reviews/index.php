<?php
// This is the reviews controller
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';

//Get the vehicles model
require_once '../model/reviews-model.php';
require_once '../library/functions.php';

$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = navList($classifications);

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch($action){
    case 'add_review':
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

        if(empty($reviewText) || empty($clientId)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            header('Location: ../vehicles/?action=vehicle_detail&invId=' . $invId)  ;
            exit;
        }

        $is_added = addReview($reviewText, $invId, $clientId);

        if($is_added === 1){
            header('Location: ../vehicles/?action=vehicle_detail&invId=' . $invId)  ;
            exit;
        } else {
            $message = "<p>Sorry your review has not been added successfully.</p>";
            header('Location: ../vehicles/?action=vehicle_detail&invId=' . $invId)  ;
            exit;
        }

        break;
    case 'edit_review':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $reviewInfo = getReviewById($reviewId);

        include '../view/review-edit.php';

        break;
    case 'edit_save':
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

        $reviewInfo = getReviewById($reviewId);

        if(empty($reviewText)){
            $message = "Please make sure that text area is not left empty.";

            include '../view/review-edit.php';
            exit;
        }

        $is_updated = updateReview($reviewId, $reviewText, $invId, $clientId);

        if($is_updated === 1){
            $reviews = getReviewsByClientId($_SESSION['clientData']['clientId']);
            $review_message = "<p>The review has been updated successfully.</p>";
            include '../view/admin.php';
            exit;
        } else {
            $reviews = getReviewsByClientId($_SESSION['clientData']['clientId']);
            $review_message = "<p>Sorry your review has not been updated successfully.</p>";
            include '../view/admin.php';
            exit;
        }
        break;
    case 'delete_review':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $reviewInfo = getReviewById($reviewId);

        include '../view/review-delete.php';

        break;
    case 'delete_save':
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));

        $is_deleted = deleteReview($reviewId);

        if($is_deleted === 1){
            $reviews = getReviewsByClientId($_SESSION['clientData']['clientId']);
            $review_message = "<p>The review has been deleted successfully.</p>";
            include '../view/admin.php';
            exit;
        } else {
            $reviews = getReviewsByClientId($_SESSION['clientData']['clientId']);
            $review_message = "<p>Sorry your review has not been deleted successfully.</p>";
            include '../view/admin.php';
            exit;
        }
    default:
        break;
}
?>