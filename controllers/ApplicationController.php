<?php

include_once ROOT . "/models/Application.php";

class ApplicationController
{
	public function actionIndex()
	{
		if ($_SESSION['user'] == 'admin')
			$applicationList = Application::getApplicationList();
		else
			$applicationList = Application::getApplicationListOfUser();
		require_once(ROOT . '/views/application/template.php');
		unset($_SESSION['new']);
		return true;
	}

	public function actionAdd()
	{
		if (!empty($_POST)) {
			if (!preg_match('/^\+?\d{11,12}$/', $_POST['phone'])) {
				$_SESSION['error_phone'] = true;
			}
			if (!preg_match('/^.{10,}$/', $_POST['description'])) {
				$_SESSION['error_description'] = true;
			}
			if (!isset($_SESSION['error_phone']) && !isset($_SESSION['error_description'])) {
				$_SESSION['new'] = Application::addApplicationItem($_POST['title'], $_POST['phone'], $_POST['description'], $_FILES['image']);
				echo $id;
				header('Location: /');
			}
		}
		require_once(ROOT . '/views/application/template.php');
		unset($_SESSION['error_phone']);
		unset($_SESSION['error_description']);
		return true;
	}

	public function actionEdit($id)
	{
		if (Application::isApplicationItemOfUser($id, $_SESSION['user']))
		{
			if (empty($_POST)) {
				$applicationItem = Application::getApplicationItemById($id);
			} else {
				$applicationList = Application::updateApplicationItem($id, $_POST['title'], $_POST['phone'], $_POST['description'], $_FILES['image']);
				header('Location: /');
			}
		} else {
			header('Location: /');
		}
		require_once(ROOT . '/views/application/template.php');
		return true;
	}

	public function actionDelete($id)
	{
		if (Application::isApplicationItemOfUser($id, $_SESSION['user']))
			$applicationList = Application::deleteApplicationItemById($id);
		header('Location: /');
		return true;
	}

	public function actionView($id)
	{
		if (Application::isApplicationItemOfUser($id, $_SESSION['user']))
			$applicationItem = Application::getApplicationItemById($id);
		else
			header('Location: /');
		require_once(ROOT . '/views/application/template.php');
		return true;
	}
}