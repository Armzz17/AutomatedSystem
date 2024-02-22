<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "inventory");
$transactionId = uniqid();
$money = isset($_POST['money']) ? $_POST['money'] : 0;
// Begin a transaction
mysqli_autocommit($con, false);

// Get the total price of selected items
$totalPriceQuery = "SELECT SUM(price * quantity) AS total_price FROM selected_items";
$totalPriceResult = mysqli_query($con, $totalPriceQuery);
$row = mysqli_fetch_assoc($totalPriceResult);
$totalPrice = $row['total_price'];

// Check if total price exceeds the money provided
if ($totalPrice > $money) {
    echo "<script>alert('Insufficient funds!'); window.location='home.php'</script>";
    exit();
}

// Insert the selected items into the sales table
$query = "INSERT INTO sales (transaction_id, barcode, prod_name, price, quanity, date) 
SELECT '$transactionId', barcode, product_name, price, quantity, NOW() 
FROM selected_items";

// Execute the query
if (mysqli_query($con, $query)) {
    // Update the stock quantity in the prod table
    $updateStockQuery = "UPDATE prod p
                         JOIN selected_items s ON p.barcode = s.barcode
                         SET p.quanity = p.quanity - s.quantity";
    if (mysqli_query($con, $updateStockQuery)) {
        // Clear the selected items after saving
        $clearQuery = "DELETE FROM selected_items";
        if (mysqli_query($con, $clearQuery)) {
            // Commit the transaction
            mysqli_commit($con);
            
            // Generate and show the receipt
            generateReceipt($con, $transactionId, $totalPrice);
        } else {
            // Rollback the transaction if clearing selected_items fails
            mysqli_rollback($con);
            
            // Redirect to home with error message
            header("location:home.php");
            echo "clear_error";
        }
    } else {
        // Rollback the transaction if updating stock quantity fails
        mysqli_rollback($con);
        
        // Redirect to home with error message
        header("location:home.php");
        echo "update_error";
    }
} else {
    // Redirect to home with error message
    header("location:home.php");
    echo "insert_error";
}

// Close the database connection
mysqli_close($con);

// Function to generate the receipt content
function generateReceiptContent($receiptResult, $totalPrice, $transactionId, $cashierName, $num, $money, $change) {
    $receiptContent = '<html><head><title>Receipt</title>';
    $receiptContent .= '
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px auto;
        padding: 10px;
        border: 2px solid #000;
        width: 300px;
    }

    h1 {
        text-align: center;
        font-size: 1.5em;
        margin-top: 10;
        margin-bottom: 0;
    }

    p {
        text-align: center;
        font-size: 14px;
        margin: 0;
    }

    .receipt-item {
        margin-bottom: 10px;
    }

    .receipt-item table {
        width: 100%;
    }

    .receipt-item th,
    .receipt-item td {
        text-align: left;
        padding: 5px;
    }

    .receipt-item th {
        font-weight: bold;
    }

    .total {
        display: flex;
        flex-wrap: wrap;
    }

    .total-item,
    .total-value {
        box-sizing: border-box;
    }

    .total-value {
        width: 30%;
        text-align: right;
    }

    .total-item {
        width: 70%;
        text-align: left;
        padding-left: 93px; /* Adjusted padding value */
    }

    .footer {
        margin-top: 20px;
        text-align: center;
        margin-bottom: 5px;
    }
    </style>';
    $receiptContent .= '</head><body>';
    $receiptContent .= '<h1>Sulit Grocery Store</h1>';
    $receiptContent .= '<p>Cluster 4 Bella Vista</p>';
    $receiptContent .= '<p>Brgy. Santiago Gentrias Cavite</p><hr style="border: none; border-top: 1px solid #000; margin: 20px 0;">';
    $receiptContent .= '<div class="receipt-item">';
    $receiptContent .= '<table>';
    $receiptContent .= '<tr>';
    $receiptContent .= '<th>Quantity</th>';
    $receiptContent .= '<th>Product</th>';
    $receiptContent .= '<th>Price</th>';
    $receiptContent .= '<th>Amount</th>';
    $receiptContent .= '</tr>';
    while ($row = mysqli_fetch_assoc($receiptResult)) {
        $receiptContent .= '<tr>';
        $receiptContent .= '<td>' . $row['quanity'] . '</td>';
        $receiptContent .= '<td>' . $row['prod_name'] . '</td>';
        $receiptContent .= '<td style="text-align: right;">₱' . $row['price'] . '</td>';
        $totalCost = $row['price'] * $row['quanity'];
        $receiptContent .= '<td style="text-align: right;">₱' . $totalCost . '</td>';
        $receiptContent .= '</tr>';
    }
    $receiptContent .= '</table>';
    $receiptContent .= '</div>';
    $receiptContent .= '<div class="total">';
    $receiptContent .= '<div class="total-item"><strong>Total Price:</strong></div><div class="total-value">₱' . $totalPrice . '</div>';
    $receiptContent .= '<div class="total-item"><strong>Total Discount:</strong></div><div class="total-value">₱ 0</div>';
    $receiptContent .= '<div class="total-item"><strong>Cash:</strong></div><div class="total-value">₱' . $money . '<hr style="border: none; border-top: 1px solid #000; margin: 5px 0;"></div>';
    $receiptContent .= '<div class="total-item"><strong>Change:</strong></div><div class="total-value">₱' . $change . '</div>';
    $receiptContent .= '</div><hr style="border: none; border-top: 1px solid #000; margin: 20px 0;">';
    $receiptContent .= '<div class="footer"><strong>Transaction #: </strong>' . $transactionId . '<br>';
    $receiptContent .= '<strong>Date: </strong>' . date("Y-m-d H:i:s") . '<br>';
    $receiptContent .= '<strong>Cashier: </strong>' . $cashierName . ' (' . $num . ')</div>';
    $receiptContent .= '</body>';
    $receiptContent .= '<script>
        // Function to prompt user for printing
        function promptPrint() {
            if (window.confirm(\'Do you want to print the receipt?\')) {
                var printWindow = window.open(\'\', \'_blank\');
                printWindow.document.open();
                printWindow.document.write(document.documentElement.innerHTML);
                printWindow.document.close();
                printWindow.print();
            }
            window.location = \'home.php\';
        }

        // Call the function when the page loads
        promptPrint();
    </script>';
    $receiptContent .= '</html>';
    return $receiptContent;
}

function generateReceipt($con, $transactionId, $totalPrice) {
    $ass = "SELECT * FROM `user` WHERE account_lvl = 'Cashier'";
    $proass = mysqli_query($con, $ass);
    $row = mysqli_fetch_assoc($proass);
    $cashierName = $row['name'];
    $num = $row['user_id'];

    $receiptQuery = "SELECT * FROM sales WHERE transaction_id = '$transactionId'";
    $receiptResult = mysqli_query($con, $receiptQuery);

    $money = isset($_POST['money']) ? $_POST['money'] : 0;

    $change = $money - $totalPrice;
    if ($receiptResult) {
        $receiptContent = generateReceiptContent($receiptResult, $totalPrice, $transactionId, $cashierName, $num, $money, $change);

        echo $receiptContent;
    } else {
        echo "Error fetching receipt data: " . mysqli_error($con);
    }
}
?>
