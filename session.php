<?php
    include('includes/database.php');
    session_start();
    if (!isset($_SESSION['id'])){
        header('location:index.php');
        }
    $id = $_SESSION['id'];

    $query=mysqli_query ($con,"SELECT * FROM user WHERE id ='$id'");
    $row=mysqli_fetch_array($query);
    $name=$row['name'];
    $username=$row['username'];
    $datejoin=$row['date'];
    $acclvl=$row['account_lvl'];
?>