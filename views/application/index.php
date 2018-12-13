<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<link rel="stylesheet" href="/template/css/bootstrap.css">
		<link rel="stylesheet" href="/template/css/starter-template.css">
		<title>Заявки</title>
	</head>
	<body>
		<nav class="navbar navbar-collapse navbar-dark bg-dark fixed-top">
	        <a href="/list" class="navbar-brand">
	        	<strong>Заявки</strong>
	        </a>
	    	<div class="navbar-right">
	    		<div class="navbar-brand">USER</div>
	    		<a class="navbar-toggle" href="/logout">Выйти</a>
	    	</div>
	    </nav>
		<div class="container-fluid">
			<h1 class="h3">Список заявок</h1>
			<table class="table table-bordered">
				<thead>
				    <tr>
				        <th scope="col">Название</th>
				        <th scope="col">Пользователь</th>
				        <th scope="col">Телефон</th>
				        <th scope="col">Описание</th>
				        <th scope="col">Изображение</th>
				        <th scope="col"></th>
				        <th scope="col"></th>
				   	</tr>
			    </thead>
			    <tbody>
					<?php foreach($applicationList as $application): ?>
					<tr>			
						<td><a href="/view/<?=$application['id']?>"><?=$application['title']?></a></td>
						<td><?=$application['user']?></td>
						<td><?=$application['phone']?></td>
						<td><?=$application['description']?></td>
						<td><?=$application['image']?></td>
						<td><a class="btn btn-primary" href="/edit/<?=$application['id']?>">Редактировать</a></td>
						<td><a class="btn btn-danger" href="/delete/<?=$application['id']?>">Удалить</a></td>
					</tr>
					<?php endforeach ?>
			    </tbody>
			</table>
			<a class="btn btn-primary" href="/add">Добавить заявку</a>
			<!-- <a class="btn btn-success" href="index.php?action=load">Скачать в xml</a> -->
		</div>
	</body>
</html>