<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<link rel="stylesheet" href="/template/css/bootstrap.css">
		<link rel="stylesheet" href="/template/css/starter-template.css">
		<title>Заявки</title>
	</head>
	<body>
<?php include("_nav.php"); ?>
		<div class="container-fluid">
			<h1 class="h3 mb-3 font-weight-normal">Список заявок</h1>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">Название</th>
						<?php if ($_SESSION['user'] == 'admin'): ?>
						<th scope="col">Пользователь</th>
						<?php endif; ?>
						<th scope="col">Телефон</th>
						<th scope="col">Описание</th>
						<th scope="col">Изображение</th>
						<th scope="col"></th>
						<th scope="col"></th>
					   </tr>
				</thead>
				<tbody>
<?php foreach($applicationList as $application): ?>
<?php if (isset($_SESSION['new']) && $application['id'] == $_SESSION['new']): ?>
					<tr class="font-weight-bold">
<?php else: ?>
					<tr>
<?php endif; ?>
						<td><a href="/view/<?=$application['id']?>"><?=$application['title']?></a></td>
<?php if ($_SESSION['user'] == 'admin'): ?>
						<td><?=$application['user']?></td>
<?php endif; ?>
						<td><?=$application['phone']?></td>
						<td><?=$application['description']?></td>
						<td><?=$application['image']?></td>
						<td><a class="btn btn-primary" href="/edit/<?=$application['id']?>">Редактировать</a></td>
						<td><a class="btn btn-danger" href="/delete/<?=$application['id']?>">Удалить</a></td>
					</tr>
<?php endforeach; ?>
				</tbody>
			</table>
			<a class="btn btn-primary" href="/add">Добавить заявку</a>
<?php if ($_SESSION['user'] == 'admin'): ?>
			<a class="btn btn-success" href="/load">Скачать в xml</a>
<?php endif; ?>
		</div>
	</body>
</html>
