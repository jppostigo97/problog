<?php
	session_start();

	require_once "../../../application.php";
	require_once "../../../config.php";
	require_once "../../../model.php";
	require_once "../../models/category.php";
	require_once "../../models/comment.php";
	require_once "../../models/post.php";
	require_once "../../models/user.php";
	
	function print_json($content) {
		echo json_encode($content);
	}
?>
