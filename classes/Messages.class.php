<?php

namespace classes;

class Messages
{
	private $user;
	private $db;

	public function __construct()
	{
		$this->user = new User();
		$this->db = new DB();
	}

	public function getUnread()
	{
		$unread = $this->db->prepare(
			"SELECT c.subject, c.id
			 FROM conversation c
			 INNER JOIN conversation_messages cm ON c.id = cm.conversationId
			 INNER JOIN conversation_users cu ON c.id = cu.conversationId AND cu.userId != cm.userId
			 WHERE cm.status = '0'
			    AND cu.userId = :userId"
		);

		$unread->execute(array(':userId' => $this->user->getId()));

		return $unread->fetchAll(\PDO::FETCH_ASSOC);
	}
}