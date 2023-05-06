<?php
require_once ('connection.php');

global $conn;

function updateUserInfo()
{
    global $conn;
    
    if ($_SESSION["user_ID"]) {
        
        $sqlQuery = "UPDATE User
                        SET
                        first_name = :firstname,
                        last_name = :lastname
                    WHERE ID = :ID";
        
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