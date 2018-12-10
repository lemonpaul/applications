<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<title>Заявки на ремонт</title>
	</head>
	<body>
		<div>
			<h1>Заявка на ремонт (<?=$_SESSION['USER']?>)</h1>
<?php if (isset($_SESSION['WRONG_PHONE'])): ?>
			<p><font color="red">Неправильный номер телефона.</font></p>
<?php endif ?>
<?php if (isset($_SESSION['WRONG_DESCRIPTION'])): ?>
			<p><font color="red">Описание должно содержать минимум 10 символов.</font></p>
<?php endif ?>
			<div>
				<form enctype="multipart/form-data" method="post" action="<?=getURL($_GET)?>">
					<p>Название:</p>
					<input type="text" name="title" value="<?=isset($application['title'])?$application['title']:null?>" autofocus required>
					
					<p>Контактный телефон:</p>
					<input type="text" name="phone" value="<?=isset($application['phone'])?$application['phone']:null?>" required>

					<p>Описание:</p>
					<textarea name="description" required><?=isset($application['description'])?$application['description']:null?></textarea>

					<p>Изображение с неисправностью:</p>
<?php if (isset($application['image'])): ?>
					<img src="<?=$application['image']?>"/><br>
<?php endif ?>
					<input type="file" name="image" accept="image/*"><br><br>

					<input type="submit" value="Сохранить">
				</form>
			</div>
		</div>
	</body>
</html>