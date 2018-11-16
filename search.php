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
<form class='myInput' action="search.php" method="post">
	<input type="text" placeholder="Search for book titles.." name='title' title="Type in a name">
	<input type="submit" class='button' name='search' value= 'Search'/>	
</form>


</body>
<form class='title'>
<h2>Books</h2>
</form>
</html>	
<?php
$title = "";


	include('db.php');
    $title = $_POST['title'];
	// select the correct table
	$stmt = $DBH->prepare("SELECT * FROM book WHERE title like '%".$title."%'");
	$stmt->bindParam(1, $title);
	$stmt->execute();
	include('errordb.php');
	// get the rows and put it in a variable
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<a href=confirm.php>Return</a>";
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
		echo "</tr>";
	}
	echo "</table>";
?>

