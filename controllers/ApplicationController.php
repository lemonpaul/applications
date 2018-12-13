<?php

include_once ROOT . "/models/Application.php";

class ApplicationController
{

	public function actionIndex()
	{
		$applicationList = Application::getApplicationList();
		require_once(ROOT . '/views/application/index.php');
		return true;
	}

	public function actionAdd()
	{
		if (empty($_POST)) {
			$applicationItem = Application::newApplicationItem();
			require_once(ROOT . '/views/application/edit.php');
		}
		else {
			$applicationList = Application::updateApplicationItem($_POST['id'], $_POST['title'], $_POST['phone'], $_POST['description'], $_FILES['image']);
		}
		return true;
	}

	public function actionEdit($id)
	{
		if (empty($_POST)) {
			$applicationItem = Application::getApplicationItemById($id);
			require_once(ROOT . '/views/application/edit.php');
		} else {
			$applicationList = Application::updateApplicationItem($id, $_POST['title'], $_POST['phone'], $_POST['description'], $_FILES['image']);
			require_once(ROOT . '/views/application/index.php');	
		}
		return true;
	}

	public function actionDelete($id)
	{
		$applicationList = Application::deleteApplicationItemById($id);
		require_once(ROOT . '/views/application/index.php');
		return true;
	}

	public function actionView($id)
	{
		$applicationItem = Application::getApplicationItemById($id);
		require_once(ROOT . '/views/application/view.php');
		return true;
	}
}