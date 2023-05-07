<?php
require_once ('connection.php');

global $conn;

function listMatches()
{
    global $conn;
    
    $sqlQuery = "SELECT * FROM Match_Admin ";
    
    if (! empty($_POST["search"]["value"])) {
       $sqlQuery .= 'WHERE (Winner LIKE "%' . $_POST["search"]["value"] . '%" OR Tournament LIKE "%' . $_POST["search"]["value"] . '%" OR Ref LIKE "%' . $_POST["search"]["value"] . '%" OR Ref_notes LIKE "%' . $_POST["search"]["value"] . '%") ';
    }
    
    if (! empty($_POST["order"])) {
        $sqlQuery .= 'ORDER BY ' . ($_POST['order']['0']['column'] + 1) . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $sqlQuery .= 'ORDER BY ID ASC ';
    }
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->execute();
    
    $numberRows = $stmt->rowCount();
    
    if ($_POST["length"] != - 1) {
        $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->execute();
    
    $dataTable = array();
    
    while ($sqlRow = $stmt->fetch()) {
        $dataRow = array();
        
        $dataRow[] = $sqlRow['ID'];
        $dataRow[] = $sqlRow['Players'];
        $dataRow[] = $sqlRow['Winner_Email'];
        $dataRow[] = $sqlRow['Winner_Team'];
        $dataRow[] = $sqlRow['TID'];
        $dataRow[] = $sqlRow['Tournament'];
        $dataRow[] = $sqlRow['Ref'];
        $dataRow[] = $sqlRow['Ref_notes'];
        
        $dataRow[] = '<button type="button" name="update" ID="' . $sqlRow["ID"] . '" class="btn btn-warning btn-sm update">Update</button>
                      <button type="button" name="delete" ID="' . $sqlRow["ID"] . '" class="btn btn-danger btn-sm delete" >Delete</button>';
        
        $dataTable[] = $dataRow;
    }
    
    $output = array(
        "recordsTotal" => $numberRows,
        "recordsFiltered" => $numberRows,
        "data" => $dataTable
    );
    
    echo json_encode($output);
}
    
function getMatch()
{
    global $conn;
    
    if ($_POST["ID"]) {
        
        $sqlQuery = "SELECT *
                     FROM Match_Admin
                     WHERE ID = :ID";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':ID', $_POST["ID"]);
        $stmt->execute();
        
        echo json_encode($stmt->fetch());
    }
}

function updateMatch()
{
    global $conn;
    
    if ($_POST['ID']) {
        
        $sqlQuery = "UPDATE Game_Match
                        SET
                        Winner = :Winner,
                        Tournament = :TID,
                        Ref = :Ref,
                        Ref_notes = :Ref_notes
                    WHERE ID = :ID";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Winner', $_POST["Winner"]);
        $stmt->bindValue(':TID', $_POST["TID"]);
        $stmt->bindValue(':Ref', $_POST["Ref"]);
        $stmt->bindValue(':Ref_notes', $_POST["Ref_notes"]);
        $stmt->bindValue(':ID', $_POST["ID"]);
        $stmt->execute();
    }
}

function addMatch()
{
    global $conn;
    
    $sqlQuery = "INSERT INTO Game_Match
                 (Winner, Tournament, Ref, Ref_notes)
                 VALUES
                 (:Winner, :TID, :Ref, :Ref_notes)";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':Winner', $_POST["Winner"]);
    $stmt->bindValue(':TID', $_POST["TID"]);
    $stmt->bindValue(':Ref', $_POST["Ref"]);
    $stmt->bindValue(':Ref_notes', $_POST["Ref_notes"]);
    $stmt->execute();
    
    foreach ($_POST['Players'] as $player) {}
        $sqlQuery = "INSERT INTO Match_Players
                     (Game_Match, Player)
                     VALUES
                     (:ID, :Player)";
    
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Winner', $_POST["ID"]);
        $stmt->bindValue(':Player', $player);
        $stmt->execute();
    }
}

function deleteMatch()
{
    global $conn;
    
    if ($_POST["ID"]) {
        
        $sqlQuery = "DELETE FROM Game_Match WHERE ID = :ID";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':ID', $_POST["ID"]);
        $stmt->execute();
    }
}

if(!empty($_POST['action']) && $_POST['action'] == 'listMatches') {
    listMatches();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addMatch') {
    addMatch();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getMatch') {
    getMatch();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateMatch') {
    updateMatch();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteMatch') {
    deleteMatch();
}

?>