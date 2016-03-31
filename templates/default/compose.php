<div class="panel panel-default">
	<div class="panel-heading">
		Compose
	</div>
	<div class="panel-body">
		<form method="POST" action="index.php?page=messages">
			<div class="form-group">
				<label for="to">To</label>
				<input type="text" class="form-control" name="to" id="to" placeholder="Seperate by semi-colons to make a group conversation.">
			</div>
			<div class="form-group">
				<label for="subject">Subject</label>
				<input type="text" class="form-control" name="subject" id="subject">
			</div>
			<div class="form-group">
				<label for="message">Message</label>
				<textarea name="message" class="form-control" id="message" rows="20"></textarea>
			</div>

			<button type="submit" class="btn btn-primary">Send</button>
		</form>
	</div>
</div>
