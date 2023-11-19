<?php
session_start();
$pagename="Review "; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<link rel=stylesheet type=text/css href=css/review.css>"; //Call in stylesheet

echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<head>";
echo "<body>";
include ("includes/headfile.php");      //include header
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
?>
<?php
if(!isset($_SESSION['userid']))         //check if user is log in first and re directs if necessary
{
  header("Location: index.php?referer=review");
}

 require_once "db.php";
$query= "SELECT orders.userId,orders.orderDateTime,orders.orderNo
FROM orders
WHERE orders.reviewed = 0 AND orders.userId =".$_SESSION['userid'] ;
$Result = $conn->query($query) ;
$numrows = $Result->rowCount();
if($numrows==0){
	echo "You have no order to be reviewed";
}
else{
	/*
	$_SESSION['orderno'] = $data['userId'];
	$_SESSION['orderdate'] = $data['userId'];
*/


?>

<form action= "review_process.php "method="POST">

order to be reviwed :

<select name="choice" required>
<?php
      	while ($row = $Result->fetch(PDO::FETCH_ASSOC)) {
      	$str = "";
		$str = $str . $row['orderNo']. "|";
      	$str = $str. $row['orderDateTime'];
      	
      	echo "<option value = '$str'>$str</option>";
      	}
      ?>
</select>

<br>

Rating:<br>
<select name="rating" required >
 	 <option value= "" selected >Select a value</option>
	 <option value= "1" >1</option>
	 <option value= "2" >2</option>
	 <option value= "3" >3</option>
	 <option value= "4" >4</option>
	 <option value= "5" >5</option>
</select>
<br/>
<br/>
Comment: <br/>
	<textarea  name="comment" required></textarea><br/><br/>
    <input type="submit" /> 
	<input type="reset"/>

</form>


<?php
}
include("footfile.html"); //include head layout
echo "</body>";
?>