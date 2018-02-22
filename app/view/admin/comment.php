<section id="admin-content">
	<div id="admin-comments" class="admin-panel">
		<h1>Comentarios</h1>
		<table>
			<thead>
				<tr>
					<th>Autor</th>
					<th>Comentario</th>
					<th>Post</th>
					<th>Fecha</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<?php $comments = (Application::load_model("comment"))->get_all(); ?>
			<?php $authors  = Application::load_model("user"); ?>
			<?php $posts    = Application::load_model("post"); ?>
			<?php while ($comment = $comments->fetch_object()): ?>
				<tr>
					<td>
						<?php
							Application::link_to("user/show/" . $comment->author,
								$authors->find($comment->author)->username);
						?>
					</td>
					<td><?= $comment->content ?></td>
					<td><?php Application::link_to("post/show/" . $comment->post, "Ver"); ?></td>
					<td>
						<?= Application::parse_datetime(Config::date_time_format,
							$comment->date_commented); ?>
					</td>
					<td>
						<?php
							Application::link_to("admin/delete_comment/" . $comment->commentid,
								"<i class=\"fa fa-fw fa-trash\"></i> Eliminar",
								["class" => "btn delete"]);
						?>
					</td>
					<td>
						
					</td>
				</tr>
			<?php endwhile; ?>
		</table>
	</div>
</section>
