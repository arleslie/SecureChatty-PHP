<?php

// Bootstrap functions/autoloader.php

class EncryptionTest extends PHPUnit_Framework_TestCase {

	public function testCreatingKeys()
	{
		// Check to see if PGP Creation is working
		$result = \classes\Encryption::createPGPKey('test', 'test');
		$this->assertTrue($result);

		// Verify the key was written.
		$user = \classes\User::getUserByUsername('test');
		$this->assertNotNull($user->getPublickey());
		$this->assertNotNull($user->getPrivatekey());

		// Verify tmp files were cleaned up.
		$this->assertFalse(file_exists('/tmp/test'));
		$this->assertFalse(file_exists('/tmp/test.pub'));
		$this->assertFalse(file_exists('/tmp/test.sec'));
	}

	public function testEncryptionDecryption()
	{
		$originalMessage = "This is a simple test sentence.";
		$encryptedMessage = \classes\Encryption::encrypt($originalMessage, \classes\User::getUserByUsername('test'));

		// If the message was encrypted it shouldn't be the same.
		$this->assertNotEquals($originalMessage, $encryptedMessage);

		// Login as the test user.
		session_start();
		$_SESSION['id'] = \classes\User::getUserByUsername('test')->getId();
		$_SESSION['username'] = 'test';
		$_SESSION['key'] = hash('sha512', hash('sha256', 'test' . md5('test')) . 'test');
		session_write_close();

		// Check Decryption
		$decryptedMessage = \classes\Encryption::decrypt($encryptedMessage);

		$this->assertEquals($originalMessage, $decryptedMessage);
	}

}