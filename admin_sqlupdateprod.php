<?php
$idp = $_GET["id"];
include('includes/database.php');
                                $bcode = $_POST['barcode'];
                                $quan = $_POST['quantity'];
                                $netWg  = $_POST['netWg'];
                                $srp  = $_POST['price'];
                                $itemName = $_POST['itemname'];
                                $lsv = $_POST['lsv'];
						
								$query = "UPDATE `prod` SET `prod_name`='$itemName',`netWt`='$netWg',`quanity`='$quan',`barcode`='$bcode',`price`='$srp',`lStockV`='$lsv' WHERE prod_id=$idp";
								mysqli_query($con,$query);
                                echo "<script>alert('Item successfully update!'); window.location='admin_home.php'</script>";
				?>