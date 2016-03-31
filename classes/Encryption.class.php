<?php

namespace classes;

class Encryption
{
	public static function createPGPKey($username, $password)
	{

		// Can't create a pgp key without a name or a password.
		// Also, if they shouldn't have a whitespace in their name but if they do somehow it could be an exploit.
		if (empty($username) || empty($password)) {
			return false;
		} elseif (preg_match('/(\s|\n|\r|\/|\.)/', $username) || preg_match('/\s\n\r/', $password)) {
			trigger_error("{$username} attempted exploit! - PGP Key creation");
			return false;
		}

		// Create batch script for user.
		// RSA Keys
		// 2048 bit
		file_put_contents(
			"/tmp/{$username}",
			"Key-Type: default
			Subkey-Type: default
			Name-Real: {$username}
			Name-Comment: generated key for securechatty
			Name-Email: noreply@securechatty.com
			Expire-Date: 0
			Passphrase: {$password}
			%pubring /tmp/{$username}.pub
			%secring /tmp/{$username}.sec
			%commit"
		);

		// Create the keys
		$file = escapeshellarg('/tmp/' . $username);
		exec("gpg2 --gen-key --batch {$file}");

		// Retrieve the keys
		$publickey = file_get_contents("/tmp/{$username}.pub");
		$privatekey = file_get_contents("/tmp/{$username}.sec");

		// Remove all unneeded files.
		unlink("/tmp/{$username}");
		unlink("/tmp/{$username}.pub");
		unlink("/tmp/{$username}.sec");

		if (empty($publickey) || empty($privatekey)) {
			trigger_error("Key generation failed for {$username}!");
			return false;
		}

		$db = new DB();
		$update = $db->prepare(
			"UPDATE users SET
				publickey = :publickey,
				privatekey = :privatekey
			 WHERE username = :username"
		);

		$update->execute(array(
			':publickey' => $publickey,
			':privatekey' => $privatekey,
			':username' => $username
		));

		return true;
	}

	public static function encrypt($string, $user)
	{
		$gpg = new \gnupg();
		$gpg->addencryptkey($user->getPublickey);
		$encryptedString = $gpg->encrypt($string);

		return $encryptedString;
	}

	public static function decrypt($string)
	{
		$user = new User();

		$gpg = new \gnupg();
		$gpg->adddecryptkey($user->getPrivatekey());
		$decryptedString = $gpg->decrypt($string);

		return $decryptedString;
	}
}
