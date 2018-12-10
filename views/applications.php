<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/starter-template.css">
		<script src="../js/bootstrap.js"></script>
		<title>Заявки на ремонт</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
			<div class="container d-flex justify-content-between">
	        	<a href="index.php" class="navbar-brand d-flex align-items-center">
	        		<strong>Заявки</strong>
	        	</a>
	        </div>
	    	<div class="navbar-brand"><?=$_SESSION['USER']?></div>
	    	<a class="navbar-nav" href="index.php?action=logout">Выйти</a>
	    </nav>
		<main role="main" class="container">
			<h1 class="h3">Список заявок (<?=$_SESSION['USER']?>)</h1>
			<table class="table table-bordered">
				<thead>
				    <tr>
				        <th scope="col">Название</th>
<?php if ($_SESSION['USER'] == 'admin'): ?>
				        <th scope="col">Пользователь</th>
<?php endif ?>
				        <th scope="col">Телефон</th>
				        <th scope="col">Описание</th>
				        <th scope="col">Изображение</th>
				        <th scope="col"></th>
				        <th scope="col"></th>
				   	</tr>
			    </thead>
			    <tbody>
<?php foreach($applications as $a): ?>
<?php if (isset($_SESSION['NEW_ID']) && ($a['id'] == $_SESSION['NEW_ID'])): ?>
					<tr class="font-weight-bold">
<?php else: ?>
					<tr>			
<?php endif ?>
						<td><a href="index.php?action=view&id=<?=$a['id']?>"><?=$a['title']?></a></td>
<?php if ($_SESSION['USER'] == 'admin'): ?>
						<td><?=$a['user']?></td>
<?php endif ?>
						<td><?=$a['phone']?></td>
						<td><?=strict($a['description'], 14)?></td>
						<td><?=strict($a['image'], 14)?></td>
						<td><a class="btn btn-primary" href="index.php?action=edit&id=<?=$a['id']?>">Редактировать</a></td>
						<td><a class="btn btn-danger" href="index.php?action=delete&id=<?=$a['id']?>">Удалить</a></td>
					</tr>
<?php endforeach ?>
			    </tbody>
			</table>
			<a class="btn btn-primary" href="index.php?action=add">Добавить заявку</a>
<?php if ($_SESSION['USER'] == 'admin'): ?>
				<a class="btn btn-success" href="index.php?action=load">Скачать в xml</a>
<?php endif ?>
		</main>
	</body>
</html>