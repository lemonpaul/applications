<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<title>Заявки на ремонт</title>
	</head>
	<body>
		<div>
			<h1>Заявка на ремонт (<?=$_SESSION['USER']?>)</h1>
			<div>
				<div>
					<h3><?=$application['title']?></h3>
<?php if ($_SESSION['USER'] == 'admin'): ?>
					<p><i>Пользователь: <?=$application['user']?></i></p>
<?php endif ?>
					<p><i>Контактный телефон: <?=$application['phone']?></i></p>
					<p><?=$application['description']?></p>
<?php if ($application['image']): ?>
					<img src="<?=$application['image']?>"/>
<?php endif ?>
				</div>
			</div>
		</div>
	</body>
</html>