<div class="panel panel-default">
	<div role="tabpanel" class="panel-heading">
		<ul class="nav nav-pills" role="tablist">
			<li role="presentation" class="active">
				<a href="#login" data-toggle="tab">Login</a>
			</li>
			<li role="presentation">
				<a href="#register" data-toggle="tab">Register</a>
			</li>
		</ul>
	</div>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active panel-body" id="login">
			<form method="POST" action="index.php">
				<div class="alert alert-info">
					<b>Note:</b> For added security, we do not mark if the username or password combination is incorrect or locked out.
				</div>

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
		<div role="tabpanel" class="tab-pane panel-body" id="register">
			<form method="POST" action="index.php">
				<div class="alert alert-warning">
					<b>Warning:</b> Do not forget your password, there is no way to recover it.
				</div>
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="text" name="username" id="username" class="form-control">
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" class="form-control">
				</div>
				<div class="form-group">
					<label for="password2">Confirm Password:</label>
					<input type="password" name="password2" id="password2" class="form-control">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>