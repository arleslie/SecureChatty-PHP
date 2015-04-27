<div class="panel panel-default">
	<div class="panel-heading">
		Unread Messages
	</div>
	<div class="panel-body">
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
