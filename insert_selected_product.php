<?php
// Get the product name and quantity from the client-side request
if (isset($_GET['name']) && isset($_GET['quantity']) && isset($_GET['bc'])) {
    $productName = $_GET['name'];
    $bc = $_GET['bc'];
    $quantity = $_GET['quantity'];
    $price = $_GET['price'];

    // Establish a database connection (Update these settings with your actual database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inventory";

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check the database connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Define the SQL query to insert or update the selected product
    $sql = "INSERT INTO selected_items (product_name, barcode, quantity, price)
            VALUES ('$productName', '$bc', $quantity, $price)
            ON DUPLICATE KEY UPDATE quantity = quantity + $quantity";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        header("location:home.php");
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
