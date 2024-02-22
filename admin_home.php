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
            <div  style="background-color: #B3A492;" id="sidebar-wrapper">
                <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom text-black"><?php echo $name?> (<?php echo $acclvl?>)</div>
                    <div class="list-group list-group-flush my-3">
                        <a href="admin_home.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                                class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                        <a href="admin_sales.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fa fa-at me-2"></i>Sales Report</a>
                        <a href="admin_addprod.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                                class="fas fa-folder me-2"></i>Add Product</a>
               
                        <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                                class="fas fa-times me-2"></i>Logout</a>
                    </div>
            </div>
            <div id="page-content-wrapper"  style="background-color: #BFB29E;">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-bars dark-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>
            </nav>
            <div class="container-fluid px-4"> <!-- Panel Not Showing: Fix this -->
            <div class="panel panel-success"> <!-- Panel Not Showing: Fix this -->
                <div class="panel-heading text-center">
                <form action="" method="GET" name="search-form">
                    <h3>Search Products</h3>
                    <div class="input-group mb-1">
                        <input type="text" id="search" name="search" required class="form-control" placeholder="Search product" autofocus>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                    <form >
                        <table class="table table-striped table-success table-bordered table-hover" id="mydatatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Net Weight (g)</th>
                                    <th>Barcode</th>
                                    <th>Price</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $con = mysqli_connect("localhost","root","","inventory");
                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT * FROM prod WHERE CONCAT(prod_name,barcode,price,netWt) LIKE '%$filtervalues%' ORDER BY quanity";
                                        $query_run = mysqli_query($con, $query);
                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $row['prod_name']; ?></td>
                                                    <td><?= $row['quanity']; ?></td>
                                                    <td><?= $row['netWt']; ?></td> 
                                                    <td><?= $row['barcode']; ?></td>
                                                    <td><?= $row['price']; ?></td>
                                                    <td><a  type="button" class="btn btn-xs btn-warning" href="admin_prodedit.php?id=<?php echo $row['prod_id']; ?>"> EDIT </a> <a  type="button" class="btn btn-xs btn-danger" href="admin_sqldelitem.php?id=<?php echo $row['prod_id']; ?>"> DELETE </a> </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="6">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </form>
                 
                    <h3>Low Stock Products</h3>
                    <form>
                        <table class="table   table-bordered table-hover" id="mydatatable" style="width: 100%;">
                            <thead style="background-color: #D1E7DD">
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Net Weight (g)</th>
                                    <th>Barcode</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody style= "background-color: #FF9B9B;">
                                <?php
                                $query = "SELECT * FROM prod WHERE quanity <= lStockV"; 
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>';
                                        echo '<td>' . $row['prod_name'] . '</td>';
                                        echo '<td>' . $row['quanity'] . '</td>';
                                        echo '<td>' . $row['netWt'] . '</td>';
                                        echo '<td>' . $row['barcode'] . '</td>';
                                        echo '<td>' . $row['price'] . '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr>';
                                    echo '<td colspan="5">No Low Stock Products Found</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                    <h3>List Of Products</h3>
                    <form >
                        <table class="table table-striped table-success table-bordered table-hover" id="mydatatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Net Weight (g)</th>
                                    <th>Barcode</th>
                                    <th>Price</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>   
                            <?php
                            $query = 'SELECT * FROM prod ORDER BY quanity';
                            $result = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_assoc($result)) {             
                                    echo '<tr>';
                                    echo '<td>'. $row['prod_name'].'</td>';
                                    echo '<td>'. $row['quanity'].'</td>';   
                                    echo '<td>'. $row['netWt'].'</td>'; 
                                    echo '<td>'. $row['barcode'].'</td>'; 
                                    echo '<td>'. $row['price'].'</td>';
                                    echo '<td> ';
                                    echo ' <a  type="button" class="btn btn-xs btn-warning" href="admin_prodedit.php?id='.$row['prod_id'] . '"> EDIT </a> <a  type="button" class="btn btn-xs btn-danger" href="admin_sqldelitem.php?id='.$row['prod_id'] . '"> DELETE </a>';
                                    echo '</tr> ';
                                }?>           
                            </tbody>
                        </table>
                    </form>  
                     <h3>List Of Accounts</h3>
                    <form >
                        <table class="table table-striped table-success table-bordered table-hover" id="mydatatable" style="width: 100%;">
                            <thead>
                                <tr><th>Employee Id</th>
                                    <th>Account Name</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Date Create</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>   
                            <?php
$query = 'SELECT * FROM user';
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>'. $row['user_id'].'</td>';
    echo '<td>'. $row['name'].' ('. $row['account_lvl'].')</td>';
    echo '<td>'. $row['username'].'</td>';   
    echo '<td>'. $row['password'].'</td>'; 
    echo '<td>'. $row['date'].'</td>';                       
    echo '<td> ';
    echo ' <a  type="button" class="btn btn-xs btn-warning" href="admin_accountedit.php?id='.$row['id'] . '"> EDIT </a>';
    echo '</tr> ';
}
?>        
                            </tbody>
                        </table>
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
        <script>
    // Function to clear the input field
    function clearInput() {
        document.getElementById("search").value = "";
    }

    // Function to handle barcode scanning (replace this with your actual scanning logic)
    function handleBarcodeScan(barcode) {
        // Assuming you have a function to handle barcode scanning and it returns the scanned barcode
        // Perform any necessary processing here, and then clear the input field
        clearInput();

        // You can also trigger a search with the scanned barcode if needed
        // Example: document.forms["search-form"].submit();
    }
</script>
    </body>
</html>                       