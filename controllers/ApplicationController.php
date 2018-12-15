<?php

class ApplicationController
{
    public function actionIndex()
    {
        if ($_SESSION['user'] == 'admin')
            $applicationList = Application::getApplicationList();
        else
            $applicationList = Application::getUsersApplicationList();
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
            if ($_FILES['image']['tmp_name'] && !preg_match('/^image\/.*/', mime_content_type($_FILES['image']['tmp_name']))) {
                $_SESSION['error_image'] = true;
            }
            if (!isset($_SESSION['error_phone']) && !isset($_SESSION['error_description']) && !isset($_SESSION['error_image'])) {
                $_SESSION['new'] = Application::addApplicationItem($_POST['title'], $_POST['phone'], $_POST['description'], $_FILES['image']);
                header('Location: /');
            }
        }
        require_once(ROOT . '/views/application/template.php');
        unset($_SESSION['error_phone']);
        unset($_SESSION['error_description']);
        unset($_SESSION['error_image']);
        return true;
    }

    public function actionEdit($id)
    {
        if (Application::isUsersApplicationItem($id, $_SESSION['user']))
        {
            $applicationItem = Application::getApplicationItem($id);
            if (!empty($_POST)) {
                if (!preg_match('/^\+?\d{11,12}$/', $_POST['phone'])) {
                    $_SESSION['error_phone'] = true;
                }
                if (!preg_match('/^.{10,}$/', $_POST['description'])) {
                    $_SESSION['error_description'] = true;
                }
                if ($_FILES['image']['tmp_name'] && !preg_match('/^image\/.*/', mime_content_type($_FILES['image']['tmp_name']))) {
                    $_SESSION['error_image'] = true;
                }
                if (!isset($_SESSION['error_phone']) && !isset($_SESSION['error_description']) && !isset($_SESSION['error_image'])) {
                    if (!Application::updateApplicationItem($id, $_POST['title'], $_POST['phone'], $_POST['description'], $_FILES['image']))
                    {
                        $_SESSION['error_update'] = true;
                    } else {
                        header('Location: /');
                    }
                }
            }
        } else {
            header('Location: /');
        }
        require_once(ROOT . '/views/application/template.php');
        unset($_SESSION['error_phone']);
        unset($_SESSION['error_description']);
        unset($_SESSION['error_image']);
        unset($_SESSION['error_update']);
        return true;
    }

    public function actionDelete($id)
    {
        if (Application::isUsersApplicationItem($id, $_SESSION['user']))
            $applicationList = Application::deleteApplicationItem($id);
        header('Location: /');
        return true;
    }

    public function actionView($id)
    {
        if (Application::isUsersApplicationItem($id, $_SESSION['user']))
            $applicationItem = Application::getApplicationItem($id);
        else
            header('Location: /');
        require_once(ROOT . '/views/application/template.php');
        return true;
    }

    public function actionLoad()
    {
        if ($_SESSION['user'] == 'admin') {
            $xmlElement = Application::getApplicationListAsXML();
            echo $xmlElement->asXML();
            header('Content-Disposition: attachment;filename=applicationList.xml');
        } else
            header('Location: /');
        return true;
    }
}
