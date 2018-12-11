<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/starter-template.css">
		<script src="../js/bootstrap.js"></script>
		<title>Заявки на ремонт</title>
	</head>
	<body>
		<nav class="navbar navbar-collapse navbar-dark bg-dark fixed-top">
	        <a href="index.php" class="navbar-brand">
	        	<strong>Заявки</strong>
	        </a>
	    	<div class="navbar-right">
	    		<div class="navbar-brand"><?=$_SESSION['USER']?></div>
	    		<a class="navbar-toggle" href="index.php?action=logout">Выйти</a>
	    	</div>
	    </nav>
				<form class="container-fluid" enctype="multipart/form-data" method="post" action="<?=getURL($_GET)?>">
					<div class="form-group">
						<h1>Заявка</h1>
<?php if (isset($_SESSION['WRONG_PHONE'])): ?>
							<label class="text-danger">Неправильный номер телефона.</label>
<?php endif ?>
<?php if (isset($_SESSION['WRONG_DESCRIPTION'])): ?>
							<label class="text-danger">Описание должно содержать минимум 10 символов.</label>
<?php endif ?>
					</div>
					<div class="form-group">
						<label for="inputTitle">Название</label>
						<input id="inputTitle" class="form-control" type="text" name="title" value="<?=isset($application['title'])?$application['title']:null?>" autofocus required>
					</div>
					<div class="form-group">
						<label for="inputPhone">Контактный телефон</label>
						<input id="inputPhone" class="form-control" type="text" name="phone" value="<?=isset($application['phone'])?$application['phone']:null?>" required>
					</div>
					<div class="form-group">
						<label for="inputDescription">Описание</label>
						<textarea id="inputDescription" class="form-control" name="description" required><?=isset($application['description'])?$application['description']:null?></textarea>
					</div>
<?php if (isset($application['image'])): ?>
					<div class="form-group">
						<img src="<?=$application['image']?>"/>
					</div>
<?php endif ?>
					<div class="form-group">
						<label for="inputFile">Изображение с неисправностью</label>
						<input id="inputFile" class="form-control-file" type="file" name="image" accept="image/*">
					</div>

					<input type="submit" value="Сохранить">
				</form>
	</body>
</html>