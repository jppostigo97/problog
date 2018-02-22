<?php
	class PostController extends Controller {
		public function show($id = 0) {
			$post = (Application::load_model("post"))->find(intval($id));
			
			if ($post) {
				Application::title($post->title);
				// Models
				$users = Application::load_model("user");

				// Post info
				$author   = $users->find($post->author)->username;
				$category = ($post->category)?
					(Application::load_model("category"))->find($post->category)->label : "sin categoria";
				
				$parsedown = Application::load_helper("Parsedown");
				
				View::template("blog");
				View::load("post/show", [
					"post_id"           => $post->postid,
					"post_title"        => $post->title,
					"post_content"      => $parsedown->text($post->content),
					"post_author"       => $author,
					"post_author_id"    => $post->author,
					"post_category"     => $category,
					"post_category_id"  => $post->category,
					"post_publish_date" => Application::parse_datetime(Config::date_format,
						$post->date_posted)
				]);
			} else {
				Application::status(404);
			}
		}
	}
?>
