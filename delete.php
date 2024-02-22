<?php
include('includes/database.php');
    $query = "DELETE FROM selected_items";
	mysqli_query($con,$query);
    echo "<script>window.location='home.php'</script>";
		?>