<?php
require_once ('connection.php');

global $conn;

function listPlayers()
{
    global $conn;
    
    $sqlQuery = "SELECT * FROM Player ";
    
    if (! empty($_POST["search"]["value"])) {
       $sqlQuery .= 'WHERE (u.Person_ID LIKE "%' . $_POST["search"]["value"] . '%" OR u.Team LIKE "%' . $_POST["search"]["value"] . '%"';
    }
    
    if (! empty($_POST["order"])) {
        $sqlQuery .= 'ORDER BY ' . ($_POST['order']['0']['column'] + 1) . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $sqlQuery .= 'ORDER BY `Person_ID` ASC ';
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
        
        $dataRow[] = $sqlRow['Person_ID'];
        $dataRow[] = $sqlRow['Wins'];
        $dataRow[] = $sqlRow['Draws'];
        $dataRow[] = $sqlRow['Losses'];
        $dataRow[] = $sqlRow['Play_count'];
        $dataRow[] = $sqlRow['Win_loss_ratio'];
        $dataRow[] = $sqlRow['Team'];
        
        $dataRow[] = '<button type="button" name="update" Email_Address="' . $sqlRow["Person_ID"] . '" class="btn btn-warning btn-sm update">Update</button>
                      <button type="button" name="delete" Email_Address="' . $sqlRow["Person_ID"] . '" class="btn btn-danger btn-sm delete" >Delete</button>';
        
        $dataTable[] = $dataRow;
    }
    
    $output = array(
        "recordsTotal" => $numberRows,
        "recordsFiltered" => $numberRows,
        "data" => $dataTable
    );
    
    echo json_encode($output);
}
    
function getPlayer()
{
    global $conn;
    
    if ($_POST["email"]) {
        
        $sqlQuery = "SELECT Person_ID as `Email Address`,
                     Wins, Draws, Losses, Play_count, Win_loss_ratio, Team
                     FROM Player
                     WHERE Person_ID = :Email_Address";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Email_Address', $_POST["email"]);
        $stmt->execute();
        
        echo json_encode($stmt->fetch());
    }
}

function updatePlayer()
{
    global $conn;
    
    if ($_POST['email']) {
        
        $sqlQuery = "UPDATE Player
                        SET
                        Wins = :Wins,
                        Draws = :Draws,
                        Losses = :Losses,
                        Play_count = :Play_count,
                        Team = :Team
                    WHERE Person_ID = :Email_Address";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Wins', $_POST["Wins"]);
        $stmt->bindValue(':Draws', $_POST["Draws"]);
        $stmt->bindValue(':Losses', $_POST["Losses"]);
        $stmt->bindValue(':Play_count', ($_POST["Wins"] + $_POST["Draws"] + $_POST["Losses"]));
        $stmt->bindValue(':Team', $_POST["Team"]);
        $stmt->bindValue(':Email_Address', $_POST["email"]);
        $stmt->execute();
    }
}

function addPlayer()
{
    global $conn;
    
    $sqlQuery = "INSERT INTO Player
                 (Person_ID, Wins, Draws, Losses, Play_count, Team)
                 VALUES
                 (:Email_Address, :Wins, :Draws, :Losses, :Play_count, :Team)";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':Email_Address', $_POST["email"]);
    $stmt->bindValue(':Wins', $_POST["Wins"]);
    $stmt->bindValue(':Draws', $_POST["Draws"]);
    $stmt->bindValue(':Losses', $_POST["Losses"]);
    $stmt->bindValue(':Play_count', ($_POST["Wins"] + $_POST["Draws"] + $_POST["Losses"]));
    $stmt->bindValue(':Team', $_POST["Team"]);
    $stmt->execute();
}

function deletePlayer()
{
    global $conn;
    
    if ($_POST["email"]) {
        
        $sqlQuery = "DELETE FROM Player WHERE Person_ID = :Email_Address";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Email_Address', $_POST["email"]);
        $stmt->execute();
    }
}

if(!empty($_POST['action']) && $_POST['action'] == 'listPlayers') {
    listPlayers();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addPlayer') {
    addPlayer();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getPlayer') {
    getPlayer();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updatePlayer') {
    updatePlayer();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deletePlayer') {
    deletePlayer();
}

?>