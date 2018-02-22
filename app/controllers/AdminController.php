<?php
	class AdminController extends Controller {
		
		public function index() {
			Application::require_login();
			if ($_SESSION["level"] < 7) Application::force_redirect("");
			View::template("blog");
			View::load("admin");
		}
		
		public function category() {
			$this->index();
			View::load("admin/category");
		}
		
		public function comment() {
			$this->index();
			View::load("admin/comment");
		}
		
		public function post() {
			$this->index();
			View::load("admin/post");
		}
		
		public function user() {
			$this->index();
			View::load("admin/user");
		}
		
		// Validation
		public function validate_category($id = 0) {
			Application::require_login();
			if ($_SESSION["level"] < 7) Application::force_redirect("");
			
			if (!isset($_POST["label"])) {
				Application::error("category", "Error al procesar",
					"Faltan datos esenciales de la categoría.");
				Application::force_redirect("admin/category");
			}
			
			$category = Application::load_model("category");
			$label = Model::encode($_POST["label"]);

			if ($id == 0) {
				$created = $category->add([
					"label" => $label
				]);
				
				if (!$created)
					Application::error("category", "Error al crear la categoría",
						"Ha ocurrido un error inesperado al crear la categoría.");

				Application::force_redirect("admin/category");
			} else {
				if ($category->find($id)) {
					
					$updated = $category->update($id, [
						"label" => $label
					]);
					
					if (!$updated)
						Application::error("category", "Error al editar categoría",
							"Ha ocurrido un error inesperado al editar la categoría.");
					
					Application::force_redirect("admin/category");
				} else {
					Application::error("category", "Error al editar categoría",
						"La categoría que querías editar no existe.");
					Application::force_redirect("admin/category");
				}
			}
			Application::force_redirect("admin/category");
		}
		
		// Edit
		public function edit_category($id) {
			$this->index();
			
			if (isset($id)) {
				$category = (Application::load_model("category"))->find($id);
				if ($category) {
					$l = $category->label;
					View::load("admin/edit_category", [
						"category_id"    => $id,
						"category_label" => $l
					]);
				} else {
					Application::error("category", "Error al editar categoría",
						"La categoría que se pretendía editar no existe.");
					Application::force_redirect("admin/category");
				}
			} else {
				Application::error("category", "Error al editar categoría",
					"Ha ocurrido un error inesperado.");
				Application::force_redirect("admin/category");
			}
		}
		
		// Delete
		public function delete_category($id) {
			Application::require_login();
			if ($_SESSION["level"] < 7) Application::force_redirect("");
			
			$model = Application::load_model("category");
			if (!$model->find($id)) {
				Application::error("category", "Error al eliminar categoría",
					"La categoría que intentabas eliminar no existe.");
				Application::force_redirect("admin/category");
			} else {
				$check = $model->delete($id);
				if (!$check) {
					Application::error("category", "Error al eliminar categoría",
						"Se ha producido un error inesperado.");
				}
				Application::force_redirect("admin/category");
			}
		}
		
		public function delete_comment($id) {
			Application::require_login();
			if ($_SESSION["level"] < 7) Application::force_redirect("");
			
			$model = Application::load_model("comment");
			if (!$model->find($id)) {
				Application::error("comment", "Error al eliminar comentario",
					"El comentario que intentabas eliminar no existe.");
				Application::force_redirect("admin/comment");
			} else {
				$check = $model->delete($id);
				if (!$check) {
					Application::error("comment", "Error al eliminar comentario",
						"Se ha producido un error inesperado.");
				}
				Application::force_redirect("admin/comment");
			}
		}
		
		public function delete_post($id) {
			Application::require_login();
			if ($_SESSION["level"] < 7) Application::force_redirect("");
			
			$model = Application::load_model("post");
			if (!$model->find($id)) {
				Application::error("post", "Error al eliminar publicación",
					"La publicación que intentabas eliminar no existe.");
				Application::force_redirect("admin/post");
			} else {
				$check = $model->delete($id);
				if (!$check) {
					Application::error("post", "Error al eliminar publicación",
						"Se ha producido un error inesperado.");
				}
				Application::force_redirect("admin/post");
			}
		}
		
		public function delete_user($id) {
			Application::require_login();
			if ($_SESSION["level"] < 7) Application::force_redirect("");
			
			$model = Application::load_model("user");
			if (!$model->find($id)) {
				Application::error("user", "Error al eliminar usuario",
					"El usuario que intentabas eliminar no existe.");
				Application::force_redirect("admin/user");
			} else {
				$check = $model->delete($id);
				if (!$check) {
					Application::error("user", "Error al eliminar usuario",
						"Se ha producido un error inesperado.");
				}
				Application::force_redirect("admin/user");
			}
		}
	}
?>
