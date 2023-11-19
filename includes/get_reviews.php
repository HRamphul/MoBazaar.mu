<?php
session_start();
require_once "db_connect.php";
$prodId = $_POST['prodId'];
$ratingFilter = $_POST['rating'];

// Fetch reviews for the selected product and rating using SQL query
if ($ratingFilter == '') {
  // Query to fetch all reviews for the selected product
  $SQL = "SELECT DISTINCT r.rating, r.comment, u.userFName, u.userSName
          FROM review r
          INNER JOIN orders o ON r.orderNo = o.orderNo
          INNER JOIN users u ON r.userId = u.userId
          WHERE o.reviewed = 1 AND o.orderNo IN (
              SELECT ol.orderNo FROM order_line ol
              WHERE ol.prodId = :prodId
          )
          ORDER BY r.userId DESC";
} 

else {
  // Query to fetch reviews with the specified rating for the selected product
  $SQL = "SELECT DISTINCT r.rating, r.comment, u.userFName, u.userSName
          FROM review r
          INNER JOIN orders o ON r.orderNo = o.orderNo
          INNER JOIN users u ON r.userId = u.userId
          WHERE o.reviewed = 1 AND r.rating = " . $ratingFilter . " AND o.orderNo IN (
              SELECT ol.orderNo FROM order_line ol
              WHERE ol.prodId = :prodId
          ) 
          ORDER BY r.userId DESC";
}

$stmt = $conn->prepare($SQL);
$stmt->bindParam(":prodId", $prodId, PDO::PARAM_INT);
//if ($ratingFilter !== '') {
//  $stmt->bindParam(":rating", $ratingFilter, PDO::PARAM_INT);
//}
$stmt->execute();

if ($stmt->rowCount() > 0) {
  echo "<table>";
  echo "<tr><th>User</th><th>Rating</th><th>Comment</th></tr>";
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['userFName'] . " " . $row['userSName'] . "</td>";
    echo "<td>" . $row['rating'] . "</td>";
    echo "<td>" . $row['comment'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No reviews available.";
}
?>
