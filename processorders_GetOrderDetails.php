<?php
// get_order_details.php
use Opis\JsonSchema\Validator;
use Opis\JsonSchema\Schema;
use Opis\JsonSchema\ValidationResult;
// Include necessary files and connect to the database
session_start();
include('db.php');
require 'vendor/autoload.php';

// Check if 'order_id' is sent in the request
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Fetch order details using $order_id
    $sql1 = "SELECT * FROM order_line WHERE orderNo=$order_id";
    $Result1 = $conn->query($sql1);

    // Initialize the response array
    $response = array();

    while ($order1 = $Result1->fetch(PDO::FETCH_ASSOC)) {
        $response[] = $order1;
    }
    
// Load the JSON schema from the file
    $schemaFile = __DIR__ . '/schema/admin_getorderdetails.json';

    $schemaData = json_decode(file_get_contents($schemaFile));


//$schema = new Schema($schemaData); // Uncomment this line

// Create a validator instance
    $validator = new Validator();

// Validate the response data against the schema
    try {
        $validator->validate($response, $schemaData);
   
        echo json_encode($response,JSON_PRETTY_PRINT);

    } catch (\Exception $e) {

        $errorResponse = array(
            'error' => 'Invalid data',
            'details' => $e->getMessage(),
        );
        echo json_encode($errorResponse, JSON_PRETTY_PRINT);
   
    }

}
?>
