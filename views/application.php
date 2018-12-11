<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/starter-template.css">
		<title>Заявки</title>
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
		<div class="container-fluid">
			<h1 class="h3"><?=$application['title']?></h1>
<?php if ($_SESSION['USER'] == 'admin'): ?>
			<p class="font-weight-bold"><?=$application['user']?></p>
<?php endif ?>
			<p class="font-italic"><?=$application['phone']?></p>
			<p class="font-weight-normal"><?=$application['description']?></p>
<?php if ($application['image']): ?>
			<img src="<?=$application['image']?>"/>
<?php endif ?>
		</div>
	</body>
</html>