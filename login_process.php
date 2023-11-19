<?php
session_start();
include("db.php");
$pagename="“Your Login Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("includes/headfile.php");      //include header
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

$email = $_POST['email'];
$enteredPassword = $_POST['password'];


/*PHP validation, checks if the input is empty
Checks if email is in the proper form*/
if(empty($email) || empty($enteredPassword))	
{
	echo "<p><b>Login failed</b></p>";
	echo "<p> Your login form is invalid<br>
			Make sure you provide all the reqired details<p>";
	echo "<p>Go back to <a href='login.php'>login</a></p>";
}
elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
{
	echo	"<p><b>Login failed</b></p>";
	echo	"<p>	The mail entered is invalid<br>
					Make sure you the email is in the form user@example.com
			</p>";
	echo "<p>Go back to <a href='login.php'>login</a></p>";
}
else
{
	//$email = mysqli_real_escape_string($conn,$email);
	//$password = mysqli_real_escape_string($conn,$password);
	$SQL = "select * from `users` where `userEmail`='$email'";
	//$SQL1 = "SELECT * FROM `users` WHERE `userEmail`='sahandilshan@gmail.com'";
	//$result = mysqli_query($conn,$SQL);
	$result = $conn->query($SQL);
	//$data = mysqli_fetch_array($result);
	$data=$result->fetch();
	$storedHashedPassword = $data['userPassword'];
	//secho $storedHashedPassword;
	//if($data['userEmail'] != $email)
	if($data['userEmail'] != $email)
	{
		echo "<p><b>Login failed</b></p>";
		echo "<p> The email you entered was not recognized<p>";
		echo "<p>Go back to <a href='login.php'>login</a></p>";
	}
	else if(password_verify($enteredPassword, $storedHashedPassword))
	{
		$_SESSION['userid'] = $data['userId'];
		 $_SESSION['usertype'] = $data['userType'];
		 $_SESSION['fname'] = $data['userFName'];
		 $_SESSION['sname'] = $data['userSName'];
		echo "<p><b>Login Success</b></p>";
		echo "<p> Hello, ".$data['userFName']." ".$data['userSName']."<p>";
		if($data['userType']=='C')
		{
			echo "<p> You have successfully logged in as a homteq Customer<p>";
			echo "<p>Continue to shopping for <a href='index.php'>Home Tech</a></p>";
			echo "<p>Go back to <a href='basket.php'>Shopping Cart Page</a></p>";
		}
	}
	
	else
	{
		$_SESSION['userid'] = $data['userId'];
		$_SESSION['usertype'] = $data['userType'];
		$_SESSION['fname'] = $data['userFName'];
		$_SESSION['sname'] = $data['userSName'];
	   echo "<p><b>Login Success</b></p>";
	   echo "<p> Hello, ".$data['userFName']." ".$data['userSName']."<p>";
	   if($data['userType']=='C')
	   {
		   echo "<p> You have successfully logged in as a homteq Customer<p>";
		   echo "<p>Continue to shopping for <a href='index.php'>Home Tech</a></p>";
		   echo "<p>Go back to <a href='basket.php'>Shopping Cart Page</a></p>";
	   }
		
	}	
}

include("footfile.html"); //include head layout
echo "</body>";
?>