<?php
require_once ('connection.php');

global $conn;

// Start or resume session variables
session_start();

function listCards()
{
    global $conn;
    
    $sqlQuery = "SELECT ID, Name, Rarity, Card_Text, Expansion, 
                (SELECT IF(
                        (SELECT Card FROM Deck_Cards WHERE (Deck = :Deck AND Player = :Player AND Card = ID)),
                        TRUE,
                        FALSE
                    )
                ) AS In_Deck 
                FROM Card ";
    
    if (! empty($_POST["search"]["value"])) {
       $sqlQuery .= 'WHERE (Name LIKE "%' . $_POST["search"]["value"] . '%" OR Rarity LIKE "%' . $_POST["search"]["value"] .  '%" OR Card_Text LIKE "%' . $_POST["search"]["value"] . '%" OR Expansion LIKE "%' . $_POST["search"]["value"] . '%") ';
    }
    
    if (! empty($_POST["order"])) {
        $sqlQuery .= 'ORDER BY ' . ($_POST['order']['0']['column'] + 1) . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $sqlQuery .= 'ORDER BY ID ASC ';
    }
    
    if ($_POST["length"] != - 1) {
        $sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }    
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindvalue(':Deck', $_GET['name']);
    $stmt->bindvalue(':Player', $_SESSION['user_ID']);
    $stmt->execute();

    $numberRows = $stmt->rowCount();
    
    $dataTable = array();
    
    while ($sqlRow = $stmt->fetch()) {
        $dataRow = array();
        
        $dataRow[] = $sqlRow['ID'];
        $dataRow[] = $sqlRow['Name'];
        $dataRow[] = $sqlRow['Rarity'];
        $dataRow[] = $sqlRow['Card_Text'];
        $dataRow[] = $sqlRow['Expansion'];
        
        $dataRow[] = '<button type="button" name="add" ID="' . $sqlRow["ID"] . '" class="btn btn-success btn-sm add">Add to Deck</button>
                      <button type="button" name="delete" ID="' . $sqlRow["ID"] . '" class="btn btn-danger btn-sm delete" >Remove from Deck</button>';
        
        $dataTable[] = $dataRow;
    }
    
    $output = array(
        "recordsTotal" => $numberRows,
        "recordsFiltered" => $numberRows,
        "data" => $dataTable
    );
    
    echo json_encode($output);
}
    
function getCard()
{
    global $conn;
    
    if ($_POST["ID"]) {
        
        $sqlQuery = "SELECT Name, Rarity, Card_Text, Expansion FROM Card 
                     WHERE ID = :ID";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':ID', $_POST["ID"]);
        $stmt->execute();
        
        echo json_encode($stmt->fetch());
    }
}

function updateCard()
{
    global $conn;
    
    if ($_POST['ID']) {
        
        $sqlQuery = "UPDATE Card
                        SET
                        Name = :Name,
                        Rarity = :Rarity,
                        Card_Text = :Card_Text,
                        Expansion = :Expansion
                    WHERE ID = :ID";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Name', $_POST["Name"]);
        $stmt->bindValue(':Rarity', $_POST["Rarity"]);
        $stmt->bindValue(':Card_Text', $_POST["Card_Text"]);
        $stmt->bindValue(':Expansion', $_POST["Expansion"]);
        $stmt->bindValue(':ID', $_POST["ID"]);
        $stmt->execute();
    }
}

function addCard()
{
    global $conn;
    
    $sqlQuery = "INSERT INTO Card
                 (Name, Rarity, Card_Text, Expansion)
                 VALUES
                 (:Name, :Rarity, :Card_Text, :Expansion)";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':Name', $_POST["Name"]);
    $stmt->bindValue(':Rarity', $_POST["Rarity"]);
    $stmt->bindValue(':Card_Text', $_POST["Card_Text"]);
    $stmt->bindValue(':Expansion', $_POST["Expansion"]);
    $stmt->execute();
}

function deleteCard()
{
    global $conn;
    
    if ($_POST["ID"]) {
        
        $sqlQuery = "DELETE FROM Card WHERE ID = :ID";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':ID', $_POST["ID"]);
        $stmt->execute();
    }
}

if(!empty($_POST['action']) && $_POST['action'] == 'listCards') {
    listCards();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addCard') {
    addCard();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getCard') {
    getCard();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateCard') {
    updateCard();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteCard') {
    deleteCard();
}

?>