<div class="panel panel-default">
	<div class="panel-heading">
		Login Form
	</div>
	<div class="panel-body">
		<div class="alert alert-info">
			<b>Note:</b> For added security, we do not mark if the username or password combination is incorrect or locked out.
		</div>

		<form method="POST" action="index.php">
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" name="username" id="username" class="form-control">
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" class="form-control">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
