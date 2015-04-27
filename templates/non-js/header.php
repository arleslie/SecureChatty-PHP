<!DOCTYPE html>
<html lang="en">
<head>
	<title>SecureChatty</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header class="navbar navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<a href="index.php" class="navbar-brand">SecureChatty</a>
			</div>
			<?php if ($loggedin): ?>
			<nav>
				<ul class="nav navbar-nav">
					<li><a href="index.php?page=messages">Messages</a></li>
					<li><a href="index.php?page=compose">Compose</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php?page=settings">Settings</a></li>
					<li><a href="index.php?page=logout">Logout</a></li>
				</ul>
			</nav>
			<?php endif; ?>
		</div>
	</header>
	<div class="container">