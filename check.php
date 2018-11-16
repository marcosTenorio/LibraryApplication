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
<form class='myInput' action="search.php" method="post">
	<input type="text" placeholder="Search for book titles.." name='title' title="Type in a name">
	<input type="submit" class='button' name='search' value= 'Search'/>	
</form>

</body>
<form class='title'>
<h2>Your checked out books</h2>
</form>
</html>


<?php
	include('db.php');
	$stmt = $DBH->prepare("SELECT b.title, b.author, t.due_date FROM book b INNER JOIN transaction t ON b.isbn = t.isbn WHERE b.studentNumber = :userid");
	$stmt->bindValue(':userid', $user_id);
	$stmt->execute();
	include('errordb.php');
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<a href=confirm.php>Return</a>";
	echo "<table>";
	echo "<tr><th>Title</th><th>Author</th><th>Due date</th></tr>";
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

?>