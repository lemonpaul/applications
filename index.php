<?php

session_start();

require_once("models/databases.php");
require_once("models/applications.php");
require_once("models/users.php");

$link = db_connect();

$action = (isset($_GET['action'])) ? $_GET['action'] : "";

if (!isset($_SESSION['USER']) && ($action != "login"))
{
    unset($_SESSION['WRONG_USER']);
    include("views/login.php");
    exit();
}

if ($action == "add") {
    if (!empty($_POST)) {
        if (checkPhone($_POST['phone']) && checkDescription($_POST['description'])) {
            
            unset($_SESSION['WRONG_PHONE']);
            unset($_SESSION['WRONG_DESCRIPTION']);
            $_SESSION['NEW_ID'] = applicationNew($link, $_SESSION['USER'], $_POST['title'], $_POST['phone'], $_POST['description'], $_FILES['image']);
            header("Location: index.php");
        } else {
            if (!checkPhone($_POST['phone']))
                $_SESSION['WRONG_PHONE'] = true;
            if (!checkDescription($_POST['description']))
                $_SESSION['WRONG_DESCRIPTION'] = true;
        }
    } else {
        unset($_SESSION['WRONG_PHONE']);
        unset($_SESSION['WRONG_DESCRIPTION']);
    }
    include("views/application_edit.php");
} elseif ($action == "edit") {
    if (!isset($_GET['id']))
        header("Location: index.php");
    $id = (int)$_GET['id'];
    if (!empty($_POST) && $id > 0) {
        if (checkPhone($_POST['phone']) && checkDescription($_POST['description'])) {
            unset($_SESSION['WRONG_PHONE']);
            unset($_SESSION['WRONG_DESCRIPTION']);
            applicationEdit($link, $id, $_SESSION['USER'], $_POST['title'], $_POST['phone'], $_POST['description'], $_FILES['image']);
            header("Location: index.php");
        } else {
            if (!checkPhone($_POST['phone']))
                $_SESSION['WRONG_PHONE'] = true;
            if (!checkDescription($_POST['description']))
                $_SESSION['WRONG_DESCRIPTION'] = true;
        }
    } else {
        unset($_SESSION['WRONG_PHONE']);
        unset($_SESSION['WRONG_DESCRIPTION']);
    }
    $application = applicationGet($link, $id, $_SESSION['USER']);
    include("views/application_edit.php");
} elseif ($action == "delete") {
    $id = $_GET['id'];
    applicationDelete($link, $id, $_SESSION['USER']);
    header("Location: index.php");
} elseif ($action == "view") {
    $id = $_GET['id'];
    $application = applicationGet($link, $id, $_SESSION['USER']);
    include("views/application.php");
} elseif ($action == "load") {
    if ($_SESSION['USER']== 'admin') {
        echo applicationsXml($link);
        header('Content-Disposition: attachment;filename=applications.xml');
    } else {
        header("Location: index.php");
    }
} elseif ($action == "logout") {
    unset($_SESSION['USER']);
    header("Location: index.php");
} elseif ($action == "login") {
    if (!empty($_POST)) {
        $user = userGet($link, $_POST['user']);
        if ($user['password'] != md5($_POST['password'])) {
            $_SESSION['WRONG_USER'] = true;
            include("views/login.php");
        } else {
            $_SESSION['USER'] = $_POST['user'];
            unset($_SESSION['WRONG_USER']);
            header("Location: index.php");
        }
    } else {
        unset($_SESSION['WRONG_USER']);
        include("views/login.php");
    }
} else {
    $applications = applicationsAll($link, $_SESSION['USER']);
    include("views/applications.php");
    unset($_SESSION['NEW_ID']);
}

?>
