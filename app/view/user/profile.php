<?php $user = (Application::load_model("user"))->find($user); ?>

<section id="user-profile">

	<article id="user-info">
		<h2 id="user-username">
			<?= $user->username ?>
			<?php if ($user->level > 7): ?>
				<i class="fa fa-xs fa-fw fa-check-circle"></i>
			<?php endif; ?>
			<?php if (isset($_SESSION["id"])): ?>
				<?php if ($_SESSION["id"] == $user->userid ||
					($_SESSION["level"] > 7 && $_SESSION["level"] > $user->level)): ?>
					<?php Application::link_to("user/edit/$user->userid",
						"<i class=\"fas fa-fw fa-pencil-alt\"></i>"); ?>
				<?php endif; ?>
			<?php endif; ?>
		</h2>
			<div id="user-bio">
				<?= $user->bio ?>
			</div>
		
		<?php if ($user->public_email ||
			($user->public_twitter && $user->twitter_acc != "")): ?>
			<div id="user-contact">
				<h4>Contacto</h4>
				<ul class="fa-ul">
					<?php if ($user->public_email): ?>
						<li>
							<a id="user-email" href="mailto:<?= $user->email ?>">
								<span class="fa-li"><i class="fas fa-fw fa-envelope"></i></span>
								<?= $user->email ?>
							</a>
						</li>
					<?php endif; ?>
					<?php if ($user->public_twitter && $user->twitter_acc != ""): ?>
						<li>
							<a id="user-twitter" target="_blank"
								href="https://twitter.com/<?= $user->twitter_acc?>">
								<span class="fa-li"><i class="fab fa-fw fa-twitter-square"></i></span>
								<?= $user->twitter_acc ?>
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		<?php endif; ?>
		
	</article>
	
	<article id="user-activity">
	
		<div id="user-posts">
			<div id="post-list">
				<?php
					$posts = (Application::load_model("post"))->find_by_author($user->userid);
					if ($posts): ?>
						<h3>Publicaciones</h3>
						<?php while ($post = $posts->fetch_object()): ?>
							<div class="user-post">
								<?php Application::link_to("post/show/" . $post->postid, "<h4>$post->title</h4>"); ?>
							</div>
						<?php endwhile;
					endif;
				?>
			</div>
		</div>
		
		<div class="user-comments">
			<?php
				$comments = (Application::load_model("comment"))->find_by_author($user->userid);
				if ($comments): ?>
					<h3>Comentarios</h3>
					<?php while ($comment = $comments->fetch_object()): ?>
						<div class="user-comments">
							<div class="comment">
								<div class="comment-content">
									<?= $comment->content ?>
								</div>
								<div class="comment-info">
									<span class="comment-post">
										<?php
											$post = (Application::load_model("post"))
												->find($comment->post);
											Application::link_to("post/show/$post->postid",
												$post->title);
										?>
									</span>
									|
									<span class="comment-date">
										<?= Application::parse_datetime(Config::date_time_format,
											$comment->date_commented) ?>
									</span>
								</div>
							</div>
						</div>
					<?php endwhile;
				endif; ?>
		</div>
	</article>
</section>
