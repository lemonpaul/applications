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
		<form class="container-fluid" enctype="multipart/form-data" method="post" action="<?="/edit".("/".$applicationItem['id']) ?>">
			<div class="form-group">
				<h1 class="h3 mb-3 font-weight-normal">Заявка</h1>
			</div>
<?php if (isset($_SESSION['error_phone'])): ?>
			<div class="form text-danger">
				<p>Неправильный формат номера телефона.</p>
			</div>
<?php endif; ?>
<?php if (isset($_SESSION['error_description'])): ?>
			<div class="form-group text-danger">
				<p>Описание должно содержать минимум 10 символов.</p>
			</div>
<?php endif; ?>
<?php if (isset($_SESSION['error_image'])): ?>
			<div class="form-group text-danger">
				<p>Выбранный файл не является изображением.</p>
			</div>
<?php endif; ?>
<?php if (isset($_SESSION['error_update'])): ?>
			<div class="form-group text-danger">
				<p>Невозможно обновить заявку.</p>
			</div>
<?php endif; ?>
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
<?php if ($applicationItem['image']): ?>
			<div class="form-group">
				<img src="<?=$applicationItem['image']?>"/>
			</div>
<?php endif; ?>
			<div class="form-group">
				<label for="inputFile">Изображение с неисправностью</label>
				<input id="inputFile" class="form-control-file" type="file" name="image" accept="image/*">
			</div>
			<div class="form-group">
				<input class="btn btn-primary" type="submit" value="Сохранить">
			</div>
		</form>
	</body>
</html>
