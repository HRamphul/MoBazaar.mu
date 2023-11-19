<?php
session_start();
$pagename="Add a New Product"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<link rel=stylesheet href= css/addproduct.css>"; //call the stylesheet for the form
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("includes/headfile.php");      //include header
?>
<br>
<br>
<form action="addprodcut_conf.php" method="POST" class="product-form">
<h2>Add product</h2>
<table style="border:none">
    <tr >
        <td>*Product Name</td>
		<td><input type="text" size="40" name="prodName"></td>
    </tr>
    <tr >
        <td>*Product Type</td>
        <td><select name="prodType" >
            <option value="f">Fruit</option>
            <option value="v">Vegetable</option>
            </select>
        </td>
    </tr>
    
    <tr >
        <td>*Small Picture Name</td>
		<td><input type="text" size="40" name="smallPicName"></td>
    </tr>
	
	<tr >
        <td>*Large Picture Name</td>
		<td><input type="text" size="40" name="largePicName"></td>
    </tr>
	
	<tr >
        <td>*Short Description</td>
		<td><input type="text" size="40" name="shortDesc"></td>
    </tr>
	
	<tr >
        <td>*Long Description</td>
		<td><input type="text" size="40" name="longDesc"></td>
    </tr>
	
	<tr >
        <td>*Price</td>
		<td><input type="text" size="40" name="price"></td>
    </tr>
	
	<tr >
        <td>*Initial Stock Quantity</td>
		<td><input type="text" size="40" name="qty"></td>
    </tr>
    

    <tr>
        <td><input  type="submit" value="Add Product"></td>
       <td><input type="reset" value="Clear Form"></td>
    </tr>
</table>

</form>

<br>
<br>

<?php
include("footfile.html"); //include head layout
echo "</body>";
?>