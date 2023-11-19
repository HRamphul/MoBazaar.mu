<?php
session_start();
$pagename="Logout"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("includes/headfile.php");      //include header
echo"<br>";
echo "<h4> Logout Successful!</h4>"; //display name of the page on the web page
session_destroy();
/*unset($_SESSION['userid']);
unset($_SESSION['usertype']);
unset($_SESSION['fname']);
unset($_SESSION['sname']);*/
?> 

<p style=font-size: 16px; color: #333;>
Home page: <a href=index.php >Home page</a> <br>
About us: <a href = aboutus.php> About Us </a>
</p>


<?php
include("footfile.html"); //include head layout
echo "</body>";
?>