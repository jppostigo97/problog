<?php
	// Enable sessions
	session_start();

	// Edit APP_PATH for making all linked files and hyperlinks work properly.
	// IMPORTANT: APP_PATH should finish with /
	// Substitute "SkrFramework" with your app path inside your server or leave it just as /.
	define("APP_PATH", "http://" . $_SERVER['SERVER_NAME']. "/problog/");
	
	require_once "application.php";
	require_once "config.php";
	require_once "controller.php";
	require_once "model.php";
	require_once "view.php";
	
	$app = new Application();
?>
