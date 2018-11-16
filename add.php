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
if(isset($_POST['title']) and $_POST['author'] and $_POST['isbn']){
    $title = $_POST['title'];
    $author = $_POST['author'];
	$isbn = $_POST['isbn'];
	
    include('db.php');
    
		$stmt = $DBH->prepare("INSERT INTO library.book (title, author, ISBN, studentNumber) VALUES (:title, :author, :isbn, '1111111')");
		
		$stmt->bindValue(':title', $title);
		$stmt->bindValue(':author', $author);
		$stmt->bindValue(':isbn', $isbn);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		 
		$message = '';
		if (!empty($row)){ //is the array empty
			$title = $row['title'];
			$author = $row['author'];
			$isbn = $row['isbn'];
			$_SESSION["title"] = $title;
			$_SESSION["author"] = $author;
			$_SESSION["isbn"] = $isbn;		
		exit();
		} else {
		    $message= 'Please fill all the fields';
		}
		if ($_POST){
			include('errordb.php');
			header('Location: admin.php');	
		}		
}
echo "<a href=admin.php>Return</a>";
?>

<h2>Add book to the library</h2><br></br>

<form class='form-style' action="add.php" method="post">
Title: <input type="text" name="title" required/>
Author: <input type="text" name="author" required/>
ISBN: <input type="text" name="isbn" required minlength='10' maxlength='10'/>

<input type="submit" name="submit" value="Add" class='button'/>
</form>
</body>
</html>
<?php
if(!empty($message)){  echo '<br>';
echo $message;
}
?>
