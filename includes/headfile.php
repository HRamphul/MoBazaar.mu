

<!--HTML document to define the layout of the header and the navigation bar-->
<html>
	<link rel=" website icon" type ="jpeg" href= "images/icon.jpg"> <!--an icon for the website-->

	<div id="container">
		<div id="header">
			<a href="index.php"><img src="images/mobazaar.jpg" width="200px"></a>
			<h2>Your Bazaar, at your place</h2>
			<h3>
			<?php
			
			date_default_timezone_set('Asia/Dubai'); //displaying +4 GMT
			echo "Mauritius, ".date('d F Y H:i:s');
			?> </h3>
		</div>
	<div id="navigation">
	<ul>
				<?php
				function isPageActive($pageName, $activePage)
				{
					if ($pageName === $activePage) {
						echo 'class="active"';
					}
				}

				if (ISSET($_SESSION['userid'])) {
					if ($_SESSION['usertype'] == 'C') {
						$activePage = $pagename ?? ''; // Set the active page from the $pagename variable
						?>
						<li><a href='index.php' <?php isPageActive('Home', $activePage); ?>>Home</a></li>
						<li><a href='fruit.php' <?php isPageActive('Fruit', $activePage); ?>>Fruit</a></li>
						<li><a href='vegetable.php' <?php isPageActive('Vegetable', $activePage); ?>>Vegetable</a></li>
						<li><a href='aboutus.php' <?php isPageActive('About Us', $activePage); ?>>About Us</a></li>
						<li><a href='Review.php' <?php isPageActive('Review', $activePage); ?>>Review</a></li>
						<li><a href='contact.php' <?php isPageActive('Contact', $activePage); ?>>Contact us</a></li>
						<li style='float: right'><a href='logout.php'>Logout</a></li>
						<li style='float: right'><a href='Basket.php'>Basket</a></li>
						<?php
					} else if ($_SESSION['usertype'] == 'A') {
						$activePage = $pagename ?? ''; // Set the active page from the $pagename variable
						?>
						<li><a href='addproduct.php' <?php isPageActive('addproduct.php', $activePage); ?>>Add Product</a></li>
						<li><a href='editproduct.php' <?php isPageActive('editproduct.php', $activePage); ?>>Edit Product</a></li>
						<li><a href='processorders.php' <?php isPageActive('processorders.php', $activePage); ?>>Process Orders</a></li>
						<li><a href='admin_review.php' <?php isPageActive('admin_review.php', $activePage); ?>>Admin Review</a></li>
						<li style='float: right'><a href='logout.php'>Staff Logout</a></li>
						<?php
					}
				} else {
					$activePage = $pagename ?? ''; // Set the active page from the $pagename variable
					?>
					<li><a href='index.php' <?php isPageActive('Home', $activePage); ?>>Home</a></li>
					<li><a href='fruit.php' <?php isPageActive('Fruit', $activePage); ?>>Fruit</a></li>
					<li><a href='vegetable.php' <?php isPageActive('Vegetable', $activePage); ?>>Vegetable</a></li>
					<li><a href='aboutus.php' <?php isPageActive('Mo Bazaar', $activePage); ?>>About Us</a></li>
					<li style='float: right'><a href='login.php' <?php isPageActive('Login', $activePage); ?>>Login</a></li>
					<li style='float: right'><a href='signup.php' <?php isPageActive('Sign Up', $activePage); ?>>Sign Up</a></li>

					<?php
				}
				?>
			</ul>
	</div>
</html>