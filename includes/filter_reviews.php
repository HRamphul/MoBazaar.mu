<?php
include("db.php"); // Include your database connection

$prodId = $_POST['prodId'];
$selectedRating = $_POST['rating'];

// Prepare the SQL query to filter reviews by rating
$SQL = "SELECT r.rating, r.comment, u.userFName, u.userSName
        FROM review r
        INNER JOIN orders o ON r.orderNo = o.orderNo
        INNER JOIN users u ON r.userId = u.userId
        WHERE o.reviewed = 1 AND o.orderNo IN (
            SELECT ol.orderNo FROM order_line ol
            WHERE ol.prodId = :prodId
        )";

if (!empty($selectedRating)) {
  // If selected rating is not empty, add rating filter
  $SQL .= " AND r.rating = :rating";
}

$stmt = $conn->prepare($SQL);
$stmt->bindParam(":prodId", $prodId, PDO::PARAM_INT);
if (!empty($selectedRating)) {
  $stmt->bindParam(":rating", $selectedRating, PDO::PARAM_INT);
}
$stmt->execute();

if ($stmt->rowCount() > 0) {
  echo "<tr><th>User</th><th>Rating</th><th>Comment</th></tr>";
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['userFName'] . " " . $row['userSName'] . "</td>";
    echo "<td>" . $row['rating'] . "</td>";
    echo "<td>" . $row['comment'] . "</td>";
    echo "</tr>";
  }
} else {
  echo "<tr><td colspan='3'>No reviews available for the selected rating.</td></tr>";
}
?>
