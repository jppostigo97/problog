<?php
	$category = (Application::load_model("category"))->find($category);
	$posts    = (Application::load_model("post"))->find_by_category($category->categoryid);
	$users    = Application::load_model("user");
?>
	
<div id="category-posts">
	<section id="post-list">
		<?php while ($post = $posts->fetch_object()): ?>
				<article class="post">
					<?php
						Application::link_to("post/show/$post->postid",
							"<h2 class=\"post-title\">$post->title</h2>");
					?>
					<div class="post-info">
						<?php $author = $users->find($post->author)->username; ?>
						Escrito por
						<?php Application::link_to("user/show/$post->author", $author); ?>
					</div>
				</article>
		<?php endwhile; ?>
	</section>
</div>
