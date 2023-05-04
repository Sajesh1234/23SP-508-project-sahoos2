<?php
require_once ('connection.php');

global $conn;

function listUsers()
{
    global $conn;
    
    $sqlQuery = "SELECT u.Email_Address as `Email Address`,
                        concat(u.first_name, ' ', u.last_name) as `Name`,
                        u.date_of_birth as `Date of Birth`,
                        u.type as `Type`
                 FROM Users u ";
    
    if (! empty($_POST["search"]["value"])) {
       $sqlQuery .= 'WHERE (u.Email_Address LIKE "%' . $_POST["search"]["value"] . '%" OR u.first_name LIKE "%' . $_POST["search"]["value"] . '%" OR u.last_name LIKE "%' . $_POST["search"]["value"] . '%" or u.type LIKE "%' . $_POST["search"]["value"] . '%") ';
    }
    
    if (! empty($_POST["order"])) {
        $sqlQuery .= 'ORDER BY ' . ($_POST['order']['0']['column'] + 1) . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $sqlQuery .= 'ORDER BY `Name` ASC ';
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
        
        $dataRow[] = $sqlRow['Email Address'];
        $dataRow[] = $sqlRow['Name'];
        $dataRow[] = $sqlRow['Date of Birth'];
        $dataRow[] = $sqlRow['Type'];
        
        $dataRow[] = '<button type="button" name="update" Email_Address="' . $sqlRow["Email Address"] . '" class="btn btn-warning btn-sm update">Update</button>
                      <button type="button" name="delete" Email_Address="' . $sqlRow["Email Address"] . '" class="btn btn-danger btn-sm delete" >Delete</button>';
        
        $dataTable[] = $dataRow;
    }
    
    $output = array(
        "recordsTotal" => $numberRows,
        "recordsFiltered" => $numberRows,
        "data" => $dataTable
    );
    
    echo json_encode($output);
}
    
function getUser()
{
    global $conn;
    
    if ($_POST["email"]) {
        
        $sqlQuery = "SELECT Email_Address as `Email Address`,
                        first_name,
                        last_name,
                        date_of_birth,
                        type
                     FROM Users
                     WHERE Email_Address = :Email_Address";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Email_Address', $_POST["email"]);
        $stmt->execute();
        
        echo json_encode($stmt->fetch());
    }
}

function updateUser()
{
    global $conn;
    
    if ($_POST['email']) {
        
        $sqlQuery = "UPDATE Users
                        SET
                        first_name = :first_name,
                        last_name = :last_name,
                        date_of_birth = :date_of_birth,
                        type = :type
                    WHERE Email_Address = :Email_Address";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':first_name', $_POST["firstname"]);
        $stmt->bindValue(':last_name', $_POST["lastname"]);
        $stmt->bindValue(':date_of_birth', $_POST["date_of_birth"]);
        $stmt->bindValue(':type', $_POST["type"]);
        $stmt->bindValue(':Email_Address', $_POST["email"]);
        $stmt->execute();
    }
}

function addUser()
{
    global $conn;
    
    $sqlQuery = "INSERT INTO Users
                 (Email_Address, first_name, last_name, date_of_birth, type)
                 VALUES
                 (:Email_Address, :first_name, :last_name, :date_of_birth, :type)";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':Email_Address', $_POST["Email_Address"]);
    $stmt->bindValue(':first_name', $_POST["firstname"]);
    $stmt->bindValue(':last_name', $_POST["lastname"]);
    $stmt->bindValue(':date_of_birth', $_POST["date_of_birth"]);
    $stmt->bindValue(':type', $_POST["type"]);
    $stmt->execute();
}

function deleteUser()
{
    global $conn;
    
    if ($_POST["email"]) {
        
        $sqlQuery = "DELETE FROM Person_Phone_Numbers WHERE Person = :Email_Address";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Email_Address', $_POST["email"]);
        $stmt->execute();
        
        $sqlQuery = "DELETE FROM Players WHERE Person_ID = :Email_Address";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Email_Address', $_POST["email"]);
        $stmt->execute();
        
        $sqlQuery = "DELETE FROM Refs WHERE Person_ID = :Email_Address";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Email_Address', $_POST["email"]);
        $stmt->execute();
        
        $sqlQuery = "DELETE FROM Deck WHERE Player = :Email_Address";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Email_Address', $_POST["email"]);
        $stmt->execute();
        
        $sqlQuery = "DELETE FROM Users WHERE Email_Address = :Email_Address";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Email_Address', $_POST["email"]);
        $stmt->execute();
    }
}

if(!empty($_POST['action']) && $_POST['action'] == 'listUsers') {
    listUsers();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addUser') {
    addUser();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getUser') {
    getUser();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateUser') {
    updateUser();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteUser') {
    deleteUser();
}

?>