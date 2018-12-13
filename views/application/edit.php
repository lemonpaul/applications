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
		<form class="container-fluid" enctype="multipart/form-data" method="post" action="<?="/".Router::getFirstSegmentOfURI().((Router::getFirstSegmentOfURI() == "edit") ? ("/".$applicationItem['id']) : "" )?>">
			<div class="form-group">
				<h1>Заявка</h1>
			</div>
			<div class="form-group">
				<label for="inputTitle">Название</label>
				<input id="inputTitle" class="form-control" type="text" name="title" value="<?=isset($applicationItem['title'])?$applicationItem['title']:null?>" autofocus required>
			</div>
			<div class="form-group">
				<label for="inputPhone">Контактный телефон</label>
				<input id="inputPhone" class="form-control" type="text" name="phone" value="<?=isset($applicationItem['phone'])?$applicationItem['phone']:null?>" required>
			</div>
			<div class="form-group">
				<label for="inputDescription">Описание</label>
				<textarea id="inputDescription" class="form-control" name="description" required><?=isset($applicationItem['description'])?$applicationItem['description']:null?></textarea>
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
	</body>
</html>