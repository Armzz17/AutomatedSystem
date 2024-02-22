<?php
include('includes/database.php');
$get_id =$_GET['id'];
	mysqli_query($con,"DELETE FROM user WHERE id = '$get_id'");
	header("Location: admin_home.php");

?>