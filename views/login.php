<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
		<title>Заявки на ремонт</title>
	</head>
	<body>
		<div>
			<h1>Авторизация</h1>
<?php if (isset($_SESSION['WRONG_USER'])): ?>
			<p><font color="red">Неправильное имя пользователя или пароль.</font></p>
<?php endif ?>
			<div>
				<form method="post" action="index.php?action=login">
					<p>Имя пользователя:</p>
					<input type="text" name="user" autofocus required>
					
					<p>Пароль:</p>
					<input type="password" name="password" required>

					<br><br><input type="submit" value="Войти">
				</form>
			</div>
		</div>
	</body>
</html>