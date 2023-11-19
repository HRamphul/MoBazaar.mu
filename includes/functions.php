<?php


function populateRatingFilter() { //populate the rating filter dropdown in prodbuy.php

    include("db.php"); // Include your database connection file

    try {
        $SQL_ratings = "SELECT DISTINCT rating FROM review";
        $ResultRatings = $conn->query($SQL_ratings);

        $ratings = array();

        while ($ratingData = $ResultRatings->fetch(PDO::FETCH_ASSOC)) {
            $ratings[] = $ratingData['rating'];
        }

        echo json_encode($ratings);
    } catch (PDOException $e) {
        echo json_encode(array("error" => $e->getMessage()));
    }
}

?>
