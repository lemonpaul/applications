<?php

include_once ROOT . "/models/User.php";

class UserController
{
    public function actionLogout()
    {
        unset($_SESSION['user']);
        header('Location: /');
        return true;
    }

    public function actionLogin()
    {
        if (!empty($_POST))
        {
            if (User::isUserItem($_POST['login'], $_POST['password']))
            {
                $_SESSION['user'] = $_POST['login'];
                header('Location: /');
            } else {
                $_SESSION['error_login'] = true;
            }
        }
        require_once(ROOT . '/views/user/login.php');
        unset($_SESSION['error_login']);
        return true;
    }
}