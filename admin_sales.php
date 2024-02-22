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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            
        }

        .header-container {
            display: flex;
            justify-content: center;
            align-items: center;
           
        }

        .left-header {
            text-align: left;
            
        }

        .right-header1 {
            text-align: right;
            color: green;
            margin-right: 10px;font-weight: bold;
        }

        .right-header1 small {
            font-size: 90%;
            
            /* Adjust the percentage as needed for the desired size */
        }

        .right-header1 .total {
            color: black;
            font-size: 90%;
        }

        .print-icon {
            cursor: pointer;
            color: #007bff;
           
        }
    </style>
</head>

<body>
    <?php include('session.php'); ?>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div style="background-color: #B3A492;" id="sidebar-wrapper">
            <div
                class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom text-black">
                <?php echo $name ?> (<?php echo $acclvl ?>)
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="admin_home.php"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="admin_sales.php"
                    class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fa fa-at me-2"></i>Sales Report</a>
                <a href="admin_addprod.php"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-folder me-2"></i>Add Product</a>

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
                    <button style="background-color: #BFB29E;" class="print-icon-button" onclick="openPrintWindow()">
                        <i class="fas fa-print fs-4">Print</i>
                    </button>

                </div>
            </nav>
            <div class="container-fluid px-4">
                <div class="header-container">
                    
                    <?php
                    include('includes/database.php');
                    
                    if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
                        $start_date = $_GET['start_date'];
                        $end_date = $_GET['end_date'];

                        $sql = "SELECT SUM(price*quanity) AS total_price, SUM(quanity) AS total_quantity FROM sales WHERE date BETWEEN '$start_date' AND '$end_date'";
                    } else {
                        $sql = "SELECT SUM(price*quanity) AS total_price, SUM(quanity) AS total_quantity FROM sales";
                    }

                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);
                    $sT = $row['total_price'];
                    $totalQuantity = $row['total_quantity'];

                    mysqli_close($con);
                    ?>

                    <h4 class="right-header1">
                        <span class="total">Total Quantity:</span>
                        <?php echo $totalQuantity ?>
                    </h4>

                    <h4 class="right-header1"><span class="total">Total Sales:</span> ₱
                        <?php echo $sT ?>
                    </h4>
                </div>
                <br>
                <div class="btn-group" role="group" aria-label="Report Type">
                    <form action="admin_sales.php" method="GET">
                        <label style="font-size: 20px;   font-weight: bold;" for="start-date">Start Date:</label>
                        <input type="date" id="start-date" name="start_date" required
                            value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                        <label style="font-size: 20px;   font-weight: bold;" for="end-date">End Date:</label>
                        <input type="date" id="end-date" name="end_date" required
                            value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                        <button type="submit" class="btn btn-primary">Generate Report</button>
                    </form>
                </div>

                <br><br>
                <canvas id="salesChart" width="400" height="200"></canvas>
                <?php
                include('includes/database.php');
                
                $dates = array();
                $sales = array();
                
                if (isset($_GET['start_date'])) {
                    $start_date = $_GET['start_date'];
                    if (isset($_GET['end_date'])) {
                        $end_date = $_GET['end_date'];
                        $date_condition = "date BETWEEN '$start_date' AND '$end_date'";
                    } else {
                        $current_date = date("Y-m-d");
                        $date_condition = "date BETWEEN '$start_date' AND '$current_date'";
                    }
                } else {
                    $date_condition = "1";
                }

                $sql = "SELECT DATE(date) AS sale_date, SUM(price*quanity) AS total_sales FROM sales WHERE $date_condition GROUP BY sale_date"; // SQL query to fetch daily sales data
                $result = mysqli_query($con, $sql);

                if (!$result) {
                    die("Error: " . mysqli_error($con)); // Add error handling
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    $dates[] = $row['sale_date'];
                    $sales[] = $row['total_sales'];
                }
                mysqli_close($con);
                ?>

                <script>
                    var saleDates = <?php echo json_encode($dates); ?>;
                    var dailySales = <?php echo json_encode($sales); ?>;

                    var ctx = document.getElementById('salesChart').getContext('2d');

                    var salesChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: saleDates,
                            datasets: [
                                {
                                    label: 'All time Sales',
                                    data: dailySales,
                                    borderColor: 'rgb(0, 0, 0)', // Line color (black)
                                    borderWidth: 2, // Line width
                                    fill: true, // Fill the area under the line
                                    backgroundColor: 'rgba(0, 0, 0, 0.2)', // Fill color (gray with some transparency)
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Sales Amount (₱)', // Y-axis label
                                        color: 'black' // Set Y-axis label color to black
                                    },
                                    ticks: {
                                        color: 'black' // Set Y-axis tick labels color to black
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Date', // X-axis label
                                        color: 'black' // Set X-axis label color to black
                                    },
                                    ticks: {
                                        color: 'black' // Set X-axis tick labels color to black
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top' // Legend placement
                                },
                                title: {
                                    display: true,
                                    text: 'Sales Report', // Chart title
                                    color: 'black', // Set chart title color to black
                                    padding: {
                                        top: 10,
                                        bottom: 20
                                    }
                                }
                            }
                        }
                    });
                </script><br>
                <table class="table table-striped table-success table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Product Name</th>
                            <th>Barcode</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Retrieve sales data from your database
                        include('includes/database.php'); // Include your database connection
                        
                        // Check if start_date and end_date parameters are provided
                        if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
                            $start_date = $_GET['start_date'];
                            $end_date = $_GET['end_date'];
                            // Modify the SQL query to include date range filtering
                            $sql = "SELECT * FROM sales WHERE date BETWEEN '$start_date' AND '$end_date'";
                        } else {
                            // If not provided, fetch all sales data
                            $sql = "SELECT * FROM sales";
                        }

                        $result = mysqli_query($con, $sql);

                        $previousTransactionId = null;
                        $transactionTotal = 0;
                        $totalSales = 0; // Initialize the total sales variable
                        
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($previousTransactionId === null) {
                                // First row
                                $previousTransactionId = $row['transaction_id'];
                                $transactionTotal = $row['price'] * $row['quanity'];
                            } elseif ($row['transaction_id'] === $previousTransactionId) {
                                // Rows with the same transaction ID
                                $transactionTotal += $row['price'] * $row['quanity'];
                            } else {
                                // Rows with a different transaction ID
                                echo "<tr>";
                                echo "<td>{$previousTransactionId}</td>";
                                echo "<td></td>"; // Leave this cell empty for grouped rows
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td>₱{$transactionTotal}</td>";
                                echo "<td></td>";
                                echo "</tr>";

                                // Add the transaction total to the total sales
                                $totalSales += $transactionTotal;

                                // Reset variables for the next transaction
                                $previousTransactionId = $row['transaction_id'];
                                $transactionTotal = $row['price'] * $row['quanity'];
                            }

                            // Display individual product rows
                            echo "<tr>";
                            echo "<td></td>"; // Leave this cell empty for individual product rows
                            echo "<td>{$row['prod_name']}</td>";
                            echo "<td>{$row['barcode']}</td>";
                            echo "<td>{$row['price']}</td>";
                            echo "<td>{$row['quanity']}</td>";
                            $subtotal = $row['price'] * $row['quanity'];
                            echo "<td>{$subtotal}</td>";
                            echo "<td>{$row['date']}</td>";
                            echo "</tr>";
                        }

                        // Display the last grouped transaction
                        if ($previousTransactionId !== null) {
                            echo "<tr>";
                            echo "<td>{$previousTransactionId}</td>";
                            echo "<td></td>"; // Leave this cell empty for grouped rows
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td>₱{$transactionTotal}</td>";
                            echo "<td></td>";
                            echo "</tr>";

                            // Add the last transaction total to the total sales
                            $totalSales += $transactionTotal;
                        }

                        // Display the total sales row
                        echo "<tr>";
                        echo "<td colspan='5'></td>";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
<script>
    function openPrintWindow() {
        var start_date = document.getElementById("start-date").value;
        var end_date = document.getElementById("end-date").value;

        var totalQuantity = 0; // Initialize totalQuantity
        var totalSales = 0; // Initialize totalSales

        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print</title>');
        printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<div style="text-align: center;">');
        printWindow.document.write('<h1>Sales Report</h1>');
        printWindow.document.write('<div style="display: inline-block; margin-bottom: 20px;">');
        printWindow.document.write('<p style="display: inline-block; margin-right: 20px;">Total Quantity: ' + totalQuantity + '</p>');
        printWindow.document.write('<p style="display: inline-block;">Total Sales: ₱' + totalSales + '</p>');
        printWindow.document.write('</div><br>');
        var chartCanvas = document.getElementById('salesChart');
        var chartImage = chartCanvas.toDataURL("image/png");
        printWindow.document.write('<img src="' + chartImage + '" style="max-width: 100%;">');

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
        
        printWindow.document.querySelector('p:nth-child(1)').innerText = 'Total Quantity: ' + totalQuantity;
        printWindow.document.querySelector('p:nth-child(2)').innerText = 'Total Sales: ₱' + totalSales;

        printWindow.document.write('</tbody></table>');

        printWindow.document.write('</div>');

        printWindow.document.write('</body></html>');
        printWindow.document.close();

        printWindow.onload = function() {
            printWindow.print();
        };
    }
</script>




</body>

</html>