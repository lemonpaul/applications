<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<title>Заявки на ремонт</title>
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/signin.css">
		<script src="../js/bootstrap.js"></script>
	</head>
	<body class="text-center">
<?php if (isset($_SESSION['WRONG_USER'])): ?>
			<label class="text-danger">Неправильное имя пользователя или пароль.</label>>
<?php endif ?>
				<form class="form-signin" method="post" action="index.php?action=login">
					<h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
					<label for="inputLogin" class="sr-only">Имя пользователя:</label>
					<input id="inputLogin" class="form-control" placeholder="Имя пользователя" type="text" name="user" autofocus required>
					<label for="inputPassword:" class="sr-only">Пароль:</label>
					<input id="inputPassword" class="form-control" placeholder="Пароль" type="password" name="password" required>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
				</form>
	</body>
</html>