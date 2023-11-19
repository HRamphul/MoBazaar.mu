<?php
session_start();
include("db.php"); // include the database connection file
$pagename = "Product Added";
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("includes/headfile.php");      //include header
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

// retrieve the form data using POST method

// retrieve the form data using POST method
$prodName = $_POST['prodName'];
$prodType = $_POST['prodType'];
$smallPicName = $_POST['smallPicName'];
$largePicName = $_POST['largePicName'];
$shortDesc = $_POST['shortDesc'];
$longDesc = $_POST['longDesc'];
$price = $_POST['price'];
$qty = $_POST['qty'];

// prepare the SQL query to insert the form data into the database
$insert_sql = "INSERT INTO Product (prodName, prodPicNameSmall, prodPicNameLarge, prodDescripShort, prodDescripLong, prodPrice, prodQuantity,prodType)
               VALUES (:prodName, :smallPicName, :largePicName, :shortDesc, :longDesc, :price, :qty,:ptype)";

// prepare the statement
$insert_query = $conn->prepare($insert_sql);


/* bind the parameters - bindParam is an inbuilt function used to bind data to the database. 
Bind variables are the best way to prevent SQL injection.*/

$insert_query->bindParam(':prodName', $prodName);
$insert_query->bindParam(':smallPicName', $smallPicName);
$insert_query->bindParam(':largePicName', $largePicName);
$insert_query->bindParam(':shortDesc', $shortDesc);
$insert_query->bindParam(':longDesc', $longDesc);
$insert_query->bindParam(':price', $price);
$insert_query->bindParam(':qty', $qty);
$insert_query->bindParam(':ptype', $prodType);


// execute the statement
if ($insert_query->execute()) {
    echo "Product added successfully!";
} else {
    echo "Error: " . $insert_sql . "<br>" . $conn->errorInfo()[2];
}


// close the database connection
$conn = null;
include("footfile.html"); //include head layout
echo "</body>";
?>