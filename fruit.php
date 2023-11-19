<?php
session_start();
include ("db.php"); //include db.php file to connect to DB
$pagename="Fruit"; //create and populate variable called $pagename
echo "<link rel=stylesheet href=css/image.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("includes/headfile.php");      //include header
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";

include ("detectlogin.php");
echo "<h2 style=text-align:center>".$pagename."</h2>";
echo"<br>";
//create a $SQL variable and populate it with a SQL statement that retrieves product details
$SQL="SELECT proId, prodName, prodPicNameSmall,prodDescripShort,prodPrice from Product Where prodType='f' AND ProdQuantity >0 ";
//run SQL query for connected DB or exit and display error message
//$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$Resultname = $conn -> query($SQL);
echo "<table style='border: 0px'>";



//create a 2D array called $arrayp
//populate it with the records retrieved by the SQL query previously executed.
//Iterate through the array i.e while the end of the array has not been reached, run through it

while($data = $Resultname->fetch())
{
echo "<tr>";
echo "<td style='border: 0px'>";
//display the small image whose name is contained in the array
echo "<a href=prodbuy.php?u_prod_id=".$data['proId'].">";
echo "<img src=images/".$data['prodPicNameSmall']." height=400 width=400></a>"; //fetches the image from the 'images' directory
echo "</td>";

echo "<td style='border: 0px'>";
echo "<p><h3>".$data['prodName']."</h3>"; //display product name as contained in the array
echo "<p>".$data['prodDescripShort']."</p>";
echo "<p><b>&pound;".$data['prodPrice']."</b></p>";
echo "</td>";



echo "</tr>";

}
echo "</table>";
// echo "<a href=aboutus.php?test='test'>";
include ("footfile.html");
echo "</body>";
?>