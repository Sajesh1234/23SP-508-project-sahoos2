<?php
require_once ('connection.php');

global $conn;
// Start or resume session variables
session_start();

function listMatches()
{
    global $conn;
    
    $sqlQuery = "SELECT 
                    (SELECT GROUP_CONCAT(Name SEPARATOR ', ') FROM (SELECT concat(first_name, ' ', last_name) AS Name FROM Match_Players mp JOIN Users u ON (mp.Player = u.Email_Address) WHERE Game_Match = gm.ID) AS Names) AS Players, 
                    (SELECT concat(first_name, ' ', last_name) FROM Users WHERE Email_Address = gm.Winner) AS Winner, 
                    (SELECT Team FROM Player WHERE Person_ID = gm.Winner) AS Winner_Team, 
                    (SELECT concat(first_name, ' ', last_name) FROM Users WHERE Email_Address = gm.Ref) AS Ref, 
                    gm.Ref_notes 
                    FROM Game_Match gm
                    WHERE gm.ID IN (SELECT Game_Match FROM Match_Players WHERE Player = :email) ";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindvalue(':email', $_SESSION['user_ID']);
    $stmt->execute();
    
    $numberRows = $stmt->rowCount();
    
    $dataTable = array();
    
    while ($sqlRow = $stmt->fetch()) {
        $dataRow = array();
        $dataRow[] = $sqlRow['Players'];
        $dataRow[] = $sqlRow['Winner'];
        $dataRow[] = $sqlRow['Winner_Team'];
        $dataRow[] = $sqlRow['Ref'];
        $dataRow[] = $sqlRow['Ref_notes'];
        
        $dataTable[] = $dataRow;
    }
    
    $output = array(
        "recordsTotal" => $numberRows,
        "recordsFiltered" => $numberRows,
        "data" => $dataTable
    );
    
    echo json_encode($output);
}


if(!empty($_POST['action']) && $_POST['action'] == 'listMatches') {
    listMatches();
}

?>