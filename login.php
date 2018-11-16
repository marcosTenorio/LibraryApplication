<?php
session_start();

?>

<?php


if(isset($_POST['Login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
	
    
    try {
        $host = '127.0.0.1';
        $dbname = 'library';
        $user = 'root';
        $pass = '';
		$port=3306;
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $user, $pass);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$q = $DBH->prepare("SELECT * FROM user WHERE username = :username LIMIT 1");
		$q->bindValue(':username', $username);
		//$q->bindValue(':password', $password);
		$q->execute();
		
		$row = $q->fetch(PDO::FETCH_ASSOC);
		 
		
		$message = '';
		if (!empty($row)){ //is the array empty
			$username = $row['username'];
			//$password = $row['password'];
			$studentNumber = $row['studentNumber'];
			$_SESSION["username"] = $username;
			//$_SESSION["password"] = $password;
			$_SESSION["studentNumber"] = $studentNumber;
			$password_hash = $row['password'];
			if(password_verify($password, $password_hash)){
				if ($username === 'admin' && $password === 'admin'){					
					header('Location:  admin.php');
				}else{
					header('Location: confirm.php');
				}
			}else{
				$message= 'Sorry your log in details are not correct';
			}
		}else {
		    $message= 'Sorry your log in details are not correct';
		}
	} catch(PDOException $e) {echo $e->getMessage();}
}
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
<h2>Login</h2><br></br> 

<form class='form-style' action="login.php" method="post">  
Username <input type="text" name="username" required/>  
Password <input type="password" name="password" required/>
<input type="submit" name="Login" value="Login" class='button'/>
<?php
if(!empty($message)){  echo '<br>';
echo $message;
}
if(isset($_SESSION["LoginFail"])){  echo '<br>';
echo 'Login Failed! Please, try again.';
}
?>
</form>
</body>
</html>