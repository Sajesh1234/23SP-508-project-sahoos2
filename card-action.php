<?php
require_once ('connection.php');

global $conn;

function listCards()
{
    global $conn;
    
    $sqlQuery = "SELECT *
                 FROM
                 Card_View";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->execute();
    
    $numberRows = $stmt->rowCount();
    
    $data = array();
    while ($row = mysql_fetch_assoc($results)) {
       $data[] = $row;
    }
    echo json_encode($data);
}


if(!empty($_POST['action']) && $_POST['action'] == 'listTeams') {
    listTeams();
}

?>