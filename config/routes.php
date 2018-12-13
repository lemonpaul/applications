<?php
return array(
    'list' => 'application/index',
    'add' => 'application/add',
    'edit/([0-9]+)' => 'application/edit/$1',
    'delete/([0-9]+)' => 'application/delete/$1',
    'view/([0-9]+)' => 'application/view/$1',
    'load' => 'application/load',
    'logout' => 'user/logout',
    'login' => 'user/login',
    '' => 'application/index',
);