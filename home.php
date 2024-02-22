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

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
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

        input[type='number'] {
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
            justify-content: center;
            /* Center buttons horizontally */
        }
    </style>
</head>

<body>
    <?php include('session.php'); ?>
    <?php include('includes\database.php'); ?>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div style="background-color: #B3A492;" id="sidebar-wrapper">
            <div
                class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom text-black">
                <?php echo $name?> (<?php echo $acclvl?>)
            </div>
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
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="background-color: #BFB29E;">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-bars dark-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>
            </nav>

            <!-- Create two columns using Bootstrap grid system -->
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Left Column -->
                        <!-- Add your content for the left column here -->
                        <form action="" method="GET" name="search-form">
                            <h3>Search Products</h3>
                            <div class="input-group mb-1">
                                <input type="text" id="search" name="search" required class="form-control"
                                    placeholder="Search product" autofocus>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                        <form id="product-form">
                            <table class="table table-striped table-success table-bordered table-hover" id="mydatatable"
                                style="width: 100%;">
                                <!-- ... (Your product table headers) ... -->
                                <tbody>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Net Weight</th>
                                        <th>Barcode</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    include('includes/database.php');
                                    if (isset($_GET['search'])) {
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT * FROM prod WHERE CONCAT(prod_name,barcode,price,netWt) LIKE '%$filtervalues%' ORDER BY quanity";
                                        $query_run = mysqli_query($con, $query);
                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $row) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $row['prod_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['quanity']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['netWt']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['barcode']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['price']; ?>
                                                    </td>
                                                    <td>
                                                        <a href="insert_selected_product.php?name=<?= $row['prod_name']; ?>&price=<?= $row['price']; ?>&bc=<?= $row['barcode']; ?>&quantity=1"
                                                            class="btn btn-xs btn-warning">Add</a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
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
                    </div>
                    <div class="col-md-6">
                        <form method="post" id="product-form" action="process.php">
                            <div class="input-group mb-3">
                                <input type="text" name="hiddenBarcode" class="form-control" placeholder="Scan Barcode"
                                    autofocus>
                            </div>
                        </form>
                        <!-- Right Column -->
                        <table class="table table-striped table-success table-bordered table-hover" id="mydatatable"
                            style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Sub Total</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query1 = "SELECT * FROM selected_items";
                                $result1 = mysqli_query($con, $query1);
                                $totalCost = 0.00; // Initialize total cost
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . '</td>';
                                    echo '<td>' . htmlspecialchars($row['quantity'], ENT_QUOTES, 'UTF-8') . '</td>';
                                    echo '<td>' . htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') . '</td>';

                                    // Ensure variables are treated as numbers
                                    $qua = (float) $row['quantity']; // Casting to float in case of fractional quantities
                                    $pric = (float) $row['price']; // Casting to float to accommodate decimals in price
                                    $subtotal = $qua * $pric; // Calculate subtotal
                                
                                    $totalCost += $subtotal; // Add subtotal to total cost
                                
                                    echo '<td>' . htmlspecialchars(number_format($subtotal, 2), ENT_QUOTES, 'UTF-8') . '</td>';  // Display formatted subtotal
                                    echo '<td>';
                                    echo '<div class="button-group">';
                                    echo '
<a type="button" class="btn btn-xs btn-warning" onclick="showPasswordPrompt(\'' . $row['id'] . '\')">✎</a>&nbsp;
<a type="button" class="btn btn-xs btn-danger" href="delete_itemcart.php?id=' . urlencode($row['id']) . '">&#x2613;</a>';

                                    echo '</div>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>

                            </tbody>
                        </table>


                        

                        <div class="total">
                        <form method="post" action="save_sales.php">
                        Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;₱<?php echo number_format($totalCost, 2); ?><br>
                            Enter Money: <input type="number" name="money" id="entered-money" width="4px">
                            <br>
                            <span id="difference"></span><br><br>
                            <a type="button" class="btn btn-xs btn-danger" href="delete.php"
                                onclick="return confirmClear()">Clear</a>
                                <button type="submit" class="btn btn-xs btn-success">Next Transaction</button><br><br>
                        </form>
                        </div><br>
                        <center>
                            
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showPasswordPrompt(itemId) {
            var password = prompt("Please enter admin password:");

            if (password != null && password.trim() != "") {
                // Send the password to the server to verify
                // You need to implement server-side password verification

                // For example, you can use AJAX to send the password to the server
                // and based on the response, proceed to edit_quantity.php

                // Here is a simplified example assuming password verification happens on the server side
                fetch('verify_admin_password.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        password: password
                    }),
                })
                    .then(response => {
                        if (response.ok) {
                            // Password is correct, redirect to edit_quantity.php
                            window.location.href = 'edit_quantity.php?id=' + encodeURIComponent(itemId);
                        } else {
                            // Password is incorrect
                            alert('Incorrect admin password.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again later.');
                    });
            }
        }
    </script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

        // Get the elements
        var enteredMoneyInput = document.getElementById("entered-money");
        var differenceSpan = document.getElementById("difference");

        // Add an event listener to the entered money input field
        enteredMoneyInput.addEventListener("input", function () {
            // Get the entered money value
            var enteredMoney = parseFloat(enteredMoneyInput.value);

            // Check if the entered money is a valid number
            if (!isNaN(enteredMoney)) {
                // Calculate the difference
                var difference = enteredMoney - <?php echo $totalCost ?>;

                // Display the difference
                if (difference >= 0) {
                    differenceSpan.textContent = "Change: ㅤㅤㅤ₱" + difference.toFixed(2);
                } else {
                    differenceSpan.textContent = "Invalid: Amount is less than Total Cost";
                }
            } else {
                // If the entered money is not a valid number, display "Invalid Input"
                differenceSpan.textContent = "Invalid Input";
            }
        });
        function confirmClear() {
            // Display a confirmation dialog
            if (confirm("Are you sure you want to clear the selected items?")) {
                // If the user confirms, proceed with the clear action by navigating to "delete.php"
                window.location.href = "delete.php";
            } else {
                // If the user cancels, do nothing
                return false;
            }
        }
    </script>
    <script>
        // Get references to all input fields on the page
        const inputFields = document.querySelectorAll('input[type="text"]');

        // Focus on the last input field
        inputFields[inputFields.length - 1].focus();
    </script>
</body>

</html>