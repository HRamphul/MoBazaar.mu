<?php
session_start();
include("db.php");
include("includes/functions.php"); 
$pagename="Item Details"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo"<link rel=stylesheet href=css/prodbuy.css>";
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("includes/headfile.php");      //include header
    ?>



    <?php
    $prodid=$_GET['u_prod_id'];
    // echo "<p>Selected product Id: ".$prodid;

    $SQL="SELECT proId, prodName, prodPicNameLarge,prodDescripLong,prodPrice,prodQuantity FROM Product WHERE proId=".$prodid;
    //run SQL query for connected DB or exit and display error message
    //$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $Resultname = $conn -> query($SQL);

    echo "<table style='border: 0px'>";
        //create an array of records (2 dimensional variable) called $sss.
        //populate it with the records retrieved by the SQL query previously executed.
        //Iterate through the array i.e while the end of the array has not been reached, run through it
        // while ($data=mysqli_fetch_array($exeSQL))
        // {
        //$data=mysqli_fetch_array($exeSQL);
        $data = $Resultname->fetch(PDO::FETCH_BOTH);
        echo "<tr>";
        echo "<td style='border: 0px'>";
        //display the small image whose name is contained in the array
        echo "<a href=prodbuy.php?u_prod_id=".$data['proId'].">";
        echo "<img src=images/".$data['prodPicNameLarge']." height=600 width=600></a>";
        echo "</td>";
        echo "<td style='border: 0px'>";
        echo "<p><h2>".$data['prodName']."</h2>"; //display product name as contained in the array
        echo "<p>".$data['prodDescripLong']."</p>";
        echo "<p><b>&euro;".$data['prodPrice']."</b></p>";
        echo "<p>Number left in stock :".$data['prodQuantity']."</p>";

        echo "<p>Number to be purchased: ";
        //create form made of one option field and one button for user to enter quantity
        //the value entered in the form will be posted to the basket.php to be processed
        echo "<form action=basket.php method=post>";
        echo "<select name=p_quantity>";
        for($i=1;$i<=$data['prodQuantity'];$i++)
        {
            echo "<option value=$i>$i</option>";
                
        }
        echo "</select>";

        echo "<input type=submit value='ADD TO BASKET'> ";
        echo"<input type=button id='viewReviewsBtn' value='View Reviews'>";
        //pass the product id to the next page basket.php as a hidden value
        echo "<input type=hidden name=h_prodid value=".$prodid.">";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
        // }
    echo "</table>";
    echo "<p id='ratingFilter'  style='display: none'>Filter by Rating:
          <select id='ratingFilter' name='ratingFilter'>
            <option value=''>All Ratings</option>
          </select>
          </p>";
    echo "<div id='reviewTable' style='display:none'> </div>";
    include("footfile.html"); //include head layout
    ?>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
</body>



<script>
$(document).ready(function() {
  var prodId = <?php echo $prodid; ?>; // Retrieve product ID from PHP variable
  $("#viewReviewsBtn").click(function() {
    populateRatingFilter();

    var selectedRating = $("#ratingFilter").val(); // Get the selected rating value
    $("#reviewTable").fadeToggle("slow", function() {
      if ($(this).is(":visible")) {
        $("#ratingFilter").show(); // Show the rating filter dropdown
        $("#viewReviewsBtn").val("Hide Reviews")
        fetchReviews(prodId, selectedRating); // Fetch reviews
      } else {
        $("#ratingFilter").hide(); // Hide the rating filter dropdown
        $("#viewReviewsBtn").val("Show Reviews")

      }
    });
  });

  $("select#ratingFilter").change(function() {
    var selectedRating = $(this).val(); // Get the selected rating value
    //alert(selectedRating);
    $("#reviewTable").fadeOut();
    // $("#ratingFilter").hide(); 
    fetchReviews(prodId, selectedRating); // function call to fetch review
  });
  

  //ajax calls
  function populateRatingFilter() {
        $.ajax({
            url: "includes/get_ratings.php", // Path to the PHP script
            type: "GET",
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    // Handle any errors here
                    alert("Error: " + data.error);
                } else {
                    // Populate the dropdown with rating values
                    var ratingFilter = $("select#ratingFilter");
                    ratingFilter.empty(); // Clear existing options
                    ratingFilter.append($("<option>", {
                        value: "",
                        text: "All Ratings"
                    }));
                    $.each(data, function(index, rating) {
                        ratingFilter.append($("<option>", {
                            value: rating,
                            text: rating + " Stars"
                        }));
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX errors here
                console.error("An error occurred: " + error);
            }
        });
    }

  function fetchReviews(prodId, rating) {
    // Perform the AJAX request to fetch reviews
    $.ajax({
      url: "includes/get_reviews.php", // Path to the PHP file that fetches reviews
      method: "POST",
      data: { prodId: prodId, rating: rating }, // Send product ID and selected rating to the server
      success: function(response) {
        $("#reviewTable").html(response); // Display fetched reviews in the "reviewTable" element
        $("#reviewTable").fadeIn();
      },
      error: function(xhr, status, error) {
        // Display an alert if an error occurs during the AJAX request
        alert("An error occurred: " + error);
      }
    });
  }
});
</script>
