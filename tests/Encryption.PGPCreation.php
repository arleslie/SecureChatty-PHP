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

}