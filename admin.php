<?php
session_start();
include('header.php'); 

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
    <style>
	.error {display: block;color: #FF0000; }
	</style>
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
<h2>Books</h2>
</form>
	
<?php
	// create the connection
	include('db.php');
	// select the correct table
	$stmt = $DBH->prepare("SELECT isbn, title, author FROM book WHERE studentNumber = 1111111");
	$stmt->execute();
	include('errordb.php');
	// get the rows and put it in a variable
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<table>";
	echo "<tr><th>ISBN</th><th>Title</th><th>Author</th></tr>";
	foreach($rows as $row){
		echo "<tr>";
		echo "<td>";
		echo $row['isbn'];
		echo "</td>";
		echo "<td>";
		echo $row['title'];
		echo "</td>";
		echo "<td>";
		echo $row['author'];
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
?>
<form class='form-style' action="add.php" method="post">
	<input type="submit" class='add' name='submit' value= 'Add book'/><br/>
</form>
<form class='form-style' action="admincheck.php" method="post">
	<input type="submit" class='checka' name='submit' value= 'checked out books'/><br/>
</form>
</html>