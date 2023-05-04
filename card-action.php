<?php
require_once ('connection.php');

global $conn;

function listCards()
{
    global $conn;
    
    $sqlQuery = "SELECT * FROM `Card_View`";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->execute();
    
    $numberRows = $stmt->rowCount();
    
    $dataTable = array();
    
    while ($sqlRow = $stmt->fetch()) {
        $dataRow = array();
        
       
        $dataRow[] = $sqlRow['Name'];
        $dataRow[] = $sqlRow['Rarity'];
        $dataRow[] = $sqlRow['Card_Text'];
        $dataRow[] = $sqlRow['Expansion'];
        
        $dataTable[] = $dataRow;
    }
    
    $output = array(
        "recordsTotal" => $numberRows,
        "recordsFiltered" => $numberRows,
        "data" => $dataTable
    );
    
    echo json_encode($dataTable);
}


if(!empty($_POST['action']) && $_POST['action'] == 'listTeams') {
    listTeams();
}

?>