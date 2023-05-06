<?php
require_once ('connection.php');

global $conn;

// Start or resume session variables
session_start();

function listDecks()
{
    global $conn;
    
    $sqlQuery = "SELECT Name FROM Deck WHERE Player = :email ";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':email', $_SESSION['user_ID']);
    $stmt->execute();
    
    $numberRows = $stmt->rowCount();
    
    $dataTable = array();
    
    while ($sqlRow = $stmt->fetch()) {
        $dataRow = array();
        
       
        $dataRow[] = $sqlRow['Name'];
        $dataRow[] = '<a href="edit-deck?name=' . $sqlRow["Name"] . '" class="btn">Edit Deck</a>
                      <button type="button" name="delete" Name="' . $sqlRow["Name"] . '" class="btn btn-danger btn-sm delete" >Delete</button>';
        
        $dataTable[] = $dataRow;
    }
    
    $output = array(
        "recordsTotal" => $numberRows,
        "recordsFiltered" => $numberRows,
        "data" => $dataTable
    );
    
    echo json_encode($output);
}

function addDeck()
{
    global $conn;
    
    $sqlQuery = "INSERT INTO Deck
                 (Name, Player)
                 VALUES
                 (:Name, :Player)";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':Name', $_POST["Name"]);
    $stmt->bindValue(':Player', $_SESSION["user_ID"]);
    $stmt->execute();
}

function deleteDeck()
{
    global $conn;
    
    if ($_POST["Name"]) {
        
        $sqlQuery = "DELETE FROM Deck WHERE (Name = :Name `AND Player = :Player) ";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Name', $_POST["Name"]);
        $stmt->bindValue(':Player', $_SESSION["user_ID"]);
        $stmt->execute();
    }
}


if(!empty($_POST['action']) && $_POST['action'] == 'listDecks') {
    listDecks();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addDeck') {
    addDeck();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteDeck') {
    deleteDeck();
}

?>