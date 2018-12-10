<?php

define('MYSQL_DSN', 'mysql:dbname=test;host=localhost;charset=utf8');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');

function db_connect()
{
    try {
        $link = new PDO(MYSQL_DSN, MYSQL_USER, MYSQL_PASSWORD);
    } catch (PDOException $e) {
        die("Error: ".$e->getMessage());
    }
    return $link;
}

?>
