<?php
session_start();
include("db.php");
$pagename="review process"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("includes/headfile.php");      //include header
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

$choice = $_POST['choice'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$uid=$_SESSION['userid'];
$x =explode('|', $choice);

$ordernum=(int) $x[0];






/*PHP validation, checks if the input is empty
Checks if email is in the proper form*/
if(isset($choice) && isset($rating) && isset($comment))	
{
			$query=     "INSERT INTO `review` (`userId`,`orderNo`, `rating`, `comment`, `ban`) 
			VALUES ('$uid','$ordernum','$rating','$comment',-1)";
			$Result = $conn->exec($query);
			if($Result)
            {	$sql = "UPDATE orders 
				SET reviewed = 1 WHERE orderNo = $ordernum ";
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$conn->exec($sql);
                echo" <br>Order Number : $ordernum";
				echo" <br> rating  : $rating";
				echo" <br>comment : $comment ";
				echo "<br>successfully recorded";
            }
            else{
				echo "<p>unsuccessful</p>";
			}
	
}
echo "<br>";
echo "To review <a href='review.php'>review</a>";
echo "<br>";
echo "To shop : <a href='index.php'>products</a>";


include("footfile.html"); //include head layout
echo "</body>";
?>