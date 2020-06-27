
<?php 
	include('functions.php');
	$id = $_GET['id'];
	$table = $_GET['table'];
	$link = connect();
	$sql = "DELETE FROM `".$table."` WHERE Id =".$id;
	if(mysqli_query($link,$sql)){

		echo "<script>window.location.href='index.php?page=5';</script>";
	}
	else {
		echo mysqli_errno($link);
		echo mysqli_error($link);
	}

 ?>