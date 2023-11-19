<?php
// Include necessary files and connect to the database
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $order_id = $_POST['order_id'];

    $sql = "UPDATE orders SET despatch = 1 WHERE orderNo = :order_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Database update failed"));
    }
}
?>
