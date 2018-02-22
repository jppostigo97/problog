<section id="post">
	<h1>[[ post_title ]]</h1>
	<div id="post-content">[[ post_content ]]</div>
	<div id="post-info">
		Escrito por
		<span id="post-author">
			<?php Application::link_to("user/show/$post_author_id", $post_author); ?>
		</span>
		<span id="post-category">
			<?php
				if ($post_category_id):
					echo "en ";
					Application::link_to("blog/category/$post_category_id", $post_category);
				endif;
			?>
		</span>
		-
		<span id="post-date">[[ post_publish_date ]]</span>
	</div>
</section>

<div id="comment-form">
	<h4>Comenta</h4>
	<div id="comment-error" class="dialog"></div>
	<form id="write-comment">
		<input type="hidden" id="comment-post-id" value="<?= $post_id ?>" />
		<input type="hidden" id="comment-author-id" value="<?= $_SESSION["id"] ?>" />
		<div class="form-field">
			<textarea id="new-comment-content" name="new-comment-content"></textarea>
		</div>
		<div>
			<button type="submit">Comentar</button>
		</div>
	</form>
</div>

<?php $comments = (Application::load_model("comment"))->find_by_post($post_id); ?>
<?php $users = Application::load_model("user"); ?>
<?php if ($comments && $comments->num_rows > 0): ?>

	<section id="post-comment-list">
		<h3>Comentarios</h3>
		<?php while ($comment = $comments->fetch_object()): ?>
			<article class="comment">
				<div class="comment-content">
					<?= $comment->content ?>
				</div>
				<div class="comment-info">
					Por
					<span class="comment-author">
						<?php
							$user = $users->find($post_author_id);
							Application::link_to("user/show/$user->userid", $user->username);
						?>
					</span>
					|
					<span class="comment-date">
						<?= Application::parse_datetime(Config::date_time_format,
							$comment->date_commented) ?>
					</span>
				</div>
			</article>
		<?php endwhile; ?>
	</section>

<?php endif; ?>
