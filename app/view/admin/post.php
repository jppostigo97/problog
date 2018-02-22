<section id="admin-content">
	<div id="admin-posts" class="admin-panel">
		<h1>Publicaciones</h1>
		<table>
			<thead>
				<tr>
					<th>Autor</th>
					<th>Título</th>
					<th>Categoría</th>
					<th>Fecha</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<?php $posts      = (Application::load_model("post"))->get_all(); ?>
			<?php $authors    = Application::load_model("user"); ?>
			<?php $categories = Application::load_model("category"); ?>
			<?php while ($post = $posts->fetch_object()): ?>
				<tr>
					<td>
						<?php
							Application::link_to("user/show/" . $post->author,
								$authors->find($post->author)->username);
						?>
					</td>
					<td>
						<?php
							Application::link_to("post/show/" . $post->postid,
								$post->title);
						?>
					</td>
					<td>
						<?php
							if ($post->category != null) {
								Application::link_to("category/" . $post->category,
									$categories->find($post->category)->label);
							} else {
								echo "-";
							}
						?>
					</td>
					<td>
						<?= Application::parse_datetime(Config::date_time_format,
							$post->date_posted); ?>
					</td>
					<td>
						<?php
							Application::link_to("admin/delete_post/" . $post->postid,
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
