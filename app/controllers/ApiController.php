<?php
	class ApiController extends Controller {
		private function print($params) {
			$string = json_encode($params);
			header("Content-Type: application/json");
			echo $string;
		}
		
		private function checkParam($param) {
			if ($param == 0) {
				Application::status(404);
			}
		}
		
		public function category($id = 0) {
			$this->checkParam($id);
			
			$model = Application::load_model("category");
			
			if ($item = $model->find($id)) {
				// Exists
				// Parse result
				$object = [
					"id"    => $item->categoryid,
					"label" => $item->label
				];
				$this->print($object);
			} else {
				Application::status(404);
			}
		}
		
		public function comment($id = 0) {
			$this->checkParam($id);
			
			$model  = Application::load_model("comment");
			$author = Application::load_model("user");
			$post   = Application::load_model("post");
			
			if ($item = $model->find($id)) {
				// Exists
				// Parse result
				$object = [
					"id"       => $item->commentid,
					"content"  => $item->content,
					"authorid" => $item->author,
					"author"   => $author->find($item->author)->username,
					"postid"   => $item->post,
					"post"     => $post->find($item->post)->title
				];
				$this->print($object);
			} else {
				Application::status(404);
			}
		}
		
		public function post($id = 0) {
			$this->checkParam($id);
			
			$model    = Application::load_model("post");
			$author   = Application::load_model("user");
			$category = Application::load_model("category");
			
			if ($item = $model->find($id)) {
				// Exists
				// Parse result
				$object = [
					"id"         => $item->postid,
					"title"      => $item->title,
					"authorid"   => $item->author,
					"author"     => $author->find($item->author)->username,
					"categoryid" => $item->category,
					"category"   => $category->find($item->category)->label
				];
				$this->print($object);
			} else {
				Application::status(404);
			}
		}
		
		public function user($id = 0) {
			$this->checkParam($id);
			
			$model = Application::load_model("user");
			
			if ($item = $model->find($id)) {
				// Exists
				// Parse result
				$object = [
					"id"       => $item->userid,
					"username" => $item->username,
					"bio"      => $item->bio
				];
				
				if ($item->public_email) $object["email"] = $item->email;
				if ($item->public_twitter) $object["twitter_acc"] = $item->twitter_acc;
				
				$this->print($object);
			} else {
				Application::status(404);
			}
		}
	}
?>
