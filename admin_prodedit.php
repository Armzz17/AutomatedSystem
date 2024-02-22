<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="css/dashstyle.css" />
        <link rel="icon" type="image/png" href="img\logo.png"/>
        <title>Automated Management System</title>
        <style>
        body {
            font-family: Arial, sans-serif;
        }
        </style>
    </head>
    <body>
    <?php include ('session.php');?>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div style="background-color: #B3A492;" id="sidebar-wrapper">
                <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom text-black"><?php echo $name?> (<?php echo $acclvl?>)</div>
                    <div class="list-group list-group-flush my-3">
                        <a href="admin_home.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                        <a href="admin_sales.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fa fa-at me-2"></i>Sales Report</a>
                        <a href="admin_addprod.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-folder me-2"></i>Add Product</a>
                    
                        <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                                class="fas fa-times me-2"></i>Logout</a>
                    </div>
            </div>
            <div id="page-content-wrapper" style="background-color: #BFB29E;">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-bars dark-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Products</h2>
                </div>
            </nav>
            <div class="container-fluid px-4"> <!-- Panel Not Showing: Fix this -->
            <div class="panel panel-success"> <!-- Panel Not Showing: Fix this -->
                <div class="panel-heading text-center" style="margin: 10%;">
                    <div class="input">
                        <h3>Update item</h3>
                        <?php 
                            $idp = $_GET["id"];
                            include('includes/database.php'); 
                            $query=mySQLi_query($con,"SELECT * from prod WHERE prod_id=$idp");
                            $row=mySQLi_fetch_array($query);
                            $prodid = $row['prod_id'];
                            $bcode = $row['barcode'];
                            $quan = $row['quanity'];
                            $netWg  = $row['netWt'];
                            $srp  = $row['price'];
                            $itemName = $row['prod_name'];
                            $lsv = $row['lStockV'];
                        ?>
                    </div>
                    <form method="post" action="admin_sqlupdateprod.php?id=<?php echo $idp?>">
                        <div class="input">
                            <p>Product Name: </p><input class="form-control" value="<?php echo $itemName ?>" name="itemname" required>
                        </div>
                        <div class="input">
                            <p>Price: </p><input class="form-control" value="<?php echo $srp ?>" name="price" required type="number" min="0.01" step="0.01">
                        </div>
                        <div class="input">
                            <p>Quantity: </p><input class="form-control" value="<?php echo $quan ?>" name="quantity" required type="number" min="1">
                        </div>
                        <div class="input">
                            <p>Net Weight: </p><input class="form-control" value="<?php echo $netWg ?>" name="netWg" required>
                        </div>
                        <div class="input">
                            <p>Barcode: </p><input class="form-control" value="<?php echo $bcode ?>" name="barcode" required type="number" min="1">
                        </div>
                        <div class="input">
                            <p>Low Stock Value: </p><input class="form-control" value="<?php echo $lsv ?>" name="lsv" required type="number" min="1">
                        </div>
                        <div class="input">
                            <button type="submit" class="btn btn-xs btn-info">Save Record</button>
                            <button class="btn btn-xs btn-danger"><a href="admin_home.php">Cancel</a></button>
                        </div>
                    </form> 
                </div> 
            </div>
            </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            var el = document.getElementById("wrapper");
            var toggleButton = document.getElementById("menu-toggle");

            toggleButton.onclick = function () {
                el.classList.toggle("toggled");
            };
        </script>
    </body>
</html>
