
<?php

	session_start();
	echo '<div id="navbar"> <div> <ol>';
			echo '<li><a href="index.php">Home</a></li>';
			echo '<li><a href="catalog.php">Catalog</a></li>  ';
			echo '<li><a href="register.php">Register</a></li>';

			if(isset($_SESSION['cust_ID'])){
				echo '<li><a href="account.php">Account</a></li>';
			}else{
				echo '<li><a href="login.php">Login</a></li>';
			}
			echo '<li><a href="checkout.php">Checkout</a></li>';
			echo '<li><a href="contact.php">Contact Us</a></li>';
		echo '</ol>';
	echo '</div> </div>';

?>