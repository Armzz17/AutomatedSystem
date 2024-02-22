<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="css/dashstyle.css" />
    <link rel="icon" type="image/png" href="img\logo.png" />
    <title>Automated Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .left-header {
            text-align: left;
        }

        .right-header1 {
            text-align: right;
            color: green;
        }

        .right-header1 small {
            font-size: 80%;
            /* Adjust the percentage as needed for the desired size */
        }

        .right-header1 .total {
            color: black;
            font-size: 80%;
          

        }
    </style>
</head>

<body>
    <?php include('session.php'); ?>
    <?php
    include('includes/database.php'); // Include your database connection
    
    // Initialize $sT variable
    if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];

        // Modify the SQL query to include date range filtering and calculate the total quantity sold
        $sql = "SELECT SUM(price*quanity) AS total_price, SUM(quanity) AS total_quantity FROM sales WHERE date BETWEEN '$start_date' AND '$end_date'";
    } else {
        // If not provided, fetch the total sales for all transactions and calculate the total quantity sold
        $sql = "SELECT SUM(price*quanity) AS total_price, SUM(quanity) AS total_quantity FROM sales";
    }

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $sT = $row['total_price'];
    ?>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div style="background-color: #B3A492;" id="sidebar-wrapper">
            <div
                class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom text-black">
                <?php echo $name ?> (<?php echo $acclvl ?>)
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="home.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="salesreport.php"
                    class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fa fa-at me-2"></i>Sales Report</a>
                <a href="logout.php"
                    class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-times me-2"></i>Logout</a>
            </div>
        </div>
        <div id="page-content-wrapper" style="background-color: #BFB29E;">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="container-fluid d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-bars dark-text fs-4 me-3" id="menu-toggle"></i>
                        <h2 class="fs-2 m-0">Sales Report</h2>
                    </div>
                    <button style="background-color: #BFB29E;"class=" print-icon-button" onclick="openPrintWindow()">
                        <i  class="fas fa-print fs-5 ">Print</i>
                    </button>

                </div>
            </nav>

            <div class="container-fluid px-4">
                <div class="header-container">
                    
                    <div class="btn-group" role="group" aria-label="Report Type">
                        <form action="salesreport.php" method="GET">
                            <label style="font-size: 20px;   font-weight: bold;" for="start-date">Start Date:</label>
                            <input type="date" id="start-date" name="start_date" required
                                value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                            <label style="font-size: 20px;   font-weight: bold;" for="end-date">End Date:</label>
                            <input type="date" id="end-date" name="end_date" required
                                value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                            <button type="submit" class="btn btn-primary">Generate Report</button>
                        </form>
                    </div>
                    <h4 class="right-header1"><span class="total">Total Sales:</span> ₱
                        <?php echo $sT ?>
                    </h4>
                </div>
                <table class="table table-striped table-success table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Retrieve daily sales data from your database
                        include('includes/database.php'); // Include your database connection
                        
                        if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
                            $start_date = $_GET['start_date'];
                            $end_date = $_GET['end_date'];
                            // Modify the SQL query to include date range filtering
                            $sql = "SELECT * FROM sales WHERE date BETWEEN '$start_date' AND '$end_date'";
                        } else {
                            // If not provided, fetch all sales data
                            $sql = "SELECT * FROM sales ORDER BY sale_id Desc";
                        }
                        $result = mysqli_query($con, $sql);

                        if (!$result) {
                            die("Error: " . mysqli_error($con)); // Add error handling
                        }

                        $totalSales = 0; // Initialize the total sales variable
                        $previousTransactionId = null; // Initialize previous transaction ID
                        
                        while ($row = mysqli_fetch_assoc($result)) {
                            // If transaction ID changes, print the subtotal for the previous group
                            if ($previousTransactionId !== $row['transaction_id']) {
                                if ($previousTransactionId !== null) {
                                    echo "<tr>";
                                    echo "<td>{$previousTransactionId}</td>";
                                    echo "<td></td>"; // Leave this cell empty for grouped rows
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td>₱{$transactionTotal}</td>";
                                    echo "<td></td>";
                                    echo "</tr>";
                                }

                                // Reset the transaction total for the new group
                                $transactionTotal = 0;

                                // Update the previous transaction ID
                                $previousTransactionId = $row['transaction_id'];
                            }

                            // Display individual sales rows
                            echo "<tr>";
                            echo "<td>{$row['transaction_id']}</td>";
                            echo "<td>{$row['prod_name']}</td>";
                            echo "<td>₱{$row['price']}</td>";
                            echo "<td>{$row['quanity']}</td>";
                            $subtotal = $row['price'] * $row['quanity'];
                            echo "<td>₱{$subtotal}</td>";
                            echo "<td>{$row['date']}</td>";
                            echo "</tr>";

                            // Add the current subtotal to the transaction total
                            $transactionTotal += $subtotal;

                            // Add the current subtotal to the total sales
                            $totalSales += $subtotal;
                        }

                        // Display the total sales row for the last group
                        if ($previousTransactionId !== null) {
                            echo "<tr>";
                            echo "<td>{$previousTransactionId}</td>";
                            echo "<td></td>"; // Leave this cell empty for grouped rows
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td>₱{$transactionTotal}</td>";
                            echo "<td></td>";
                            echo "</tr>";
                        }

                        // Display the total sales row
                        echo "<tr>";
                        echo "<td colspan='4'></td>";
                        echo "<td>Total Sales</td>";
                        echo "<td>₱{$totalSales}</td>";
                        echo "</tr>";

                        // Close the database connection
                        mysqli_close($con);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function openPrintWindow() {
        var start_date = document.getElementById("start-date").value;
        var end_date = document.getElementById("end-date").value;

        // Open a new window and write the HTML content
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Report</title>');
        printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<div style="text-align: center;">');
        printWindow.document.write('<h1>Sales Report</h1>');
        
        // Include the PHP-generated table HTML content
        printWindow.document.write('<table class="table table-striped table-success table-bordered table-hover">');
        printWindow.document.write('<thead><tr>');
        printWindow.document.write('<th>Transaction ID</th>');
        printWindow.document.write('<th>Product Name</th>');
        printWindow.document.write('<th>Price</th>');
        printWindow.document.write('<th>Quantity</th>');
        printWindow.document.write('<th>Subtotal</th>');
        printWindow.document.write('<th>Date</th>');
        printWindow.document.write('</tr></thead>');
        printWindow.document.write('<tbody>');

        // Fetch the table data for the selected date range from PHP
        var salesData = <?php
            include('includes/database.php');
            if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
                $start_date = $_GET['start_date'];
                $end_date = $_GET['end_date'];
                $sql = "SELECT * FROM sales WHERE date BETWEEN '$start_date' AND '$end_date'";
            } else {
                $sql = "SELECT * FROM sales ORDER BY sale_id DESC";
            }
            $result = mysqli_query($con, $sql);
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            echo json_encode($data);
        ?>;

        var totalQuantity = 0;
        var totalSales = 0;

        // Iterate over the sales data and generate table rows
        salesData.forEach(function(row) {
            printWindow.document.write('<tr>');
            printWindow.document.write('<td>' + row.transaction_id + '</td>');
            printWindow.document.write('<td>' + row.prod_name + '</td>');
            printWindow.document.write('<td>₱' + row.price + '</td>');
            printWindow.document.write('<td>' + row.quanity + '</td>');
            var subtotal = row.price * row.quanity;
            totalQuantity += parseInt(row.quanity);
            totalSales += subtotal;
            printWindow.document.write('<td>₱' + subtotal + '</td>');
            printWindow.document.write('<td>' + row.date + '</td>');
            printWindow.document.write('</tr>');
        });

        printWindow.document.write('</tbody></table>');

        // Print total quantity and total sales
        printWindow.document.write('<div style="display: inline-block; margin-top: 20px;">');
        printWindow.document.write('<p style="display: inline-block; margin-right: 20px;">Total Quantity: ' + totalQuantity + '</p>');
        printWindow.document.write('<p style="display: inline-block;">Total Sales: ₱' + totalSales + '</p>');
        printWindow.document.write('</div>');

        // Close the div for center alignment
        printWindow.document.write('</div>');

        // Close the HTML content and print the window
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>




</body>

</html>