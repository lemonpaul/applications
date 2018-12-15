<?php

class User
{
    public static function isUserItem($login, $password)
    {
        $db = Db::getConnection();
        $statement = $db->prepare('SELECT * FROM users WHERE login=? AND password=?');
        $statement->execute(array($login, md5($password)));
        $userItem = $statement->fetch(PDO::FETCH_ASSOC);
        return $userItem['login'] == $login;
    }
}
