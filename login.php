<?php

require_once("database.php");

$login = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

$link = db_connect();

$query = $link->prepare("SELECT * FROM users WHERE login=?");
$query->execute(array($login));
$user = $query->fetch(PDO::FETCH_ASSOC);

$validated = ($password == $user['password']);

if (!$validated) {
    header('WWW-Authenticate: Basic');
    header('HTTP/1.0 401 Unauthorized');
    die ("Authentication required");
}

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic');
    header('HTTP/1.0 401 Unauthorized');
}

?>
