
<?php
include('includes/database.php');
$tbl_name="user";

$username=$_POST['username'];
$password=$_POST['password'];

$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($con,$username);
$password = mysqli_real_escape_string($con,$password);

$result1 = mysqli_query($con,"SELECT * FROM $tbl_name WHERE username='$username' and password='$password'");
$row1 = mysqli_fetch_array($result1);

$sql="SELECT * FROM $tbl_name WHERE username='$username' and password='$password'";
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0){
	$rows = mysqli_fetch_assoc($result);
	if ($rows['account_lvl'] == 'Admin') {
		session_start();
		$_SESSION['id'] = $row1['id'];
		header('location: admin_home.php');
	}
	else if ($rows['account_lvl'] == 'Cashier') {
		session_start();
		$_SESSION['id'] = $row1['id'];
		header('location: home.php');
	}
} else {
	echo "<script>alert('Please check your login credentials!');
		window.location='index.php';
	</script>";
}
 
?>