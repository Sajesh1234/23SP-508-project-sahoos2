<?php
	
	session_start();

	// If the user_ID session is not set, then the user has not logged in yet
	if (!isset($_SESSION['user_ID']))
	{
		header("Location: login.php");
	} else {
		session_destroy();
		header("Location: index.php");
	}
?>