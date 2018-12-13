<?php

class User
{
	public static function isUserItem($login, $password)
	{
		$db = Db::getConnection();
		$result = $db->query('SELECT * FROM `users` WHERE `login`="' . $login . '" AND `password`="' . md5($password) . '"');
		$userItem = $result->fetch(PDO::FETCH_ASSOC);
		if ($userItem['login'] == $login)
			return true;
		else
			return false;
	}
}