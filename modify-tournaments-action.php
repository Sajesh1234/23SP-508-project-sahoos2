<?php
require_once ('connection.php');

global $conn;

function listTournaments()
{
    global $conn;
    
    $sqlQuery = "SELECT ID, Name, Year_of_Tournament, Prize, Location FROM Tournament ";
    
    if (! empty($_POST["search"]["value"])) {
       $sqlQuery .= 'WHERE (Name LIKE "%' . $_POST["search"]["value"] . '%" OR Year_of_Tournament LIKE "%' . $_POST["search"]["value"] .  '%" OR Prize LIKE "%' . $_POST["search"]["value"] . '%" OR Location LIKE "%' . $_POST["search"]["value"] . '%") ';
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
        $dataRow[] = $sqlRow['Name'];
        $dataRow[] = $sqlRow['Year_of_Tournament'];
        $dataRow[] = $sqlRow['Prize'];
        $dataRow[] = $sqlRow['Location'];
        
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
    
function getTournament()
{
    global $conn;
    
    if ($_POST["ID"]) {
        
        $sqlQuery = "SELECT Name, Year_of_Tournament, Prize, Location FROM Tournament 
                     WHERE ID = :ID";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':ID', $_POST["ID"]);
        $stmt->execute();
        
        echo json_encode($stmt->fetch());
    }
}

function updateTournament()
{
    global $conn;
    
    if ($_POST['ID']) {
        
        $sqlQuery = "UPDATE Tournament
                        SET
                        Name = :Name,
                        Year_of_Tournament = :Year_of_Tournament,
                        Prize = :Prize,
                        Location = :Location
                    WHERE ID = :ID";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Name', $_POST["Name"]);
        $stmt->bindValue(':Year_of_Tournament', $_POST["Year_of_Tournament"]);
        $stmt->bindValue(':Prize', $_POST["Prize"]);
        $stmt->bindValue(':Location', $_POST["Location"]);
        $stmt->bindValue(':ID', $_POST["ID"]);
        $stmt->execute();
    }
}

function addTournament()
{
    global $conn;
    
    $sqlQuery = "INSERT INTO Tournament
                 (Name, Year_of_Tournament, Prize, Location)
                 VALUES
                 (:Name, :Year_of_Tournament, :Prize, :Location)";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':Name', $_POST["Name"]);
    $stmt->bindValue(':Year_of_Tournament', $_POST["Year_of_Tournament"]);
    $stmt->bindValue(':Prize', $_POST["Prize"]);
    $stmt->bindValue(':Location', $_POST["Location"]);
    $stmt->execute();
}

function deleteTournament()
{
    global $conn;
    
    if ($_POST["ID"]) {
        
        $sqlQuery = "DELETE FROM Tournament WHERE ID = :ID";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':ID', $_POST["ID"]);
        $stmt->execute();
    }
}

if(!empty($_POST['action']) && $_POST['action'] == 'listTournaments') {
    listTournaments();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addTournament') {
    addTournament();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getTournament') {
    getTournament();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateTournament') {
    updateTournament();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteTournament') {
    deleteTournament();
}

?>