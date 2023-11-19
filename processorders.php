<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadOrders() {
                $.ajax({
                    type: "POST",
                    url: "processorders_GetOrders.php",  
                    success: function(response) {
                        var orders = JSON.parse(response);
                        var tableHtml = "<table>" +
                                        "<tr>" +
                                        "<th>OrderId</th>" +
                                        "<th>UserID</th>" +
                                        "<th>OrderDate</th>" +
                                        "<th>Total</th>" +
                                        "<th>Details</th>" +
                                        "</tr>";

                        $.each(orders, function(index, order) {
                            tableHtml += "<tr>" +
                                         "<td class='o_id'>" + order.orderNo + "</td>" +
                                         "<td>" + order.userId + "</td>" +
                                         "<td>" + order.orderDateTime + "</td>" +
                                         "<td>" + order.orderTotal + "</td>" +
                                         "<td><button class='getdetails'>GET DETAILS</button></td>" +
                                         "</tr>";
                        });

                        tableHtml += "</table>";

                        $(".orders_div").html(tableHtml);
                    }
                });
            }

            loadOrders(); // Load orders initially

            $(document).on("click", "button.getdetails", function() {
                var o_id = $(this).closest("tr").find("td.o_id").text();

                $.ajax({
                    type: "POST",
                    url: "processorders_GetOrderDetails.php",  
                    data: { order_id: o_id },     
                    success: function(response) {
                        var jsonResponse = JSON.parse(response);

                        var table = "<table class='second_table'>";
                        table += "<tr><th>Order No</th><th>Product ID</th><th>Quantity Ordered</th><th>Subtotal</th></tr>";

                        jsonResponse.forEach(function(item) {
                            table += "<tr>" +
                                "<td id='id2'>" + item.orderNo + "</td>" +
                                "<td>" + item.prodId + "</td>" +
                                "<td>" + item.quantityOrdered + "</td>" +
                                "<td>" + item.subTotal + "</td>" +
                                "</tr>";
                        });

                        var divContent = table + "</table><button id='despatch' style='float: right;'>DESPATCH</button>";
                        $(".orderdetails").html(divContent).show();
                    }
                });
            });

            $(document).on("click", "button#despatch", function() {
                var o_id2 = $(".second_table").find("#id2").text();
                
                $.ajax({
                    type: "POST",
                    url: "despatch.php",  
                    data: { order_id: o_id2 },   
                    dataType: "json", 
                    success: function(response) {
                        if (response.status === "success") {
                            console.log("Update successful");
                            // Remove the dispatched order from the table
                            $("td.o_id:contains(" + o_id2 + ")").closest("tr").remove();
                            $(".orderdetails").hide();
                        } else {
                            console.log("Update failed: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Update error: " + error);
                    }
                });
            });
        });
    </script>
</head>
<body>
<?php

include('db.php');
$pagename = "Order Lists"; 
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>"; 
echo "<title>" . $pagename . "</title>";
echo "<body>";
include ("includes/headfile.php");      //include header
echo "<h4>" . $pagename . "</h4>"; 

echo "<body>";
echo "<div class='orderdetails' style='display: none; background-color: lightgray; float: right; width: 300px; padding: 10px; border: 1px solid #ccc; margin-right: 20px;'></div>";
echo "<div class='orders_div'></div>";

echo "</body>";
include("footfile.html"); 
echo "</body>";
?>
</html>
