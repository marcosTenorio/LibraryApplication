
<?php
	include('db.php');
if($_GET){
	$pid = $_GET['id'];
	
	$stmt = $DBH->prepare("UPDATE book SET studentNumber = 1111111 WHERE isbn = :pid");
	$stmt->bindValue(':pid', $pid);
	$stmt->execute();
	include('errordb.php');

	
	$stmt = $DBH->prepare("DELETE FROM transaction WHERE isbn = :pid");
	$stmt->bindValue(':pid', $pid);
	$stmt->execute();
	include('errordb.php');
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	header('Location:  admincheck.php');
	
}

?>