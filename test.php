<!DOCTYPE html>
<html>

<head>
    <title>Receipt</title>
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
            font-size: 14;
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
    </style>
</head>

<body>
    <h1>Sulit Grocery Store</h1>
    <p>Cluster 4 Bella Vista</p>
    <p>Brgy. Santiago Gentrias Cavite</p>
    <hr style="border: none; border-top: 1px solid #000; margin: 20px 0;">
    <div class="receipt-item">
        <table>
            <tr>
                <th>Quantity</th>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Amount</th>
            </tr>
            <!-- PHP Loop Removed -->
        </table>
    </div>
    <div class="total">
        <div class="total-item"><strong>Total Price:</strong></div>
        <div class="total-value">₱[totalPrice]</div>
        <div class="total-item"><strong>Total Discount:</strong></div>
        <div class="total-value">₱ 0</div>
        <div class="total-item"><strong>Cash:</strong></div>
        <div class="total-value">₱[money]</div>
        <div class="total-item"><strong>Change:</strong></div>
        <div class="total-value">₱[change]</div>
    </div>
    <hr style="border: none; border-top: 1px solid #000; margin: 20px 0;">
    <div class="footer"><strong>Transaction #: </strong>[transactionId]<br>
        <strong>Date: </strong>[date]<br>
        <strong>Cashier: </strong>[cashierName] ([num])
    </div>
</body>

</html>
