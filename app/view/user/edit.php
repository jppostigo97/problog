<?php $user = (Application::load_model("user"))->find($user); ?>

<div id="edit-user">
	<h2><?= $user->username ?></h2>
	<form action="<?= APP_PATH ?>user/validate_edit" method="POST">
		<input type="hidden" name="user-id" value="<?= $user->userid ?>" />
		<div class="form-field">
			<label for="email">Email</label>
			<input type="email" name="email" required value="<?= $user->email ?>" />
		</div>
		<div class="form-field">
			<label for="bio">Biografía</label>
			<textarea name="bio" rows="4"><?= $user->bio ?></textarea>
		</div>
		<div class="form-field">
			<label for="twitter_acc">Cuenta de Twitter</label>
			<input type="text" name="twitter_acc" value="<?= $user->twitter_acc ?>" />
		</div>
		<div class="form-field checklist-field">
			<label for="public_email">
				<input type="checkbox" name="public_email"
					<?php if ($user->public_email) echo "checked"; ?> />
				Otros usuarios pueden ver tu email
			</label>
			<label for="public_twitter">
				<input type="checkbox" name="public_twitter"
					<?php if ($user->public_twitter) echo "checked"; ?> />
				Otros usuarios pueden ver tu cuenta de Twitter.
			</label>
		</div>
		<div>
			<button type="submit">Guardar</button>
		</div>
	</form>
</div>
