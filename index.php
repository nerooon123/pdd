<!DOCTYPE html>
<html>
<head>
	<title>Войти</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="login.php" method="post">
     	<h2>Войти</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>Логин</label>
     	<input type="text" name="uname" placeholder="User Name"><br>

     	<label>Пароль</label>
     	<input type="password" name="password" placeholder="Password"><br>

     	<button type="submit">Войти</button>
          <a href="signup.php" class="ca">Зарегистрироваться</a>
     </form>
</body>
</html>