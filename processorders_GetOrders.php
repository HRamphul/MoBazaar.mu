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

$sql = "SELECT * FROM orders WHERE despatch = 0"; // select statement to retrieve info from the Order table
$Result1 = $conn->query($sql);

// Initialize the response array
$response = array();

while ($order1 = $Result1->fetch(PDO::FETCH_ASSOC)) {
    $response[] = $order1;
}

// Load the JSON schema from the file
$schemaFile = __DIR__ . '/schema/admin_getorders.json';

$schemaData = json_decode(file_get_contents($schemaFile));

// Create a schema instance from the JSON schema
//$schema = new Schema($schemaData); // Uncomment this line

// Create a validator instance
$validator = new Validator();

// Validate the response data against the schema
try {
    $validator->validate($response, $schemaData);
    //echo $response;
    echo json_encode($response,JSON_PRETTY_PRINT);

} catch (\Exception $e) {
    // If validation fails, handle the error here
    $errorResponse = array(
        'error' => 'Invalid data',
        'details' => $e->getMessage(),
    );
    echo json_encode($errorResponse, JSON_PRETTY_PRINT);
   
}

?>
