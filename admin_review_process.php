<?php
session_start();
include ("db.php"); //include db.php file to connect to DB
$pagename="admin review"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";

include ("includes/headfile.php");      //include header
include ("detectlogin.php");
echo "<h4>".$pagename."</h4>";



if (ISSET($_POST['ban_orderid']))
{
    $x=$_POST['ban_orderid'];
    $sql = "UPDATE review
    SET ban = 1 WHERE orderNo = $x";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $Result=$conn->exec($sql);

    if($Result){
        echo "Review banned successfully";               // redirect admin to review page
        header("Location: admin_review.php");
        die();
    }
    else{
        echo "Review could not be banned ";

    }
}
if (ISSET($_POST['verified_orderid']))
{
    $x=$_POST['verified_orderid'];
    $sql = "UPDATE review
    SET ban = 0 WHERE orderNo = $x";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $Result=$conn->exec($sql);

    if($Result){
        echo "Review verified successfully";               // redirect admin to review page
        header("Location: admin_review.php");
        die();
    }
    else{
        echo "Review could not be verified ";

    }
}


include ("footfile.html");
echo "</body>";
?>