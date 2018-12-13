<?php

include_once ROOT . "/models/User.php";

class UserController
{
	public function actionLogin()
	{
		if (!empty($_POST))
		{
			if (User::isUserItem($_POST['login'], $_POST['password']))
			{
				$_SESSION['user'] = $_POST['login'];
			} else {
				$_SESSION['error_login'] = true;
			}
			header('Location: /');
		} else {
			require_once(ROOT . '/views/user/login.php');
		}
		return true;
	}

	public function actionLogout()
	{
		unset($_SESSION['user']);
		header('Location: /');
		return true;
	}
}