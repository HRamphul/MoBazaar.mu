<?php
session_start();
include ("db.php"); //include db.php file to connect to DB
$pagename="Mo Bazaar"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";

include ("includes/headfile.php");      //include header
include ("detectlogin.php");
echo "<h4>".$pagename."</h4>";
//create a $SQL variable and populate it with a SQL statement that retrieves product details
$SQL="select proId, prodName, prodPicNameSmall,prodDescripShort,prodPrice from Product where prodQuantity >0";
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
echo "<img src=images/".$data['prodPicNameSmall']." height=200 width=200></a>"; //fetches the image from the 'images' directory
echo "</td>";

echo "<td style='border: 0px'>";
echo "<p><h5>".$data['prodName']."</h5>"; //display product name as contained in the array
echo "<p>".$data['prodDescripShort']."</p>";
echo "<p><b>&pound;".$data['prodPrice']."</b></p>";

echo "</td>";



echo "</tr>";
}
?>
</table>
<html>
<head>
<style>
.myDiv {
  border: 5px ;
  background-color: lightblue;
  text-align: center;
  float : right
  background:blue;
}
</style>
</head>
<body>

<div class=myDiv>
  <h2>This is a heading in a div element</h2>
  <p>This is some text in a div element.</p>
</div>

</body>
</html>
?>
<?php
include ("footfile.html");
echo "</body>";
?>