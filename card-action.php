<?php
require_once ('connection.php');

global $conn;

function listCards()
{
    echo "[{id:'e'}]";
}


if(!empty($_POST['action']) && $_POST['action'] == 'listTeams') {
    listTeams();
}

?>