<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="text/css" rel="stylesheet" href="style.css" media="screen">
	<title>Product</title>
</head>
<body>
	

	
	
	<h1>Product</h1>
	<?php include 'navbar.php'; ?>
	<?php
	if(!(isset($_SESSION['cust_ID']))){
		header('location:login.php');
	}

	include 'db_conn.php';
	$sql_query = 'SELECT product_ID, image_link, product_name, quantity, price FROM cows.products WHERE product_ID='.$_GET['id'];
	$result = $conn->query($sql_query);
	
	$conn->close();
	$row = $result->fetch_assoc();
	//echo $row['product_name'];
	//echo $row['image_link'];
	//echo $row['price'];
	?>
	<div id="main">
		<!--Image. Make sure that this is suited to your environment (image file path and name are going to be unique to you)-->
		<?php echo '<img src="Images/'.$row['image_link'].'" alt="No images available"></img>'; ?>
		<!--Create our form -->
		<form action="add_to_cart.php" method='post'>
		<!--Product name label and input field -->	
		<label for="product">Product Name</label>
		<input type='text' name='product_name'value="<?php echo $row['product_name']; ?>"> </input><br>

		<!--Quanitity label and input field -->
		<label for='quantity'>Quantity - <?php echo $row['quantity']; ?> available </label>
		<input type='text' name='quantity' for='quantity' value='1'></input><br>

		<!--Price label and input field -->
		<label for='price'>Price - $<?php echo $row['price']; ?> </label>
		<input type='text' name='price' for='price' value='<?php echo $row['price']; ?>'></input><br>

		<!--Custormer and product data. Note the 'hidden' tag makes it invisible to our user, but gets past to our POST	request. -->
		<input type='text' name='cust' for='cust' value='<?php echo $_SESSION['cust_ID']; ?>' hidden></input>
		<input type='text' name='product_ID' for='product_ID' value='<?php echo $row['product_ID']; ?>' hidden></input>

		<!-- Submit button-->
		<input type="submit" value="Add to Cart"></submit>
		
		</form>
		
	</div>

	<div id="footer">

	</div>
</body>
</html>