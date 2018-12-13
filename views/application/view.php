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
	    		<a class="navbar-toggle" href="index.php?action=logout">Выйти</a>
	    	</div>
	    </nav>
		<div class="container-fluid">
			<h1 class="h3"><?=$applicationItem['title']?></h1>
			<p class="font-weight-bold"><?=$applicationItem['user']?></p>
			<p class="font-italic"><?=$applicationItem['phone']?></p>
			<p class="font-weight-normal"><?=$applicationItem['description']?></p>
			<img src="<?=$applicationItem['image']?>"/>
		</div>
	</body>
</html>