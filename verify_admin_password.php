<?php
include('includes/database.php');

// Check connection
include('includes/database.php');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Execute your query to get the admin password from the database
$sql = "SELECT `password` FROM `user` WHERE `account_lvl` = 'Admin'";
$result = mysqli_query($con, $sql);

// Check if the query was successful
if ($result) {
    // Fetch the password from the result
    $row = mysqli_fetch_assoc($result);
    $correctPassword = $row['password']; // Store the correct password from the database
} else {
    // Handle the case where the query failed
    die("Error: " . mysqli_error($con));
}

// Close the database connection
mysqli_close($con);

// Get the password sent from the client-side
$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);

if(isset($data['password']) && !empty($data['password'])) {
    $enteredPassword = $data['password'];
    
    // Verify the password
    if($enteredPassword === $correctPassword) {
        // Password is correct
        http_response_code(200); // OK
    } else {
        // Password is incorrect
        http_response_code(401); // Unauthorized
    }
} else {
    // Password is missing or empty
    http_response_code(400); // Bad request
}
?>
