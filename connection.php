<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "cmsc508.com";
$username = "23SP_sahoos2";     // Replace yourVCUeid
$db_password = "23SP_sahoos2";     // Replace yourVCUeid
$database = "23SP_sahoos2_pr";  // Replace yourVCUeid

// Connect to the MySQL server
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>