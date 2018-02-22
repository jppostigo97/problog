<?php
	require_once "../api.php";
	
	// Models
	$comments = new Comment();
	$users    = new User();
	$posts    = new Post();
	
	// Params
	$comment_author  = isset($_POST["author"])?  intval($_POST["author"]) : 0;
	$comment_content = isset($_POST["content"])? Model::encode($_POST["content"]) : "";
	$comment_postid  = isset($_POST["postid"])?  intval($_POST["postid"]) : 0;
	
	if ($comment_author != 0 && $comment_postid != 0 && $comment_content != "") {
		$author = $users->find($comment_author);
		$post   = $posts->find($comment_postid);
		if ($author && $post) {
			$new_comment = $comments->add([
				"content" => Model::encode($comment_content),
				"author"  => $comment_author,
				"post"    => $comment_postid
			]);
			if ($new_comment) echo "true";
			else print_json([ "error" => "unknown" ]);
		} else {
			print_json([
				"error" => "not-found"
			]);
		}
	} else {
		// Some fields were not sent
		print_json([
			"error" => "field"
		]);
	}
?>
