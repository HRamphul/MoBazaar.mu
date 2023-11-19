<?php
use Opis\JsonSchema\Validator;
use Opis\JsonSchema\Schema;
use Opis\JsonSchema\ValidationResult;

session_start();
include("db.php");
require 'vendor/autoload.php';

$SQL = "SELECT userId, orderNo, rating, comment FROM review WHERE ban = -1";
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$Resultname = $conn->query($SQL);

$dataArray = array();
while ($data = $Resultname->fetch()) {
    $dataArray[] = array(
        'userId' => (int) $data['userId'],
        'orderNo' => (int) $data['orderNo'],
        'rating' => (int) $data['rating'],
        'comment' => $data['comment']
    );
}

$response = array();

if (!empty($dataArray)) {
    $response['message'] = 'success';
    $response['data'] = $dataArray;
} else {
    $response['message'] = 'error';
    $response['data'] = 'no reviews';
}

// Create a schema instance from your JSON schema file
$schemaFile = __DIR__ . '/schema/admin_review.json';

$schemaData = json_decode(file_get_contents($schemaFile));

//$schema = new Schema($schemaData);    there is

// Validate the response data against the schema
$validator = new Validator();

try {
    $validator->validate($response, $schemaData);
} catch (\Exception $e) {
    // If validation fails, you can handle the error here
    $response['message'] = 'error';
    $response['data'] = 'Invalid data';
}

echo json_encode($response);
?>
