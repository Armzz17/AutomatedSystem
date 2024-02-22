<?php
include('includes/database.php');
					    $itemname = $_POST['itemname'];
						$price = $_POST['price'];
						$quan = $_POST['quantity'];
						$netWg = $_POST['netWg'];
						$bcode = $_POST['barcode'];
						$lSv = $_POST['stock'];
						
								$query = "INSERT INTO `prod`(`prod_id`, `prod_name`, `netWt`, `quanity`, `barcode`, `date`, `price`, `lStockV`) 
                                VALUES ('NULL','$itemname','$netWg','$quan','$bcode',NOW(),'$price', $lSv)";
								mysqli_query($con,$query);
                                echo "<script>alert('Item successfully added!'); window.location='admin_addprod.php'</script>";
				?>