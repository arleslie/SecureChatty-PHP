<div class="panel panel-default">
	<div class="panel-heading">
		Unread Messages
	</div>
	<div class="panel-body">
		<?php if (!empty($alerts['success'])): ?>
			<div class="alert alert-success">
				<?php foreach ($alerts['success'] as $alert): ?>
					<?=$alert?><br>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if (!empty($alerts['error'])): ?>
			<div class="alert alert-danger">
				<?php foreach ($alerts['error'] as $alert): ?>
					<?=$alert?><br>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if (!empty($unreadMessages)): ?>
			<ul>
				<?php foreach($unreadMessages as $message): ?>
					<li><a href="index.php?page=messages&amp;read={$message['id']}">{$message['subject']}</a></li>
				<?php endforeach; ?>
			</ul>
		<?php else: ?>
			No unread messages.
		<?php endif; ?>
	</div>
</div>
