<div id="admin">
	<aside id="admin-menu">
		<ul>
			<li>
				<?php
					Application::link_to("admin/category",
						"<i class=\"fa fa-lg fa-fw fa-tags\"></i>" .
						"<span><i class=\"fa fa-fw fa-tags\"></i> Categorías</span>");
				?>
			</li>
			<li>
				<?php
					Application::link_to("admin/comment",
						"<i class=\"fa fa-lg fa-fw fa-comments\"></i>" .
						"<span><i class=\"fa fa-fw fa-comments\"></i> Comentarios</span>");
				?>
			</li>
			<li>
				<?php
					Application::link_to("admin/post",
						"<i class=\"fa fa-lg fa-fw fa-align-justify\"></i>" .
						"<span><i class=\"fa fa-fw fa-align-justify\"></i> Publicaciones</span>");
				?>
			</li>
			<li>
				<?php
					Application::link_to("admin/user",
						"<i class=\"fa fa-lg fa-fw fa-users\"></i>" .
						"<span><i class=\"fa fa-fw fa-users\"></i> Usuarios</span>");
				?>
			</li>
		</ul>
	</aside>
</div>
