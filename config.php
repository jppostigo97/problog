<?php

	/**
	 * Config class
	 * Owns configurations and information inside its constants and variables,
	 * also some functions.
	 */
	final class Config {
		// Development
		const DEBUG = true;
		// Variables
		static $title = "Problog";
		// Constants
		const date_format      = "d/m/y";
		const time_format      = "H:i";
		const date_time_format = "d/m/y - H:i";
		const db_host          = "localhost";
		const db_name          = "id4849983_problog";
		const db_user          = "id4849983_root";
		const db_pass          = "elusuarioroot";
		const controller_path  = "app/controllers/";
		const helper_path      = "app/helpers/";
		const model_path       = "app/models/";
		const template_path    = "app/templates/";
		const view_path        = "app/view/";
		
		/**
		 * Check if an user is logged in.
		 * 
		 * @return bool
		 */
		static public function is_user_logged () {
			return (isset($_SESSION['id']))? true : false;
		}
		
		/**
		 * Gets the logged user or *false*.
		 * 
		 * @return string|bool Username or *false* if there is no user logged in.
		 */
		static public function user_logged () {
			return (Config::is_user_logged())? $_SESSION['username'] : false;
		}
		
		/**
		 * 
		 * Gets the logged user's id or *false*.
		 * 
		 * @return string|bool Username or *false* if there is no user logged in.
		 */
		static public function user_logged_id () {
			return (Config::is_user_logged())? $_SESSION['id'] : false;
		}
	}
?>
