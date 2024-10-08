<?php
require_once ('connection.php');

session_start();

global $conn;

function updateUserInfo()
{
    global $conn;
    
    if ($_SESSION["user_ID"]) {
        
        $sqlQuery = "UPDATE Users
                        SET
                        first_name = :firstname,
                        last_name = :lastname
                    WHERE Email_Address = :ID";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':firstname', $_POST["firstname"]);
        $stmt->bindValue(':lastname', $_POST["lastname"]);
        $stmt->bindValue(':ID', $_SESSION["user_ID"]);
        $stmt->execute();
    }
}


if(!empty($_POST['action']) && $_POST['action'] == 'update') {
    updateUserInfo();
}

?>