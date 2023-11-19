<?php

session_start();
$pagename="Contact us"; //Create and populate a variable called $pagename

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<link rel=stylesheet type=text/css href=css/contact.css>"; //Call in stylesheet


echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("includes/headfile.php");      //include header

//-----END OF TEMPLATE------
?>

        <!--Start of contact--> 


<section id="contact-form-details">
    <form action="contact_process.php" method="POST">
        <h2>Stay in touch! Contact us</h2>
        <?php
            $errors = array();
            
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "invalidname") {
                    array_push($errors, "Invalid Name!");
                }
                else if ($_GET["error"] == "invalidemail") {
                    array_push($errors, "Invalid Email!");
                }
                
            }
                if(count($errors) > 0){
                foreach ($errors as $error) {
                echo "<li>".$error."</li>";
                }
            }
            
            if (isset($_GET['name'])) {
                $name = $_GET['name'];
                echo '<input type="text" name="name" placeholder="Name" value="'.$name.'"><br>'; 
                
            }
            else {
                echo '<input type="text" name="name" placeholder="Name"> <br>'; 
            }

            if (isset($_GET['email'])) {
                $mailFrom = $_GET['email'];
                echo '<input type="text" name="email" placeholder="Your e-mail" value="'.$mailFrom.'"><br>';
            }
            else {
                echo '<input type="text" name="email" placeholder="Your e-mail"> <br>';
            }

            if (isset($_GET['subject'])) {
                $subject = $_GET['subject'];
                echo '<input type="text" name="subject" placeholder="Subject" value="'.$subject.'"> <br>'; 
            }
            else {
                echo '<input type="text" name="subject" placeholder="Subject"> <br>'; 
            }
    
            if (isset($_GET['msg'])) {
                $message = $_GET['msg'];
                echo '<textarea name="message" id="" cols="30" rows="10" placeholder="Message" value="'.$message.'"></textarea>';
                
            }
            else {
                echo '<textarea name="message" id="" cols="30" rows="10" placeholder="Message"></textarea><br>';
                
            }
        ?>            
        
        <button class="normal" name="submit-form" method='POST'>Send</button>

    </form>

    <div class="contact">
        <h1>MoBazaar.mu</h1>
        <p><span> Fresh Fruits&Vegetables </span><br> AVN CAMP TIOUREL,<br> REDUIT, MAURITIUS <br><br> +230 57654321 <br> <a href="" >contact@MoBazaar.mu</a></p>    
    </div>
</section>


<?php 
include("footfile.html"); //include head layout
echo "</body>";
?>