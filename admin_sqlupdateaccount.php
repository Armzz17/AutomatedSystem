<?php
$idp = $_GET["id"];
include('includes/database.php');

                                $accNum = $_POST['num'];
                                $n = $_POST['name'];
                                $un = $_POST['username'];
                                $pass  = $_POST['password'];
                                $lvl  = $_POST['lvl'];
                                $create = $_POST['date'];
						
								$query = "UPDATE `user` SET `password`='$pass', `user_id`='$accNum', `name`='$n' WHERE id=$idp";
								mysqli_query($con,$query);
                                echo "<script>alert('Account successfully update!'); window.location='admin_home.php'</script>";
				?>