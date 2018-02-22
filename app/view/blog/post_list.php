<?php
	$model = Application::load_model("post");
	$posts = $model->load_page($p);
	$category_model = Application::load_model("category");
	$user_model = Application::load_model("user");
?>

<?php if ($posts): ?>

	<section id="post-list">
		<?php while ($post = $posts->fetch_object()): ?>
			<article class="post">
				<?php Application::link_to("post/show/" . $post->postid,
					"<h2 class=\"post-title\">$post->title</h2>"); ?>
					<div class="post-info">
						<?php
							$author = $user_model->find($post->author)->username;
							echo "Escrito por ";
							Application::link_to("user/show/$post->author", $author);
							if ($post->category):
								$category = $category_model->find($post->category)->label;
								echo " en ";
								Application::link_to("blog/category/$post->category", $category);
							endif;
						?>
					</div>
			</article>
		<?php endwhile; ?>
	</section>
	
	<?php
		$is_page_back    = $model->load_page($p - 1);
		$is_page_forward = $model->load_page($p + 1)->fetch_assoc();
	?>
	<div class="pagination post-pagination">
		<ul>
		
			<?php if ($is_page_back): ?>
				<li>
					<?php Application::link_to("blog/page/" . ($p - 1),
						"<i class=\"fa fa-lg fa-fw fa-arrow-left\"></i>");
					?>
				</li>
			<?php endif; ?>
			
			<?php if ($is_page_forward): ?>
				<li>
					<?php Application::link_to("blog/page/" . ($p + 1),
						"<i class=\"fa fa-lg fa-fw fa-arrow-right\"></i>");
					?>
				</li>
			<?php endif; ?>
					
		</ul>
	</div>
	
<?php else: ?>
	<h1>No existen artículos que cargar</h1>
<?php endif; ?>

