<?php
	class Application {
		/** Controller (and its default) */
		public $controller = "BlogController";
		/** Method (and its default) */
		public $method = "index";
		/** URL parameters */
		public $params = [];
		
		/**
		 * Automatically configure and execute your application.
		 */
		public function __construct () {
			// Parse URL
			$url = $this->parse_url();
			// Load Controller
			if (isset($url[0])) {
				$controller_class = ucfirst(strtolower($url[0])) . "Controller";
				$controller_file = Config::controller_path . $controller_class . ".php";
				if (file_exists($controller_file)) {
					$this->controller = $controller_class;
					unset($url[0]);
				}
			}
			require_once Config::controller_path . $this->controller . ".php";
			$this->controller = new $this->controller();
			// Find the method
			if (isset($url[1])) {
				$method_name = strtolower($url[1]);
				if (method_exists($this->controller, $method_name)) {
					$this->method = $method_name;
					unset($url[1]);
				}
			}
			// Parse parameters
			$this->params = ($url != null)? array_values($url) : [];
			// Execute
			if (method_exists($this->controller, $this->method)) {
				call_user_func_array([$this->controller, $this->method],
					$this->params);
			} else {
				self::force_redirect("");
			}
			View::show();
		}
		
		/**
		 * Show an error message if it does exists.
		 * 
		 * @param string $identifier Error message identifier.
		 */
		public static function display_error ($identifier) {
			if (isset($_COOKIE[$identifier])) {
				$error = unserialize($_COOKIE[$identifier]);
				echo "<div class\"dialog\" id=\"error-display\">";
				echo "<h3>" . $error['title'] . "</h3>";
				echo "<div>" . $error['content'] . "</div>";
				echo "</div>";
				setcookie($identifier, "", time() - 1);
			}
		}
		
		/**
		 * Create an error message.
		 * 
		 * @param string $identifier Error message identifier.
		 * @param string $title Message title.
		 * @param string $content Message content.
		 */
		public static function error ($identifier, $title, $content) {
			setcookie($identifier, serialize([
				"title" => $title, "content" => $content]),
				time() + 300);
		}
		
		/**
		 * Make the user unable to access if he/she is logged in.
		 */
		public static function forbid_login () {
			if (Config::is_user_logged())
				self::force_redirect("");
		}
		
		/**
		 * Force a redirection.
		 * 
		 * @param string $url New location.
		 */
		public static function force_redirect ($url) {
			header("Location: " . APP_PATH . $url);
			exit();
		}
		
		/**
		 * Link a local stylesheet.
		 * 
		 * @param string $css Stylesheet filename (without extension).
		 * @param array $params Optional attributes for the <link> tag.
		 */
		function link_css ($css, $params = []) {
			echo "<link rel=\"stylesheet\" href=\"" . APP_PATH . "app/assets/css/" . $css . ".css\"";
			if (!empty($params)) {
				foreach ($params as $attr => $value)
					echo " $attr=\"$value\"";
			}
			echo " />";
		}

		/**
		 * Create an hyperlink.
		 * 
		 * @param string $link Link URL.
		 * @param string $label Link label.
		 * @param array $params Optional attributes for the <a> tag.
		 */
		public static function link_to ($link, $label, $params = []) {
			echo "<a href=\"" . APP_PATH . $link . "\"";
			foreach ($params as $attr => $value)
				echo " $attr=\"$value\"";
			echo ">$label</a>";
		}
		
		/**
		 * Link a local javascript file.
		 * 
		 * @param string $script Script filename (without extension).
		 * @param array $params Optional attributes for the <script> tag.
		 */
		function link_script ($script, $params =[]) {
			echo "<script src=\"" . APP_PATH . "app/assets/js/" . $script . ".js\"";
			if (!empty($params)) {
				foreach ($params as $attr => $value)
					echo " $attr=\"$value\"";
			}
			echo "></script>";
		}
		
		/**
		 * Load, create an instance and return a model.
		 * 
		 * @param string $model_name Model name.
		 * @return Model
		 */
		public static function load_model ($model_name) {
			$model_class = ucfirst($model_name);
			$model_file  = Config::model_path . strtolower($model_name) . ".php";
			if (file_exists($model_file)) {
				require_once $model_file;
				return new $model_class();
			} else {
				if (Config::DEBUG) die("No se ha encontrado el archivo del modelo $model_class.");
				else die("");
			}
		}

		/**
		 * Load, create an instance and return a helper.
		 * 
		 * @param string $helper_name Helper name.
		 * @return Helper
		 */
		public static function load_helper ($helper_name) {
			$helper_class = ucfirst($helper_name);
			$helper_file  = Config::helper_path . strtolower($helper_name) . ".php";
			if (file_exists($helper_file)) {
				require_once $helper_file;
				return new $helper_class();
			} else {
				if (Config::DEBUG) die("No se ha encontrado el archivo del helper $helper_class.");
				else die("");
			}
		}
		
		/**
		 * Parse datetime.
		 * 
		 * @param string $format Date/time format.
		 * @param string $date_time Date and time to parse.
		 */
		public static function parse_datetime ($format, $date_time) {
			return DateTime::createFromFormat("Y-m-d H:i:s", $date_time)->format($format);
		}
		
		/**
		 * Parse the URL.
		 */
		private function parse_url () {
			if (isset($_GET['url'])) {
				return explode("/", filter_var(rtrim($_GET['url'], "/"), FILTER_SANITIZE_URL));
			}
		}
		
		/**
		 * Make the user unable to access if he/she isn't logged in.
		 */
		public static function require_login () {
			if (!Config::is_user_logged())
				self::force_redirect("");
		}
		
		/**
		 * - 404
		 */
		public static function status($code) {
			die("Error $code.");
		}
		
		/**
		 * Returns or modify page title.
		 * 
		 * @param string $title New title.
		 * @return string Page title.
		 */
		public static function title ($title = "") {
			if ($title != "") Config::$title = $title;
			else return Config::$title;
		}
	}
?>
