<?php
session_start();
// This is the accounts controller.
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';
require_once '../model/reviews-model.php';
require_once '../library/functions.php';

$classifications = getClassifications();

$navList = navList($classifications);
    
$action = filter_input(INPUT_POST, 'action');

if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'login':
        include '../view/login.php';
        break;

    case 'Login':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        if(empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please enter your Email and Password to Log-in.</p>';
            include '../view/login.php';
            exit; 
        }

        $clientData = getClient($clientEmail);
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

        if(!$hashCheck){
            $message = '<p class="notice">Please check your password and try again.</p>';
            $_SESSION['message'] = $message;
            include '../view/login.php';
            exit;
        }

        $_SESSION['loggedin'] = TRUE;
        array_pop($clientData);
        $_SESSION['clientData'] = $clientData;

        $reviews = getReviewsByClientId($_SESSION['clientData']['clientId']);

        include '../view/admin.php';

        break;

    case 'Logout':
        session_unset();
        session_destroy();

        header('Location: /phpmotors/');
        break;
    case 'registration':
        include '../view/registration.php';
        break;

    case 'register':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        //Check if email already exists in the database
        $emailExisting = isEmailExist($clientEmail);

        if($emailExisting){
            $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit; 
        }

        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        if($regOutcome === 1){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');

            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }

        break;

    case 'mod';

        include '../view/client-update.php';

        break;

    case 'update_account':
        if($_SESSION['clientData']['clientEmail'] == trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL))){
            $clientEmail = $_SESSION['clientData']['clientEmail'];
        } else {
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));

            $emailExisting = isEmailExist($clientEmail);

            if($emailExisting){
                $account_message = '<p class="notice">That email address already exists. Please choose input a different email.</p>';
                include '../view/client-update.php';
                exit;
            }

            $clientEmail = checkEmail($clientEmail);
        }

        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $account_message = '<p>Please provide valid information for all of the fields.</p>';
            include '../view/client-update.php';
            exit; 
        }

        $updateResult = updateClient($clientEmail, $clientFirstname, $clientLastname, $clientId);

        if($updateResult){
            $message = "<p class='notify'>Congratulations, your account has been successfully updated.</p>";
            $_SESSION['message'] = $message;

            $clientData = getClientById($clientId);
            array_pop($clientData);
            $_SESSION['clientData'] = $clientData;

            header('location: /phpmotors/accounts/');

            exit;
        } else {
            $message = "<p>Sorry, your account has not been updated successfully.</p>";
            header('location: /phpmotors/accounts/');

            exit;
        }
        
        break;

        case 'update_password':
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

            $checkPassword = checkPassword($clientPassword);

            if(empty($checkPassword)){
                $password_message = '<p>Please provide valid information for password field</p>';
                include '../view/client-update.php';
                exit; 
            }

            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            $updateResult = updateClientPassword($hashedPassword, $clientId);

            if($updateResult){
                $message = "<p class='notify'>Congratulations, your password has been successfully updated.</p>";
                $_SESSION['message'] = $message;
    
                header('location: /phpmotors/accounts/');
    
                exit;
            } else {
                $message = "<p>Sorry, your password has not been updated successfully.</p>";
                header('location: /phpmotors/accounts/');
    
                exit;
            }


    default:
        $reviews = getReviewsByClientId($_SESSION['clientData']['clientId']);
        
        include '../view/admin.php';

        break;
}
?>