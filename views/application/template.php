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
		<?php switch(Router::getFirstSegmentOfURI()): 
		case "add": ?>
		<form class="container-fluid" enctype="multipart/form-data" method="post" action="/add">
			<div class="form-group">
				<h1>Заявка</h1>
			</div>
			<div class="form-group">
				<label for="inputTitle">Название</label>
				<input id="inputTitle" class="form-control" type="text" name="title" value="" autofocus required>
			</div>
			<div class="form-group">
				<label for="inputPhone">Контактный телефон</label>
				<input id="inputPhone" class="form-control" type="text" name="phone" value="" required>
			</div>
			<div class="form-group">
				<label for="inputDescription">Описание</label>
				<textarea id="inputDescription" class="form-control" name="description" required></textarea>
			</div>
			<div class="form-group">
				<label for="inputFile">Изображение с неисправностью</label>
				<input id="inputFile" class="form-control-file" type="file" name="image" accept="image/*">
			</div>
			<div class="form-group">
				<input class="btn btn-primary" type="submit" value="Сохранить">
			</div>
		</form>
		<?php break; ?>
		<?php case "edit": ?>
		    <form class="container-fluid" enctype="multipart/form-data" method="post" action="<?="/"."edit".("/".$applicationItem['id']) ?>">
				<div class="form-group">
					<h1>Заявка</h1>
				</div>
				<div class="form-group">
					<label for="inputTitle">Название</label>
					<input id="inputTitle" class="form-control" type="text" name="title" value="<?=$applicationItem['title']?>" autofocus required>
				</div>
				<div class="form-group">
					<label for="inputPhone">Контактный телефон</label>
					<input id="inputPhone" class="form-control" type="text" name="phone" value="<?=$applicationItem['phone']?>" required>
				</div>
				<div class="form-group">
					<label for="inputDescription">Описание</label>
					<textarea id="inputDescription" class="form-control" name="description" required><?=$applicationItem['description']?></textarea>
				</div>
				<div class="form-group">
					<img src="<?=$applicationItem['image']?>"/>
				</div>
				<div class="form-group">
					<label for="inputFile">Изображение с неисправностью</label>
					<input id="inputFile" class="form-control-file" type="file" name="image" accept="image/*">
				</div>
				<div class="form-group">
					<input class="btn btn-primary" type="submit" value="Сохранить">
				</div>
			</form>
		<?php break; ?>
		<?php case "view": ?>
		    <div class="container-fluid">
				<h1 class="h3"><?=$applicationItem['title']?></h1>
				<p class="font-weight-bold"><?=$applicationItem['user']?></p>
				<p class="font-italic"><?=$applicationItem['phone']?></p>
				<p class="font-weight-normal"><?=$applicationItem['description']?></p>
				<img src="<?=$applicationItem['image']?>"/>
			</div>
		<?php break; ?>
		<?php default: ?>
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
		<?php endswitch; ?>
	 </body>
</html>