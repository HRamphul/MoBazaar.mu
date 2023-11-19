<?php
session_start();
$pagename="Mo Bazaar"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("includes/headfile.php"); 
?>
<!--END OF HEADER FILE-->




<br><br>
<h2 style=text-align:center;>About Us</h2> <!--display name of the page on the web page-->

<!--Text below reference: https://farmbasket.co -->
<p style=text-align:center>
    <img src='images/farm.jpg'  style="float:right; margin-right:10px;"> 
    Mo Bazaar a platform which makes your life easier by bringing at your disposal fruits and vegetables. 
    <br>
    <br>We provide freshly harvested, sustainably grown in our farm located at St Julien D’hotman and from of our Network of Farmers located around the island. Our farm was set up on April 2015 and this marked the start of our journey in setting up a sustainable food system in Mauritius.
    <br>
    <br>Farmbasket provides delivery service of Healthy Fruits and Vegetables to your residence or to designated pick up points depending on your location. Customers are free to customize their Basket.
    <br>
    <br>The online service started in February 2017.  We are continuously improving our service and aiming to satisfy our customers every needs when it comes to healthiest produce. 

</p>
<br><br>
<h2 style=text-align:center> Our Mission</h2>
<p style=text-align:center>Mo Bazaar's mission is to supply the best tasting and finest quality fruits and vegetables for the local community.
<br> 
<br>Through our network of organic farming farmers, we aiming to have a maximum amount of organic produce as possible. 
<br>
<br>Our Network of other not organic farmers uses natural and sustainable farming methods, with minimum use of pesticides and chemical fertilizers.
<br>
<br>

<img src='images/organic.jpg'> 
</p>


<br><Br>
<?php
include("footfile.html"); //include head layout
echo "</body>";
?>