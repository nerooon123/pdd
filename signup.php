<!DOCTYPE html>
<html>
<head>
	<title>Зарегистрироваться</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="signup-check.php" method="post">
     	<h2>Зарегистрироваться</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

          <label>ФИО</label>
          <?php if (isset($_GET['name'])) { ?>
               <input type="text" 
                      name="name" 
                      placeholder="ФИО"
                      value="<?php echo $_GET['name']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="name" 
                      placeholder="Name"><br>
          <?php }?>

          <label>Логин</label>
          <?php if (isset($_GET['uname'])) { ?>
               <input type="text" 
                      name="uname" 
                      placeholder="Логин"
                      value="<?php echo $_GET['uname']; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="uname" 
                      placeholder="Логин"><br>
          <?php }?>


     	<label>Пароль</label>
     	<input type="password" 
                 name="password" 
                 placeholder="Пароль"><br>

          <label>Пароль повторно</label>
          <input type="password" 
                 name="re_password" 
                 placeholder="Пароль повторно"><br>

     	<button type="submit">Зарегистрироваться</button>
          <a href="index.php" class="ca">Уже есть аккаунт?</a>
     </form>
</body>
</html>