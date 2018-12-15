<?php

class User
{
    public static function isUserItem($login, $password)
    {
        $db = Db::getConnection();
        $statement = $db->prepare('SELECT * FROM users WHERE login=?');
        $statement->execute(array($login));
        $userItem = $statement->fetch(PDO::FETCH_ASSOC);
        return password_verify($password, $userItem['password']);
    }
}
