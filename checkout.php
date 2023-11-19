<?php
session_start();
$pagename = "Checkout";
include("db.php");
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>";
echo "<title>" . $pagename . "</title>";
echo "<body>";
include ("includes/headfile.php");      //include header
echo "<h3 style='text-align:center'>" . $pagename . "</h3>";

if (isset($_POST['submit'])) {
    $userID = $_SESSION['userid'];
    $total = $_POST['total'];

    // Create new order record in database
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO Orders (userId, orderDateTime, orderTotal) VALUES (:userId, NOW(), :orderTotal)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userId', $userID);
        $stmt->bindParam(':orderTotal', $total);
        $stmt->execute();
        $orderId = $conn->lastInsertId();

        // Insert each product in basket into OrderItems table
        foreach ($_SESSION['basket'] as $key => $value) {
            $subtotal = $value * getPriceForProductId($conn, $key);

            $sql = "INSERT INTO `order_line` (`orderNo`, `prodId`, `quantityOrdered`, `subTotal`) 
                    VALUES (:orderId, :prodId, :quantityOrdered, :subtotal)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':orderId', $orderId);
            $stmt->bindParam(':prodId', $key);
            $stmt->bindParam(':quantityOrdered', $value);
            $stmt->bindParam(':subtotal', $subtotal);

            $stmt->execute();

            $update = "UPDATE product SET prodQuantity = prodQuantity - $value WHERE proId =$key ";
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec($update);
        }

        // Clear the basket
//        unset($_SESSION['basket']);

        // Display the receipt
        echo "<div class='receipt'>";
        echo "<h2>Order Confirmation</h2>";
        echo "<p>Order Number: " . $orderId . "</p>";
        echo "<p>Date: " . date("Y-m-d H:i:s") . "</p>";
        echo "<h3>Order Details:</h3>";

        // Loop through the items in the order
        echo "<ul style = 'list-style-type: none';>";
        foreach ($_SESSION['basket'] as $key => $value) {
            $product = getProductById($conn, $key);
            $subtotal = $value * $product['prodPrice'];
            echo "<li>";
            echo "<span>" . $product['prodName'] . "</span> </br>";
            echo "<span>Quantity: " . $value . "</span> </br>";
            echo "<span>Subtotal: &pound;" . number_format($subtotal, 2) . "</span></br>";
            echo "</li>";
        }
        echo "</ul>";

        echo "<h3>Total Amount: &pound;" . number_format($total, 2) . "</h3>";
        echo "<p>Thank you for purchasing at MoBazaar.mu</p>";
        echo "</div>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    unset($_SESSION['basket']); //ends the session

    $conn = null;
}

function getPriceForProductId($conn, $prodId)
{
    $sql = "SELECT prodPrice FROM Product WHERE proId = :prodId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':prodId', $prodId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['prodPrice'];
}

function getProductById($conn, $prodId)
{
    $sql = "SELECT * FROM Product WHERE proId = :prodId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':prodId', $prodId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
