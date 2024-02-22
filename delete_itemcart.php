<?php
include('includes/database.php');
    $idp = $_GET["id"];
    $query = "DELETE FROM `selected_items` WHERE id = $idp";
	mysqli_query($con,$query);
    echo "<script>window.location='home.php'</script>";
		?>