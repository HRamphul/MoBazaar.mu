<?php
use Opis\JsonSchema\Validator;
use Opis\JsonSchema\Schema;
use Opis\JsonSchema\ValidationResult;
session_start();
include("db.php");
require 'vendor/autoload.php';

// Fetch user information and orders
$today = date("Y-m-d"); // Get today's date in the format yyyy-mm-dd

$SQL = "SELECT u.userId, u.userFname, u.userTelNo, u.userAddress, o.orderNo, o.orderTotal
        FROM users u
        JOIN orders o ON u.userId = o.userId
        WHERE DATE(o.orderDateTime) = '$today' AND o.despatch = 1";

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$Resultname = $conn->query($SQL);

$userArray = array();

while ($data = $Resultname->fetch(PDO::FETCH_ASSOC)) {
    $userFname = $data['userFname'];
    $userTelNo = $data['userTelNo'];
    $userAddress = $data['userAddress'];
    $orderNo = $data['orderNo'];
    $orderTotal = $data['orderTotal'];

    // Create an empty array to hold order details
    $orderDetails = array();

    // Retrieve order details from the order_line table
    $orderDetailsSQL = "SELECT prodId, quantityOrdered FROM order_line WHERE orderNo = $orderNo";
    $orderDetailsResult = $conn->query($orderDetailsSQL);

    while ($orderData = $orderDetailsResult->fetch(PDO::FETCH_ASSOC)) {
        $prodId = $orderData['prodId'];
        $quantityOrdered = $orderData['quantityOrdered'];

        // Add order details to the array
        $orderDetails[] = array(
            'prodId' => $prodId,
            'quantityOrdered' => $quantityOrdered
        );
    }

    // Create the user entry in the array
    $userArray[] = array(
        'userFname' => $userFname,
        'userTelNo' => $userTelNo,
        'userAddress' => $userAddress,
        'orderTotal' => $orderTotal, // Corrected assignment
        'orders' => $orderDetails
    );
}
$schemaFile = __DIR__ . '/schema/delivery_B2B.json';

$schemaData = json_decode(file_get_contents($schemaFile));

//$schema = new Schema($schemaData);    there is

// Validate the response data against the schema
$validator = new Validator();

try {
    $validator->validate($userArray, $schemaData);
} catch (\Exception $e) {
    // If validation fails, you can handle the error here
    $response['message'] = 'error';
    $response['error'] = 'Invalid data';
}


// Output the result as JSON
header('Content-Type: application/json'); 
echo json_encode($userArray);
?>
