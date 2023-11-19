<?php
session_start();
include ("db.php"); //include db.php file to connect to DB
$pagename="Home"; //create and populate variable called $pagename
echo "<title>".$pagename."</title>"; //display name of the page as window title

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<body>";

include ("includes/headfile.php");      //include header

$SQL = "SELECT r.userId, r.orderNo, p.proId, p.prodName, r.rating, r.comment, r.ban
        FROM review r
        LEFT JOIN orders o ON r.orderNo = o.orderNo
        LEFT JOIN order_line ol ON ol.orderNo=o.orderNo
        LEFT JOIN product p ON p.proId = ol.prodId
        ORDER BY r.rating DESC
        LIMIT 3";




$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$Resultname = $conn -> query($SQL);
echo" <div id=x>

                  <div class=btns>
                      <a href=fruit.php><button>Fruit</button></a>
                      <a href=Vegetable.php><button>Vegetable</button></a>

                  </div>";
                  while($data = $Resultname->fetch()){
                    

                      $name="SELECT userFName,userSName FROM users WHERE userId =".$data['userId'];
                      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $y = $conn -> query($name);
                      $x = $y->fetch();
                      echo "<div id=r1>".
                      $x['userFName']. $x['userSName']."   ";
                      for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $data['rating']) {
                            echo '<span class="star-filled">&#9733;</span>'; // display a filled star
                        } else {
                            echo '<span class="star-unfilled">&#9734;</span>'; // display an unfilled star
                        }
                    }
                    
                      echo "<br>".
                      $data['comment']."<br>";
                      echo "<br>".
                      $data['prodName']."<br>";
                  echo"</div>";
                }
               " </div>;
 


            
        
<style>
  #x {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  

  </style>";

	



echo "</div>";
include ("footfile.html");
echo "</body>";
?>