<div id="edit-category">
	<form action="<?= APP_PATH ?>admin/validate_category/[[ category_id ]]" method="POST">
		<div class="form-field">
			<label for="label">Etiqueta</label>
			<input type="text" name="label" value="[[ category_label ]]" />
		</div>
		<div>
			<button type="submit">Guardar</button>
		</div>
	</form>
</div>
