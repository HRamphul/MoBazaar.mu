<?php
include("db_connect.php"); 

try {
    $SQL_ratings = "SELECT DISTINCT rating FROM review ORDER BY rating ASC";
    $ResultRatings = $conn->query($SQL_ratings);

    $ratings = array();

    while ($ratingData = $ResultRatings->fetch(PDO::FETCH_ASSOC)) {
        $ratings[] = $ratingData['rating'];
    }

    echo json_encode($ratings);
} catch (PDOException $e) {
    echo json_encode(array("error" => $e->getMessage()));
}
?>
