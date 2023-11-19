<?php
$url = 'http://localhost/mobazaar/delivery_getdetails.php';
$json = file_get_contents($url);
$data = json_decode($json, true); // Use true to decode as an associative array
echo($json);

// Check if $data is an array
if (isset($data['message'])) {
    echo "Server error.";
} else {
    // Initialize HTML table
    $tableHtml = "<table>" .
                "<tr>" .
                "<th>User Name</th>" .
                "<th>User TelNo</th>" .
                "<th>User Address</th>" .
                "<th>Order Total</th>" .
                "<th>Items</th>" .
                "</tr>";

    // Loop through the data and add rows to the table
    foreach ($data as $user) {
        echo$user['userFname'] ;
        $tableHtml .= "<tr>" .
        "<td>" . $user['userFname'] . "</td>" .
        "<td>" . $user['userTelNo'] . "</td>" .
        "<td>" . $user['userAddress'] . "</td>" .
        "<td>" . $user['orderTotal'] . "</td>" .
        "<td><table><tr>
            <th>Product</th>
            <th>Quantity</th>
        </tr>";
        foreach ($user['orders'] as $orderNo => $orders) { 
                $tableHtml .= "<tr>" .
                "<td>" . $orders['prodId']. "</td>" .
                "<td>" . $orders['quantityOrdered'] . "</td>" .
                "</tr>";
        }

        $tableHtml .= "</table></td></tr>";
    }

    $tableHtml .= "</table>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>DELIVERY COMPANY</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        table table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <!-- Display the HTML table here -->
    <?php echo $tableHtml; ?>
</body>
</html>
