<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "admin_get_reviews.php",  
        success: function(response) {
            var reviews = JSON.parse(response);
            console.log(reviews.message);
            if (reviews.message === 'success') {
                var tableHtml = "<table>" +
                                "<tr>" +
                                "<th>UserId</th>" +
                                "<th>OrderNo</th>" +
                                "<th>Rating</th>" +
                                "<th>Comment</th>" +
                                "<th>Action</th>" +
                                "</tr>";

                $.each(reviews.data, function(index, review) {
                    tableHtml += "<tr data-review-id='" + review.userId + "'>" +
                                 "<td class='u_id'>" + review.userId + "</td>" +
                                 "<td class='o_id'>" + review.orderNo + "</td>" +
                                 "<td>" + review.rating + "</td>" +
                                 "<td>" + review.comment + "</td>" +
                                 "<td><button class='VerifyorBan'>BAN</button>" +
                                 "<button class='VerifyorBan'>VERIFY</button></td>" +
                                 "</tr>";
                });

                tableHtml += "</table>";

                $("#review_contents").html(tableHtml);
            } else {
                $("#review_contents").html("No reviews");
            }
        }
    });
});

    

    $(document).on("click", "button.VerifyorBan", function() {
        var u_id = $(this).closest("tr").find("td.u_id").text();
        var o_id = $(this).closest("tr").find("td.o_id").text();
        var b = $(this).text();
        
        var reviewRow = $(this).closest("tr"); 
        var reviewId = reviewRow.data("review-id"); 

        $.ajax({
            type: "POST",
            url: "admin_review_process.php",  
            data: {
                action: b,
                userID: u_id,
                orderID: o_id 
            }, 
            success: function(response) {
                console.log(response);
                reviewRow.remove(); // Remove the clicked row from the table
            }
        });
    });

    </script>
</head>
<body>
<?php
session_start();
include("db.php");
$pagename = "admin review";
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>";
echo "<title>" . $pagename . "</title>";
echo "<body>";

include ("includes/headfile.php");      //include header
include("detectlogin.php");
echo "<h4>" . $pagename . "</h4>";

echo "<div id='review_contents'></div>";

include("footfile.html");
echo "</body>";
?>
</html>
