<?php 
$dbhost = 'localhost'; 
$dbuser = 'root'; 
$dbpass = ''; 
$dbname = 'mobazaar'; 
 
//create a DB connection  
//$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) ; 

//if the DB connection fails, display an error message and exit 
try
{
 $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
}
catch(PDOException $e)
 {
    echo  "<br>" . $e->getMessage();
    die;
 }


?> 