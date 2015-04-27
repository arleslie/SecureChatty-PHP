<div class="panel panel-default">
	<div role="tabpanel" class="panel-heading">
		<ul class="nav nav-pills" role="tablist">
			<li role="presentation" <?php if ($tab == 'login'): ?>class="active"<?php endif; ?>>
				<a href="#login" data-toggle="tab">Login</a>
			</li>
			<li role="presentation"  <?php if ($tab == 'register'): ?>class="active"<?php endif; ?>>
				<a href="#register" data-toggle="tab">Register</a>
			</li>
		</ul>
	</div>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane panel-body <?php if ($tab == 'login'): ?>active<?php endif; ?>" id="login">
			<form method="POST" action="index.php?tab=login">
				<div class="alert alert-info">
					<b>Note:</b> For added security, we do not mark if the username or password combination is incorrect or locked out.
				</div>

				<div class="form-group">
					<label class="control-label" for="signinUsername">Username:</label>
					<input type="text" name="username" id="signinUsername" class="form-control">
				</div>
				<div class="form-group">
					<label class="control-label" for="signinPassword">Password:</label>
					<input type="password" name="password" id="signinPassword" class="form-control">
				</div>
				<button type="submit" id="loginButton" class="btn btn-primary">Submit</button>
			</form>
		</div>
		<div role="tabpanel" class="tab-pane panel-body <?php if ($tab == 'register'): ?>active<?php endif; ?>" id="register">
			<form method="POST" action="index.php?tab=register">
				<div class="alert alert-warning">
					<b>Warning:</b> Do not forget your password, there is no way to recover it.
				</div>

				<?php if (!empty($errors['registration'])): ?>
					<?php foreach ($errors['registration'] as $error): ?>
						<div class="alert alert-error"><?=$error?></div>
					<?php endforeach; ?>
				<?php endif; ?>

				<div class="form-group">
					<label class="control-label" for="signupUsername">Username:</label>
					<input type="text" name="username" id="signupUsername" class="form-control" required placeholder="The follow characters are forbidden: &comma; &semi; &commat; &quot; &apos; &percnt; &amp; &ast;">
				</div>
				<div class="form-group">
					<label class="control-label" for="signupPassword">Password:</label>
					<input type="password" name="password" id="signupPassword" class="form-control" required>
				</div>
				<div class="form-group">
					<label class="control-label" for="signupPassword2">Confirm Password:</label>
					<input type="password" name="password2" id="signupPassword2" class="form-control" required>
				</div>
				<button type="submit" id="signupButton" class="btn btn-primary" disabled>Submit</button>
			</form>
		</div>
	</div>
</div>

<script>
	$(function() {
		var username = false;
		var password = false;
		$('#signupUsername').on('change', function() {
			if ($('#signupUsername').val() !== '') {
				$.ajax({
					url: 'index.php',
					type: 'POST',
					dataType: 'JSON',
					data: {ajax: { Registration: {checkUsername: $('#signupUsername').val() }}},
				})
				.done(checkUsername);
			} else {
				checkUsername();
			}
		});

		function checkUsername(ajax) {
			if (ajax !== undefined && ajax['Registration']['checkUsername'] === 1) {
				username = true;
				$('#signupUsername').closest('div.form-group').addClass('has-success').removeClass('has-error');
				if (password === true) {
					$('#signupButton').prop('disabled', false);
				}
			} else {
				username = false;
				$('#signupUsername').closest('div.form-group').addClass('has-error').removeClass('has-success');
				$('#signupButton').prop('disabled', true);
			}
		}

		$('#signupPassword, #signupPassword2').on('keyup', function() {
			if ($('#signupPassword').val() !== $('#signupPassword2').val() || $('#signupPassword').val() === '') {
				$('#signupPassword, #signupPassword2').closest('div.form-group').addClass('has-error').removeClass('has-success');
				$('#signupButton').prop('disabled', true);
				password = false;
			} else {
				$('#signupPassword, #signupPassword2').closest('div.form-group').removeClass('has-error').addClass('has-success');
				password = true;
				if (username === true) {
					$('#signupButton').prop('disabled', false);
				}
			}
		});
	});
</script>