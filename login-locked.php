<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('connection.php');

// Start or resume session variables
session_start();

// If the user_ID session is not set, then the user has not logged in yet
if (!isset($_SESSION['user_ID']))
{
    // If the page is receiving the email and password from the login form then verify the login data
    if (isset($_POST['email']) && isset($_POST['password']))
    {
        $stmt = $conn->prepare("SELECT ID, password FROM user WHERE email=:email");
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->execute();
        
        $queryResult = $stmt->fetch();
        
        // Verify password submitted by the user with the hash stored in the database
        if(!empty($queryResult) && password_verify($_POST["password"], $queryResult['password']))
        {
            // Create session variable
            $_SESSION['user_ID'] = $queryResult['ID'];
            
            // Redirect to main page 
            header("Location: index.php");
        } else {
            // Password mismatch, show login page
            require('login.php');
            exit();
        }
    }
    else
    {
        // Show login page
        require('login.php');
        exit();
    }
}

?>