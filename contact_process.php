<?php


if (isset($_POST['submit-form'])) {
    //this stores all the data that has been submitted via the forms from contact.php
    $name = htmlspecialchars($_POST['name']);
    $subject = htmlspecialchars($_POST['subject']);
    $mailFrom =htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mailTo = "harikumar.ramphul@umail.uom.ac.mu";
    $headers = "From: ".$mailFrom;
    $txt = "You have received an email from ".$name.".\n\n".$message;

    mail($mailTo, $subject, $txt, $headers);
        echo "<script>
                alert ('Mail has been sent! :)');
                window.location.href = 'contact.php';
             </script>";

    require_once 'functions.php';  //call a function that performs the server-side validations

    if (emptyForm($name, $mailFrom, $message) !== false) {
        header("Location: contact.php?error=emptyinput");
        exit();
    }

    if (invalidName($name) !== false) {
        header("Location: contact.php?error=invalidname&subject=$subject&email=$mailFrom&msg=$message");
        exit();
    }    
    if (invalidEmail($mailFrom) !== false) {
        header("Location: contact.php?error=invalidemail&name=$name&subject=$subject&msg=$message");
        exit();
    }
            
    
} 

else {
    header("Location: contact.php");
    exit();
}


?>