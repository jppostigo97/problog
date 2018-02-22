<?php
	require_once "../../config.php";
	require_once "../../model.php";
	require_once "../models/category.php";
	require_once "../models/comment.php";
	require_once "../models/post.php";
	require_once "../models/user.php";
	
	function print_json($content) {
		echo json_encode($content);
	}
	
	if (isset($_GET["model"]) && isset($_GET["id"])) {
		$class_name = ucfirst(strtolower($_GET["model"]));
	
		try {
			$model = new $class_name();
		} catch(Exception $e) {
			print_json([ "error" => "model" ]);
			exit();
		}
		
		if ($model){
			$deleted = $model->delete($_GET["id"]);
			if ($deleted) {
				echo "true";
			} else {
				print_json([ "error" => "unknown" ]);
			}
		}
	} else {
		print_json([ "error" => "arguments" ]);
	}
?>
