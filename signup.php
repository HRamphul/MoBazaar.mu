<?php
session_start();
$pagename="Sign Up"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo"<link rel= stylesheet href=css/signup.css>";
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("includes/headfile.php");      //include header
echo "<br><Br> 
        <h2 style=text-align:center>".$pagename."</h2>"; //display name of the page on the web page
?>
<!--END OF HEADER-->


<!--The form uses the POST method to submit the data to a PHP script called "signup_process.php" for processing.-->
<form action="signup_process.php" method="POST">  
<table style="border:none">
    <tr >
        <td style="border:none;">*First Name</td>
        <td style="border:none;"><input type="text" name="fname">
    </tr>
    <tr >
        <td style="border:none;">*Last Name</td>
        <td style="border:none;"><input type="text" name="lname">
    </tr>
    <tr >
        <td style="border:none;">*Address</td>
        <td style="border:none;"><input type="text" name="address">
    </tr>
    <tr >
        <td style="border:none;">*Postcode</td>
        <td style="border:none;"><input type="text" name="postcode">
    </tr>
    <tr >
        <td style="border:none;">*Tel No</td>
        <td style="border:none;"><input type="text" name="telNo">
    </tr>
    <tr >
        <td style="border:none;">*Email Address</td>
        <td style="border:none;"><input type="text" name="email">
    </tr>
    <tr >
        <td style="border:none;">*Password</td>
        <td style="border:none;"><input type="password" name="password">
    </tr>
    <tr >
        <td style="border:none;">*Confirm Password</td>
        <td style="border:none;"><input type="password" name="conPassword">
    </tr>

    <tr>
        <td style="border:none;"><input  type="submit" value="Sign Up"></td>
        <td style="border:none;"><input type="reset" value="Clear Form"></td>
    </tr>
</table>

    

</form>


<?php



include("footfile.html"); //include head layout
echo "</body>";
?>