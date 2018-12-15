<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<link rel="stylesheet" href="/template/css/bootstrap.css">
		<link rel="stylesheet" href="/template/css/starter-template.css">
		<title>Заявки</title>
	</head>
	<body>
<?php include('_nav.php'); ?>
		<div class="container-fluid">
			<h1 class="h3 mb-3 font-weight-normal"><?=$applicationItem['title']?></h1>
<?php if ($_SESSION['user'] == 'admin'): ?>
			<p class="font-weight-bold"><?=$applicationItem['user']?></p>
<?php endif; ?>
			<p class="font-italic"><?=$applicationItem['phone']?></p>
			<p class="font-weight-normal"><?=$applicationItem['description']?></p>
<?php if ($applicationItem['image']): ?>
			<img src="<?=$applicationItem['image']?>"/>
<?php endif; ?>
		</div>
	</body>
</html>
