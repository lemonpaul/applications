<?php

function userGet($link, $login)
{
    $query = $link->prepare("SELECT * FROM users WHERE login = ?");
    $query->execute(array($login));
    $user = $query->fetch(PDO::FETCH_ASSOC);
    return $user;
}

?>
