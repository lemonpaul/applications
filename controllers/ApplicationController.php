<?php

include_once ROOT . "/models/Application.php";

class ApplicationController
{

	public function actionIndex()
	{
		$applicationList = Application::getApplicationList();
		require_once(ROOT . '/views/application/template.php');
		return true;
	}

	public function actionAdd()
	{
		if (empty($_POST)) {
			require_once(ROOT . '/views/application/template.php');
		}
		else {
			$applicationItem = Application::newApplicationItem();
			$applicationList = Application::updateApplicationItem($applicationItem['id'], $_POST['title'], $_POST['phone'], $_POST['description'], $_FILES['image']);
			header('Location: /');
			require_once(ROOT . '/views/application/template.php');
		}
		return true;
	}

	public function actionEdit($id)
	{
		if (empty($_POST)) {
			$applicationItem = Application::getApplicationItemById($id);
			require_once(ROOT . '/views/application/template.php');
		} else {
			$applicationList = Application::updateApplicationItem($id, $_POST['title'], $_POST['phone'], $_POST['description'], $_FILES['image']);
			header('Location: /');
			require_once(ROOT . '/views/application/template.php');	
		}
		return true;
	}

	public function actionDelete($id)
	{
		$applicationList = Application::deleteApplicationItemById($id);
		header('Location: /');
		require_once(ROOT . '/views/application/template.php');
		return true;
	}

	public function actionView($id)
	{
		$applicationItem = Application::getApplicationItemById($id);
		require_once(ROOT . '/views/application/template.php');
		return true;
	}
}