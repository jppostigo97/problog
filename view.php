<?php
	/**
	 * View class
	 * Load the template, load views (with or without parameters) and then shows the final content.
	 */
	final class View {
		
		/** Page template. */
		static private $template;
		/** Views. */
		static private $pages = [];
		/** Parameters. */
		static private $params = [];
		
		/**
		 * Load the template.
		 * 
		 * @param string $template Template filename (without extension).
		 */
		static public function template ($template) {
			self::$template = $template;
		}
		
		/**
		 * Load a view.
		 * 
		 * @param string $view View filename (without extension).
		 * @param array $params name-value parameters array.
		 */
		static public function load ($view, $params = []) {
			self::$pages[]  = $view;
			self::$params[$view] = $params;
		}
		
		/**
		 * Show the content of every loaded views.
		 */
		static public function show () {
			$content   = "";
			$full_page = "";
			// Load content
			foreach (self::$pages as $page) {
				foreach (self::$params[$page] as $param => $value)
					$$param = $value;
				ob_start();
				require_once Config::view_path . $page . ".php";
				$content .= ob_get_contents();
				// Parse parameters
				foreach (self::$params[$page] as $param => $value) {
					$content = str_replace("[[" . $param . "]]", $value, $content);
					$content = str_replace("[[ " . $param . " ]]", $value, $content);
				}
				ob_end_clean();
			}
			// Load template if necessary
			if (isset(self::$template)) {
				ob_start();
				require_once Config::template_path . self::$template . ".php";
				$full_page = ob_get_contents();
				ob_end_clean();
				$full_page = str_replace("[[skrcontent]]", $content, $full_page);
				$full_page = str_replace("[[ skrcontent ]]", $content, $full_page);
			} else {
				$full_page = $content;
			}
			// Show the view
			echo $full_page;
		}
	}
?>
