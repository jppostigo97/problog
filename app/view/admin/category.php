<section id="admin-content">
	<div id="admin-categories" class="admin-panel">
		<h1>Categorías</h1>
		<?php Application::display_error("category"); ?>
		<table>
			<thead>
				<tr>
					<th>Etiqueta</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<form action="<?= APP_PATH ?>admin/validate_category" method="POST">
					<tr>
						<td>
							<input type="text" name="label" id="label" />
						</td>
						<td>
							<button>Guardar</button>
						</td>
					</tr>
				</form>
				<?php $categories = (Application::load_model("category"))->get_all(); ?>
				<?php while ($c = $categories->fetch_object()): ?>
					<tr>
						<td><?= $c->label ?></td>
						<td>
							<?php Application::link_to("admin/edit_category/" . $c->categoryid,
								"<i class=\"fa fa-fw fa-edit\"></i> Editar",
								["class" => "btn edit"]); ?>
							<?php Application::link_to("admin/delete_category/" . $c->categoryid,
								"<i class=\"fa fa-fw fa-trash\"></i> Eliminar",
								["class" => "btn delete"]); ?>
						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
</section>
