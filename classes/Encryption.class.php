<?php

namespace classes;

class Encryption
{
	private $baseEncryptionKey = 'a8c4379c5de90064477c8c2ca6a48ae1';
	private $iv;

	public function __construct()
	{
		$this->iv = mcrypt_create_iv(32);
	}

	public function encrypt($string)
	{
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $string, MCRYPT_MODE_ECB, $this->iv));
	}

	public function decrypt($string)
	{
		return base64_decode(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, $string, MCRYPT_MODE_ECB, $this->iv));
	}
}
