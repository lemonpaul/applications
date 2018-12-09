<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<title>Заявки на ремонт</title>
	</head>
	<body>
		<div>
			<h1>Заявки на ремонт (<?=$user?>)</h1>
<?php if ($user == 'admin'): ?>
			<a href="index.php?action=add">Добавить заявку</a>
			<a href="index.php?action=load">Список заявок в xml</a>
<?php endif ?>
		<div><br>
<?php foreach($applications as $a): ?>
				<div>
<?php if ($a['id'] == $_SESSION['new_id']): ?>
					<b>
<?php endif ?>
					<p><a href="index.php?action=view&id=<?=$a['id']?>"><?=$a['title']?></a></p>
<?php if ($user == 'admin'): ?>
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