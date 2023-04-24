<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('connection.php');
require_once('login-locked.php');

// Start or resume session variables
session_start();

if (!isempty($_SESSION['user_type']))
{
	echo $_SESSION['user_type'];
	// If the user_type session is not "Player", then the user can't see this page
	

} else {

}

?>