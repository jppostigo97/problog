<?php
	class BlogController extends Controller {
		
		public function index ($p = 1) {
			$p = (is_numeric($p))? $p : 1;
			View::template("blog");
			View::load("blog/post_list", [
				"p" => $p
			]);
		}
		
		public function page($p) {
			$this->index($p);
		}
		
		public function category($id) {
			$category = (Application::load_model("category"))->find($id);
			if ($category) {
				Application::title($category->label);
				View::template("blog");
				View::load("blog/post_by_category", [
					"category" => $category->categoryid
				]);
			} else {
				Application::status("404");
			}
		}
		
		public function logout() {
			Application::require_login();
			$_SESSION = [];
			Application::force_redirect("");
		}
		
		public function write_post() {
			Application::require_login();
			if ($_SESSION["level"] <= 3) Application::force_redirect("");
			
			Application::title("Escribiendo...");
			
			$p_title    = isset($_POST["post_title"])? $_POST["post_title"] : "";
			$p_content  = isset($_POST["post_content"])? $_POST["post_content"] : "";
			$p_category = isset($_POST["post_category"])? $_POST["post_category"] : null;
			
			if ($p_title != "" && $p_content != "") {
				$post = Application::load_model("post");
				$added = $post->add([
					"title"    => Model::encode($p_title),
					"content"  => Model::encode($p_content),
					"category" => $p_category,
					"author"   => $_SESSION["id"]
				]);
				
				if ($added) {
					$new_post = $post->load_page(1)->fetch_object();
					Application::force_redirect("post/show/" . $new_post->postid);
				} else {
					die("Ha ocurrido un error inesperado.<br />" . $post->connection->error);
				}
			}
			
			View::template("blog");
			View::load("post/write", [
				"p_title"    => $p_title,
				"p_content"  => $p_content,
				"p_category" => $p_category
			]);
		}
	}
?>
