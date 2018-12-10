<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<title>Заявки на ремонт</title>
	</head>
	<body>
		<div>
			<h1>Заявки на ремонт (<?=$_SESSION['USER']?>)</h1>
			<a href="index.php?action=add">Добавить заявку</a>
<?php if ($login == 'admin'): ?>
			<a href="index.php?action=load">Список заявок в xml</a>
<?php endif ?>
			<a href="index.php?action=logout">Выход</a>
		<div><br>
<?php foreach($applications as $a): ?>
				<div>
<?php if ($a['id'] == $_SESSION['NEW_ID']): ?>
					<b>
<?php endif ?>
					<p><a href="index.php?action=view&id=<?=$a['id']?>"><?=$a['title']?></a></p>
<?php if ($_SESSION['USER'] == 'admin'): ?>
					<p><i>Пользователь: <?=$a['user']?></i></p>
<?php endif ?>
					<p><i>Контактный телефон: <?=$a['phone']?></i></p>
					<p><?=applicationIntro($a['description'])?></p>
					<a href="index.php?action=edit&id=<?=$a['id']?>">Редактировать</a>
					<a href="index.php?action=delete&id=<?=$a['id']?>">Удалить</a>
<?php if ($a['id'] == $_SESSION['new_id']): ?> 
					</b>
<?php endif ?>
				</div><br>
<?php endforeach ?>
			</div>
		</div>
	</body>
</html>