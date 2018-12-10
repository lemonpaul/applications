<?php

require_once("login.php");
require_once("database.php");
require_once("models/applications.php");

session_start();

$link = db_connect();

if (isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "";

if ($action == "add") {
    if (!empty($_POST)) {
        if (checkPhone($_POST['phone']) && checkDescription($_POST['description'])) {
        	
            unset($_SESSION['wrong_phone']);
            unset($_SESSION['wrong_description']);
            $_SESSION['new_id'] = applicationNew($link, $user, $_POST['title'], $_POST['phone'], $_POST['description'], $_FILES['image']);
            header("Location: index.php");
        } else {
            if (!checkPhone($_POST['phone']))
                $_SESSION['wrong_phone'] = true;
            if (!checkDescription($_POST['description']))
                $_SESSION['wrong_description'] = true;
        }
    } else {
        unset($_SESSION['wrong_phone']);
        unset($_SESSION['wrong_description']);
    }
    include("views/application_edit.php");
} elseif ($action == "edit") {
    if (!isset($_GET['id']))
        header("Location: index.php");
    $id = (int)$_GET['id'];
    if (!empty($_POST) && $id > 0) {
        if (checkPhone($_POST['phone']) && checkDescription($_POST['description'])) {
            unset($_SESSION['wrong_phone']);
            unset($_SESSION['wrong_description']);
            applicationEdit($link, $id, $user, $_POST['title'], $_POST['phone'], $_POST['description'], $_FILES['image']);
            header("Location: index.php");
        } else {
            if (!checkPhone($_POST['phone']))
                $_SESSION['wrong_phone'] = true;
            if (!checkDescription($_POST['description']))
                $_SESSION['wrong_description'] = true;
        }
    } else {
        unset($_SESSION['wrong_phone']);
        unset($_SESSION['wrong_description']);
    }
    $application = applicationGet($link, $id, $user);
    include("views/application_edit.php");
} elseif ($action == "delete") {
    $id = $_GET['id'];
    applicationDelete($link, $id, $user);
    header("Location: index.php");
} elseif ($action == "view") {
    $id = $_GET['id'];
    $application = applicationGet($link, $id, $user);
    include("views/application.php");
} elseif ($action == "load") {
    if ($user == 'admin') {
        echo applicationsXml($link);
        header('Content-Disposition: attachment;filename=applications.xml');
    } else {
        header("Location: index.php");
    }
} else {
    $applications = applicationsAll($link, $user);
    include("views/applications.php");
    unset($_SESSION['new_id']);
}

?>
