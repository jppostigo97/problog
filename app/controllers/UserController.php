<?php
	class UserController extends Controller {
		
		public function edit($id = 0) {
			Application::require_login();
			if ($_SESSION["level"] == 0) Application::force_redirect("");
			
			$user_model = Application::load_model("user");
			$requested_user = $user_model->find($id);
			
			$user = ($requested_user && $id != 0)?
				$requested_user : $user_model->find($_SESSION["id"]);
			
			if ($user &&
				($user->userid == $_SESSION["id"] || $_SESSION["level"] > 7)) {
				View::template("blog");
				View::load("user/edit", [ "user" => $user->userid ]);
			} else {
				Application::status("404");
			}
		}
		
		public function show($id) {
			$user = (Application::load_model("user"))->find($id);
			if ($user) {
				Application::title($user->username . " en Problog");
				View::template("blog");
				View::load("user/profile", [
					"user" => $id
				]);
			} else {
				Application::status("404");
			}
		}
		
		public function validate_edit() {
			$user_id             = (isset($_POST["user-id"]))? $_POST["user-id"] : 0;
			$user_email          = (isset($_POST["email"]))? Model::encode($_POST["email"]) : "";
			$user_bio            = (isset($_POST["bio"]))? Model::encode($_POST["bio"]) : "";
			$user_twitter        = (isset($_POST["twitter_acc"]))?
				Model::encode($_POST["twitter_acc"]) : "";
			$user_public_email   = (isset($_POST["public_email"]))? true : false;
			$user_public_twitter = (isset($_POST["public_twitter"]))? true : false;
			
			$user_model  = Application::load_model("user");
			$check_email = $user_model->find_by_email($user_email);
			
			if ($user_id != 0 && $user_email != "" &&
				(!$check_email || $check_email->userid == $user_id)) {
				$updated = $user_model->update($user_id, [
					"email"          => $user_email,
					"bio"            => $user_bio,
					"twitter_acc"    => $user_twitter,
					"public_email"   => $user_public_email,
					"public_twitter" => $user_public_twitter
				]);
				if ($updated) Application::force_redirect("user/show/$user_id");
				else die("Error inesperado.");
			} else {
				die("No pudes utilizar una cuenta de correo electrónico que ya está en uso.");
			}
		}
	}
?>
