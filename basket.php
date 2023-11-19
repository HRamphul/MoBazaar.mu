<?php
session_start();
$pagename="Smart Basket"; 
include("db.php");
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; 
echo "<link rel=stylesheet type=text/css href=css/Mobazaar.css>";
echo "<title>".$pagename."</title>"; 
echo "<body>";
include ("includes/headfile.php");      //include header
echo "<br><br><h2 style=text-align:center>".$pagename."</h2><br>";
if (ISSET($_SESSION['userid'])){


if (ISSET($_POST['rem_prodId']))
{
	$delprodid=$_POST['rem_prodId'];
	// echo $delprodid;
	unset($_SESSION['basket'][$delprodid]);
	echo "1 item removed from the basket";
}


if(ISSET($_POST['h_prodid']))
{
	echo "<p>1 item added to the basket</p>";
	$newprodid=$_POST['h_prodid'];
	$reququantity = $_POST['p_quantity'];
	
	//create a new cell in the basket session array. Index this cell with the new product id.
	//Inside the cell store the required product quantity
	$_SESSION['basket'][$newprodid]=$reququantity;

	
}
else    // if (!(ISSET($_POST['rem_prodId'])))
{
	
		echo "<p>Current basket unchanged</p>";

}


echo "<table style='border: 0px'>";
	echo "<tr>";
	echo "<th>Product Name</td>";
	echo "<th>price</td>";
	echo "<th>Quantity</td>";
	echo "<th>Sub total</td><td>&nbsp;</td></tr>";
	$total=0;

if(ISSET ($_SESSION['basket']))
{
	
	
	foreach ($_SESSION['basket'] as  $key => $value)
	{
		
		$SQL="select proId, prodName, prodPrice from Product where proId=".$key;
		//$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$Resultname = $conn -> query($SQL);
		$data = $Resultname->fetch(PDO::FETCH_BOTH);

		//$data=mysqli_fetch_array($exeSQL);
		echo "<tr>";
		echo "<td>".$data['prodName']."</td>";//display product name as contained in the array
		echo "<td>&pound;".$data['prodPrice']."</td>";
		echo "<td>".$value."</td>";
		echo "<td>&pound;".$value*$data['prodPrice']."</td>";

		//removal of product
		echo "<td>
		<form action=basket.php method=POST>
			<input type=hidden name='rem_prodId' value=$key>
			<input type=submit value='Remove'>
		</form>
		</td>";

		$total = $total+( $value*$data['prodPrice']);
		echo "</tr>";
		
	}
	

		
	}
	
else
{
	echo "Empty basket";
}
echo "<tr>
			<th colspan=3 align='right'>Total</th>
			<th>&pound;$total</th>
			<td>&nbsp;</td>
		</tr>";
echo "</table>";
?>

<p style=text-align:right><a href='clearbasket.php'>CLEAR BASKET</a>

<!--checkout-->
<form action='checkout.php' method='post' style='text-align:center'>
    <!--payment by card-->
    <input type='hidden' name='total' value='<?php echo $total; ?>'>
    <input type='submit' name='submit' value='Payment by card'>

    <!--payment on delivery-->
    <input type='hidden' name='total' value='<?php echo $total; ?>'>
    <input type='submit' name='submit' value='Payment on delivery'>

    <!--payment by bank transfer-->
    <input type='hidden' name='total' value='<?php echo $total; ?>'>
    <input type='submit' name='submit' value='Payment by bank transfer'>
</form>


<p></p>
<p>New MoBazaar customers :<a href='#'>Sign up</a>
<p>Returning MoBazaar customers :<a href='#'>Login</a>



<?php
include("footfile.html"); //include head layout


echo "</body>";
}
else{
	echo"<h4>Log in first! </h4>";
	echo "Old customer? <b><a href='login.php'>Log In</a></B>";
	echo"<p></p>";
	echo "New Customer? <b><a href='sighup.php'>Sign up</a></b>";
	echo"<p></p>";
	echo "Dont want to register? <b><a href='index.php'>Browse As Guest</a></b>";
}

?>

