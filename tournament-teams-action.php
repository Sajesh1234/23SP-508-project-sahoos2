<?php
require_once ('connection.php');

global $conn;

function listTeams()
{
    global $conn;
    
    $sqlQuery = "SELECT *
                 FROM Tournament_Teams
                 WHERE Tournament = :ID";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindvalue(':ID', $_POST['ID']);
    $stmt->execute();
    
    $numberRows = $stmt->rowCount();
    
    $dataTable = array();
    
    while ($sqlRow = $stmt->fetch()) {
        $dataRow = array();
        
       
        $dataRow[] = $sqlRow['Name'];
        $dataRow[] = $sqlRow['Team_Score'];
        
        $dataTable[] = $dataRow;
    }
    
    $output = array(
        "recordsTotal" => $numberRows,
        "recordsFiltered" => $numberRows,
        "data" => $dataTable
    );
    
    echo json_encode($output);
}


if(!empty($_POST['action']) && $_POST['action'] == 'listTeams') {
    listTeams();
}

?>