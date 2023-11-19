<?php
session_start();
$pagename="Login"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<link rel=stylesheet type=text/css href=css/login.css>";
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("includes/headfile.php");      //include header
?>
<br>
<br>



<form action="login_process.php" method="POST" class="login-form">
  <h2>Login</h2>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
  </div>
  <button type="submit">Login</button>
  <button type="reset">Clear Form</button>
</form>


</form>

<br>
<br>


<?php
include("footfile.html"); //include head layout
echo "</body>";
?>