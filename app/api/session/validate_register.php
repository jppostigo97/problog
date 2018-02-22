<?php
	require_once "../api.php";
	
	$users = new User();
	
	$email    = $_POST["email"];
	$username = $_POST["username"];
	
	if ($users->find_by_email($email)) {
		print_json([
			"error" => "email"
		]);
	} else {
		if ($users->find_by_username($username)) {
			print_json([
				"error" => "username"
			]);
		} else {
			$user = $users->add([
				"email"    => Model::encode($email),
				"username" => Model::encode($username),
				"password" => password_hash($_POST["password"], PASSWORD_DEFAULT)
			]);
			if ($user) {
				echo "true";
			} else {
				print_json([
					"error" => "?"
				]);
			}
		}
	}
?>
