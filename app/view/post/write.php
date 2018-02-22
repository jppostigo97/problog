<div id="write-post">
	<h2>Publicar</h2>
	<form action="<?= APP_PATH ?>blog/write_post" method="POST">
		<div class="form-field">
			<label for="post_title">Título del post</label>
			<input type="text" name="post_title" required value="[[ p_title ]]" />
		</div>
		<div class="form-field">
			<label for="post_content">Contenido</label>
			<textarea name="post_content" required rows="18">[[ p_content ]]</textarea>
		</div>
		<div class="form-field">
			<label for="post_category">Categoría</label>
			<select name="post_category">
				<?php
					$categories = Application::load_model("category")->get_all();
					while ($category = $categories->fetch_object()) {
						echo "<option value=\"$category->categoryid\">$category->label</option>";
					}
				?>
			</select>
		</div>
		<div>
			<button type="submit">Publicar</button>
		</div>
	</form>
</div>
