<?php
return array(
	'add/([0-9]+)' => 'application/add/$1',
	'add' => 'application/add',
	'edit/([0-9]+)' => 'application/edit/$1',
	'delete/([0-9]+)' => 'application/delete/$1',
	'view/([0-9]+)' => 'application/view/$1',
	'list' => 'application/index',
	'login' => 'user/login',
	'logout' => 'user/logout',
	'' => 'application/index',
);