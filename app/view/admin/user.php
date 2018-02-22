<section id="admin-content">
	<div id="admin-users" class="admin-panel">
		<h1>Usuarios</h1>
		<table>
			<thead>
				<tr>
					<th>Nick</th>
					<th>Email</th>
					<th>Twitter</th>
					<th>#</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<?php $users = (Application::load_model("user"))->get_all(); ?>
			<?php while ($user = $users->fetch_object()): ?>
				<tr>
					<td><?= $user->username ?></td>
					<td>
						<span class="email-acc user-acc-<?= $user->public_email ?>">
							<a href="mailto:<?= $user->email ?>">
								<?= $user->email ?>
							</a>
						</span>
					</td>
					<td>
						<?php if ($user->twitter_acc): ?>
							<span class="twitter-acc user-acc-<?= $user->public_twitter ?>">
								<a href="https://twitter.com/<?= $user->twitter_acc ?>">
									<?= $user->twitter_acc ?>
								</a>
							</span>
						<?php else: ?>
							-
						<?php endif; ?>
					</td>
					<td><?= $user->level ?></td>
					<td>
						<?php
							Application::link_to("user/show/" . $user->userid,
								"<i class=\"fa fa-fw fa-eye\"></i> Ver",
								["class" => "btn"]);
						?>
						<?php
							Application::link_to("user/edit/" . $user->userid,
								"<i class=\"fa fa-fw fa-edit\"></i> Editar",
								["class" => "btn"]);
						?>
						<?php
							Application::link_to("admin/delete_user/" . $user->userid,
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
