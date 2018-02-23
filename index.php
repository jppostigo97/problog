<?php
	// Enable sessions
	session_start();

	// Edit APP_PATH for making all linked files and hyperlinks work properly.
	// IMPORTANT: APP_PATH should finish with /
	define("APP_PATH", "https://jppostigo97.000webhostapp.com/");
	
	require_once "application.php";
	require_once "config.php";
	require_once "controller.php";
	require_once "model.php";
	require_once "view.php";
	
	$app = new Application();
?>
