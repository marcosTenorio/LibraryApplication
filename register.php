<?php
session_start();

?>

<?php
$usernameErr = "";
$username = "";
$studentNumberErr = "";
$studentNumber = "";
$password = "";
$passwordErr = "";
$captchaErr = "";

if(isset($_POST['username']) and ($_POST['password']) and ($_POST['studentNumber'])){
	
	include "captcha.php";
	
    $username = $_POST['username'];
	$studentNumber = $_POST['studentNumber'];
    $password = $_POST['password'];
	
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	
	
	if (empty($username) || strlen($username) < 4) {
        $usernameErr = "*Username is required, at least 3 chars";
	}
	if (empty($studentNumber) || strlen($studentNumber) < 7) {
        $usernameErr = "*Student number is required, 7 numbers";
	}
	if (strlen($password) < 4){
		$passwordErr = '*Password is too short';
	}
	
	// your secret key
	$secret = "6LeyyDoUAAAAAI2sN9Ep-z6wtJsxOjclHGpbAAyK"; 
	// empty response
	$response = null;	 
	// check secret key
	$reCaptcha = new ReCaptcha($secret); 
	// if submitted check response
	if ($_POST["g-recaptcha-response"]) {
		$response = $reCaptcha->verifyResponse(
			$_SERVER["REMOTE_ADDR"],
			$_POST["g-recaptcha-response"]
		);
	}
	if ($response != null && $response->success) 
		$captchaErr="";  
	else
		$captchaErr="Bad Response from Captcha"; 
	
	
	   
	if (empty($usernameErr) && empty($passwordErr) && empty($studentNumberErr) && empty($captchaErr)) {		   
    
	  try {
        $host = '127.0.0.1';
        $dbname = 'library';
        $user = 'root';
        $pass = '';
       
		
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

		$sql = "INSERT INTO user (username, password, studentNumber) VALUES (?, ?, ?);";
		$sth = $DBH->prepare($sql);
		
		$sth->bindParam(1, $username);
		$sth->bindParam(2, $hashed_password);
		$sth->bindParam(3, $studentNumber);
		
		$sth->execute();
		$_SESSION["username"] = $username;
		$_SESSION["studentNumber"] = $studentNumber;
		header('Location:  login.php');
		exit();
		
		echo 'You are now registered!';
		 } catch(PDOException $e) {echo 'Error' . $e;} 

	}	 
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
<h2> Registration Form</h2>
	<form class='form-style' action="register.php" method="post">
		Username <input type="text" name="username" required minlength='4'/><br/>
			<span class = "error"><?php echo $usernameErr;?></span>
		Student Number <input type="text" name="studentNumber" required minlength='7' maxlength='7'/><br/>
			<span class = "error"><?php echo $studentNumberErr;?></span>
		Password <input type="password" name="password" required/>
			<span class = "error"> <?php echo $passwordErr;?></span>
			<div class="g-recaptcha" data-sitekey="6LeyyDoUAAAAAKFOdy67licu2jriJoSDH2YZ2os7"></div>
			<span class = "error"><?php echo $captchaErr;?></span>
		<input type="submit" class='button' name='submit' value= 'Register'/>
	</form>

	<!--js-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>