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
	}
?>

<form class='form-style' action="logout.php" method="post">
	<input type="submit" class='logout' name='submit' value= 'Logout'/><br/>
</form>


</body>
<form class='title'>
<h2>Checked out books</h2>
</form>
</html>


<?php
	include('db.php');
	$stmt = $DBH->prepare("SELECT b.isbn, b.title, b.author, t.studentNumber, t.due_date FROM transaction t INNER JOIN book b ON t.isbn = b.isbn WHERE b.studentNumber != 1111111");
	$stmt->execute();
	include('errordb.php');
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<a href=admin.php>Return</a>";
	echo "<table>";
	echo "<tr><th>ISBN</th><th>Title</th><th>Author</th><th>Student Number</th><th>Due date</th></tr>";
	foreach($rows as $column){
		echo "<tr>";
		echo "<td>";
		echo $column['isbn'];
		echo "</td>";
		echo "<td>";
		echo $column['title'];
		echo "</td>";
		echo "<td>";
		echo $column['author'];
		echo "</td>";
		echo "<td>";
		echo $column['studentNumber'];
		echo "</td>";
		echo "<td>";
		echo $column['due_date'];
		echo "</td>";
		echo "<td>";
		echo "<a href=checkin.php?id=".$column['isbn'].">check back in</a>";
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";


?>