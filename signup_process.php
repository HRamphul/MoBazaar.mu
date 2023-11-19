<?php
session_start();
include("db.php");
$pagename="Your Sign Up Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("includes/headfile.php");      //include header
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

$isEmpty = empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['address']) 
            || empty($_POST['postcode']) || empty($_POST['telNo']) || empty($_POST['email'])
            || empty($_POST['password']) || empty($_POST['conPassword']) ;

// echo "<p>value :=$isEmpty</p>";

if(!$isEmpty) //if no empty fields
{
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $address=$_POST['address'];
    $postcode=$_POST['postcode'];
    $telNo=$_POST['telNo'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $conPassword=$_POST['conPassword'];
    
    // echo "$fname,$lname,$address,$postcode,$telNo,$email,$password"; 
    
    if($password===$conPassword) //confirm password=password
    {
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) //validates the email(checks if it is in the proper form) x@y.com
        { $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            
            $query=     "INSERT INTO `users` (`userFName`,`userSName`, `userAddress`, `userPostcode`, `userTelNo`, `userEmail`, `userPassword`) 
                        VALUES ('$fname','$lname','$address','$postcode','$telNo','$email','$hashedPassword')";
            $Result = $conn->exec($query);
            if($Result)
            {
                echo "<p>Sign-up successful</p>";
                echo "To continue,Please <a href='login.php'>login</a>";
            }
            else
            {
            
                echo "<p><b>Sign-up failed</b></p>";  
                echo "Go back to <a href='signup.php'>Sign up</a> .";
            }
            // $result = mysqli_query($conn, $query) or die (mysqli_error($conn));
            // echo $result;
        }
        else {
            echo "<p><b>Sign-up failed</b></p>";
            echo "<p>Email not valid.<br>
            Make sure you enter a correct email address.</p>
            Go back to <a href='signup.php'>Sign up</a> .";
        }
        
    
    }
    else
    {
        echo "<p><b>Sign-up failed</b></p>";
        echo "<p>The 2 passwords are not matching.<br>
            make sure you entered them correctly.</p>
        Go back to <a href='signup.php'>Sign up</a> .";
    }
    
}
else
{
    echo "<p><b>Sign-up failed</b></p>";
    echo "<p>Your signup form is incomplete and all fields are mandatory<br>
            Make sure you provide all the required details.</p>
        Go back to <a href='signup.php'>Sign up</a> .";
}


include("footfile.html"); //include head layout
echo "</body>";
?>