<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/dashstyle.css">
    <link rel="icon" type="image/png" href="img\logo.png">
    <title>Automated Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .total {
            text-align: right;
            font-weight: bold;
        }
        input[type='number']{
    width: 100px;
} 

        form {
            text-align: center;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            padding: 5px;
            width: 200px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            padding: 5px 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .button-group {
    display: flex;
    justify-content: center; /* Center buttons horizontally */
  }
    </style>
</head>
<body>
<?php include ('session.php');?>
<?php include ('includes\database.php');?>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div style="background-color: #B3A492;" id="sidebar-wrapper">
                <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom text-black"><?php echo $name?> (<?php echo $acclvl?>)</div>
                <div class="list-group list-group-flush my-3">
                <a href="home.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="salesreport.php"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fa fa-at me-2"></i>Sales Report</a>
                <a href="logout.php"
                    class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-times me-2"></i>Logout</a>
            </div>
            </div>
            <div id="page-content-wrapper"  style="background-color: #BFB29E;">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-bars dark-text fs-4 me-3" id="menu-toggle"></i>
                <h2 class="fs-2 m-0">Edit Quantity</h2>
            </div>
        </nav>

        <!-- Create two columns using Bootstrap grid system -->
        <div class="container-fluid px-4">
        <?php
            $idp = $_GET["id"];
            include('includes/database.php'); 
            $query=mySQLi_query($con,"SELECT * from selected_items WHERE id=$idp");
            $row=mySQLi_fetch_array($query);
            $quan = $row['quantity'];
            $bar = $row['barcode'];
            $prodname = $row['product_name'];
        ?>
            <form method="post" action="edit_itemcart.php?id=<?php echo $idp?>"><br><br><br>
                        <center>
                        <div class="input">
                            <h3><?php echo $prodname ?></h3>
                            <input type="hidden" name="bar" value="<?php echo $bar?>">
                            <h3>Enter Quantity: </h3>
                            <input type="text" class="form-control" name="quant" required ><br>
                            <a type="button" class="btn btn-xs btn-danger" href="home.php">Cancel</a>&nbsp;
                            <a  type="button" class="btn btn-xs btn-info" href="edit_itemcart.php?id=<?php echo $idp?>">Enter</a>
                        </div>
                        </center>
            </form>
            <div class="row">
                <div class="col-md-6">
                    <!-- Left Column -->
                    <!-- Add your content for the left column here -->
                </div>
                <div class="col-md-6">
                    <!-- Right Column -->
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    };
</script>
<script>
    const inputFields = document.querySelectorAll('input[type="number"]');
    inputFields[inputFields.length - 1].focus();
</script>
</body>
</html>
