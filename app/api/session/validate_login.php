<?php
	require_once "../api.php";
	
	$users = new User();
	if ($user = $users->find_by_username(Model::encode($_GET["username"]))) {
		// if ($_GET["password"] == $user->password) {
		if (password_verify($_GET["password"], $user->password)) {
			$_SESSION["id"]       = $user->userid;
			$_SESSION["username"] = $user->username;
			$_SESSION["level"]    = $user->level;
			echo "true";
		} else {
			print_json([
				"error" => "password"
			]);
		}
	} else {
		print_json([
			"error" => "username"
		]);
	}
?>
