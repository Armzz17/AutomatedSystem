<?php
    $idp = $_GET["id"];
    include('includes/database.php');
    
    $quanti = $_POST['quant'];
    $bar = $_POST['bar'];

    $query2 = "SELECT `quanity` FROM `prod` WHERE barcode = $bar";
    $result = mysqli_query($con, $query2);
    $row = mysqli_fetch_assoc($result);
    $available_quantity = $row['quanity'];

    if ($available_quantity < $quanti) {
        echo "<script>alert('Insufficient quantity!')</script>";
        echo "<script>window.location='home.php'</script>";
    } else {
        $query = "UPDATE `selected_items` SET `quantity`='$quanti' WHERE id='$idp'";
        mysqli_query($con, $query);
        echo "<script>window.location='home.php'</script>";
    }
?>
