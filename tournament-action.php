<?php
require_once ('connection.php');

global $conn;

function listTournaments()
{
    global $conn;
    
    $sqlQuery = "SELECT * FROM `Tournament_View`";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->execute();
    
    $numberRows = $stmt->rowCount();
    
    $dataTable = array();
    
    while ($sqlRow = $stmt->fetch()) {
        $dataRow = array();
        
       
        $dataRow[] = $sqlRow['Name'];
        $dataRow[] = $sqlRow['Year_of_Tournament'];
        $dataRow[] = $sqlRow['Prize'];
        $dataRow[] = $sqlRow['Location'] + "eee";
        
        $dataTable[] = $dataRow;
    }
    
    $output = array(
        "recordsTotal" => $numberRows,
        "recordsFiltered" => $numberRows,
        "data" => $dataTable
    );
    
    echo json_encode($output);
}


if(!empty($_POST['action']) && $_POST['action'] == 'listTournaments') {
    listTournaments();
}

?>