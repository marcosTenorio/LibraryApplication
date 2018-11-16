<?php
session_start();

?>
<!DOCTYPE>
<html>
<head>
  <link rel="stylesheet" href="style.css">
    <style>
	.error {display: block;color: #FF0000; }
	</style>
</head>
<body>
<h2> Online Library Application</h2>
<form class='form-style' action="register.php" method="post">
	<input type="submit" class='button' name='submit' value= 'Register'/>
</form>
<form class='form-style' action="login.php" method="post">
	<input type="submit" class='button' name='submit' value= 'Login'/>
</form>
</body>
</html>