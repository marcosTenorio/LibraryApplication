<?php
session_start();
include('header.php'); 

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
	// get session variables
	if (isset($_SESSION["username"]))  {
		echo "<br/>Logged in as: ".$_SESSION["username"];
		$user_id = $_SESSION["studentNumber"];
	}
?>

<form class='form-style' action="logout.php" method="post">
	<input type="submit" class='logout' name='submit' value= 'Logout'/><br/>
</form>


</body>
<form class='title'>
<h2>Your checked out books</h2>
</form>
</html>


<?php
	include('db.php');
if($_GET){
	$pid = $_GET['id'];
	
	$stmt = $DBH->prepare("UPDATE book SET studentNumber = :userid WHERE isbn = :pid");
	$stmt->bindValue(':userid', $user_id);
	$stmt->bindValue(':pid', $pid);
	$stmt->execute();
	include('errordb.php');

	$weekstr = date('Y-m-d', strtotime(' + 7 days'));//add seven days to todays date
	
	$codate = $weekstr;
	$stmt = $DBH->prepare("INSERT INTO library.transaction (studentNumber, isbn, due_date) VALUES (:userid, :bookid, :codate)");
	$stmt->bindValue(':userid', $user_id);
	$stmt->bindValue(':bookid', $pid);
	$stmt->bindValue(':codate', $codate);
	$stmt->execute();
	include('errordb.php');
	
	
	$stmt = $DBH->prepare("SELECT b.title, b.author, t.due_date FROM book b INNER JOIN transaction t ON b.isbn = t.isbn WHERE b.studentNumber = :userid");
	$stmt->bindValue(':userid', $user_id);
	$stmt->execute();
	include('errordb.php');
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	echo "<a href=confirm.php>Return</a>";
	echo "<table>";
	echo "<tr><th>Title</th><th>Author</th><th>Due date</th></tr>";// include due date
	foreach($rows as $column){
		echo "<tr>";
		echo "<td>";
		echo $column['title'];
		echo "</td>";
		echo "<td>";
		echo $column['author'];
		echo "</td>";
		echo "<td>";
		echo $column['due_date'];
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
}

?>