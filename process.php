<?php
    if (isset($_POST['hiddenBarcode'])) {
        $bc = $_POST['hiddenBarcode'];
        $quan1 = 1;
    
    // Establish a database connection (Update these settings with your actual database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inventory";

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM prod WHERE barcode = '$bc'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $bcode = $row['barcode'];
        $quan = $row['quanity'];
        $srp = $row['price'];
        $itemName = $row['prod_name'];

        $sql = "INSERT INTO selected_items (product_name, barcode, quantity, price)
                VALUES ('$itemName', '$bcode', $quan1, $srp)
                ON DUPLICATE KEY UPDATE quantity = quantity + $quan1";

        if (mysqli_query($conn, $sql)) {
            // Redirect back to the main page
            header("Location: home.php");
            exit; // Ensure no further code execution
        } else {
            die("Error: " . mysqli_error($conn));
        }
    } else {
        header("Location: home.php");
    }

    mysqli_close($conn);
} else {
    echo "Scanned barcode not received.";
}
?>