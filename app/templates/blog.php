<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title><?= Application::title() ?></title>
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet" />
	<?php Application::link_css("style"); ?>
	<?php Application::link_script("jquery"); ?>
	<?php Application::link_script("script"); ?>
</head>
<body>
	<nav id="navbar">
		<a href="<?= APP_PATH ?>">
			<i class="fas fa-lg fa-fw fa-home"></i> <span>Problog</span>
		</a>
		<div id="menu">
			<?php
				if (Config::is_user_logged()):
					Application::link_to("blog/write_post",
						"<i class=\"fas fa-lg fa-fw fa-edit\"></i>" .
						"<span> Escribir un post</span>");
					if ($_SESSION["level"] > 3):
						if ($_SESSION["level"] > 4):
							Application::link_to("admin",
								"<i class=\"fas fa-lg fa-fw fa-certificate\"></i>" .
								"<span> Administrar</span>");
						endif;
					endif;
					Application::link_to("blog/logout",
						"<i class=\"fas fa-lg fa-fw fa-times\"></i><span> Salir</span>");
				else:
					echo "<a id=\"login-toggle\"><i class=\"fas fa-lg fa-fw fa-user\"></i>" .
						"<span> Entra / Regístrate</span></a>";
				endif;
			?>
		</div>
	</nav>
	
	<?php if (!Config::is_user_logged()): ?>
		<div id="session-content">
			<div>
				<div id="session-error" class="dialog"></div>
				<div id="session-forms">
					<form id="login">
						<h3>Entra</h3>
						<div class="form-field">
							<label for="login_username">Usuario</label>
							<input type="text" name="login_username" id="login_username" required />
						</div>
						<div class="form-field">
							<label for="login_password">Contraseña</label>
							<input type="password" name="login_password" id="login_password" required />
						</div>
						<div>
							<button type="submit">Entra</button>
						</div>
					</form>
					<form id="register">
						<h3>Regístrate</h3>
						<div class="form-field">
							<label for="register_email">Email</label>
							<input type="email" name="register_email" id="register_email" required />
						</div>
						<div class="form-field">
							<label for="register_username">Usuario</label>
							<input type="text" name="register_username" id="register_username" required />
						</div>
						<div class="form-field">
							<label for="register_password">Contraseña</label>
							<input type="password" name="register_password" id="register_password" required />
						</div>
						<div>
							<button type="submit">Regístrate</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div id="wrapper">
		<div id="content">
			[[ skrcontent ]]
		</div>
	</div>
	<footer>
		Copyright &copy; Juan Pedro Postigo<br />
		Proyecto D.A.W.
	</footer>
</body>
</html>
