<?php
require_once ('connection.php');

global $conn;

function listLocations()
{
    global $conn;
    
    $sqlQuery = "SELECT * FROM Tournament_Location ";
    
    if (! empty($_POST["search"]["value"])) {
       $sqlQuery .= 'WHERE (Address LIKE "%' . $_POST["search"]["value"] . '%" OR Name LIKE "%' . $_POST["search"]["value"] . '%"' . '%" OR Max_Capacity LIKE "%' . $_POST["search"]["value"] . '%"'. '%" OR Number_of_Tables LIKE "%' . $_POST["search"]["value"] . '%"';
    }
    
    if (! empty($_POST["order"])) {
        $sqlQuery .= 'ORDER BY ' . ($_POST['order']['0']['column'] + 1) . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $sqlQuery .= 'ORDER BY Address ASC ';
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
        
        $dataRow[] = $sqlRow['Address'];
        $dataRow[] = $sqlRow['Name'];
        $dataRow[] = $sqlRow['Max_Capacity'];
        $dataRow[] = $sqlRow['Number_of_Tables'];
        
        $dataRow[] = '<button type="button" name="update" Address="' . $sqlRow["Address"] . '" class="btn btn-warning btn-sm update">Update</button>
                      <button type="button" name="delete" Address="' . $sqlRow["Address"] . '" class="btn btn-danger btn-sm delete" >Delete</button>';
        
        $dataTable[] = $dataRow;
    }
    
    $output = array(
        "recordsTotal" => $numberRows,
        "recordsFiltered" => $numberRows,
        "data" => $dataTable
    );
    
    echo json_encode($output);
}
    
function getLocation()
{
    global $conn;
    
    if ($_POST["Address"]) {
        
        $sqlQuery = "SELECT * FROM Tournament_Location 
                     WHERE Address = :Address";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Address', $_POST["Address"]);
        $stmt->execute();
        
        echo json_encode($stmt->fetch());
    }
}

function updateLocation()
{
    global $conn;
    
    if ($_POST['Address']) {
        
        $sqlQuery = "UPDATE Tournament_Location
                        SET
                        Name = :Name,
                        Max_Capacity = :Max_Capacity,
                        Number_of_Tables = :Number_of_Tables
                    WHERE Address = :Address";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Name', $_POST["Name"]);
        $stmt->bindValue(':Max_Capacity', $_POST["Max_Capacity"]);
        $stmt->bindValue(':Number_of_Tables', $_POST["Number_of_Tables"]);
        $stmt->bindValue(':Address', $_POST["Address"]);
        $stmt->execute();
    }
}

function addLocation()
{
    global $conn;
    
    $sqlQuery = "INSERT INTO Tournament_Location
                 (Address, Name, Max_Capacity, Number_of_Tables)
                 VALUES
                 (:Address, :Name, :Max_Capacity, :Number_of_Tables)";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':Address', $_POST["Address"]);
    $stmt->bindValue(':Name', $_POST["Name"]);
    $stmt->bindValue(':Max_Capacity', $_POST["Max_Capacity"]);
    $stmt->bindValue(':Number_of_Tables', $_POST["Number_of_Tables"]);
    $stmt->execute();
}

function deleteLocation()
{
    global $conn;
    
    if ($_POST["Address"]) {
        
        $sqlQuery = "DELETE FROM Tournament_Location WHERE Address = :Address";
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindValue(':Address', $_POST["Address"]);
        $stmt->execute();
    }
}

if(!empty($_POST['action']) && $_POST['action'] == 'listLocations') {
    listLocations();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addLocation') {
    addLocation();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getLocation') {
    getLocation();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateLocation') {
    updateLocation();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteLocation') {
    deleteLocation();
}

?>