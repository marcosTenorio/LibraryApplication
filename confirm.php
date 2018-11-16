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
<form class='myInput' action="search.php" method="post">
	<input type="text" placeholder="Search for book titles.." name='title' title="Type in a name">
	<input type="submit" class='button' name='search' value= 'Search'/>	
</form>
<form class='form-style' action="check.php" method="post">
	<input type="submit" class='check' name='' value= 'Checked out books'/><br/>
</form>
</body>
<form class='title'>
<h2>Books</h2>
</form>
</html>	
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
		echo "<td>";
		echo "<a href=checkout.php?id=".$row['isbn'].">Checkout</a>";
		echo "</td>";
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
?>

				 