<?php

$loggedIn = !empty($_SESSION['id']);

if (!$loggedIn && !empty($_POST['username']) && !empty($_POST['password'])) {
	$check = $db->prepare(
		"SELECT id
		 FROM users
		 WHERE username = :username AND 
		 	password = :password"
	);

	$check->execute(array(
		':username' => $_POST['username'],
		':password' => hash('sha256', $_POST['password'])
	));

	if ($check->rowCount() === 1) {
		$info = $check->fetchAll();
		$_SESSION['id'] = $info[0]['id'];
		$loggedIn = true;
	}
}

if (!$loggedIn) {
	echo "<form method='POST' action='{$_SERVER['PHP_SELF']}'>
		<input type='text' name='username'> <input type='password' name='password'>
		<input type='submit'>
	</form>";
} else {
	header('LOCATION: index.php');
}
