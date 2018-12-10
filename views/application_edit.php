<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<title>Заявки на ремонт</title>
	</head>
	<body>
		<div>
			<h1>Заявка на ремонт (<?=$login?>)</h1>
<?php if ($_SESSION['wrong_phone']): ?>
			<p><font color="red">Неправильный номер телефона.</font></p>
<?php endif ?>
<?php if ($_SESSION['wrong_description']): ?>
			<p><font color="red">Описание должно содержать минимум 10 символов.</font></p>
<?php endif ?>
			<div>
				<form enctype="multipart/form-data" method="post" action="index.php?action=<?=$_GET['action']?>&id=<?=$_GET['id']?>">
					<p>Название:</p>
					<input type="text" name="title" value="<?=$application['title']?>" autofocus required>
					
					<p>Контактный телефон:</p>
					<input type="text" name="phone" value="<?=$application['phone']?>" required>

					<p>Описание:</p>
					<textarea name="description" required><?=$application['description']?></textarea>

					<p>Изображение с неисправностью:</p>
<?php if ($application['image']): ?>
					<img src="<?=$application['image']?>"/><br>
<?php endif ?>
					<input type="file" name="image" accept="image/*"><br><br>

					<input type="submit" value="Сохранить">
				</form>
			</div>
		</div>
	</body>
</html>