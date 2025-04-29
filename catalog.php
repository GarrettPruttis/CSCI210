
<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="text/css" rel="stylesheet" href="style.css" media="screen">

	<title>Cattle Catalog</title>
</head>
<body>
<h1>Cattle Catalog</h1>
<?php include 'navbar.php'; ?>
	<div id="main">
		<!-- Search Bar-->
		<div id='search'>
			<form action='catalog.php' method='get'>
				<input type='text' name='search' placeholder='search'></input>
				<input type='submit' value='search'></input>
			</form>

		</div>

		
		<div class="container">
		<?php 
			include 'db_conn.php';

			if(isset($_GET['search'])){
				//Load search Results //You can use WHERE or LIKE clauses in your sql query
				$sql_query = "SELECT product_ID, image_link, product_name, quantity FROM cows.products WHERE product_name=".'"'.$_GET['search'].'"';
				//echo $sql_query;
			}else{
				//Load Everything
				$sql_query = "SELECT product_ID, image_link, product_name, quantity FROM cows.products";
			}
			$result = $conn->query($sql_query);
			//var_dump($result);

			if ($result->num_rows > 0) {
  				while($row = $result->fetch_assoc()) {
					//var_dump($row);
					
					//explode is like python string.split() //seperates string on '.' for accessing thumbnails later on.
					$image_file_name = explode('.',$row['image_link']);
					
					
					echo '<div class="catalog">';
					//anchor tag allows us to click on our products as a link to 'product.php' & get request with '?'
					echo '<a href="product.php?id='.$row['product_ID'].'">';
					//display thumbnail image.Only do this if you have thumbnails - include regular image tag and file path otherwise
					echo '<img src="Images/'.$image_file_name[0].'_thumbnail.'.$image_file_name[1].'" alt="No images available"></img>';
					//display information about our product
					echo '<h2>'.$row['product_name'].' <br> quantity available:'.$row['quantity'].'</h2>';
					
    				echo '</a>';
					echo '</div>';
  				}
			} else {
  				echo "0 results";
			}
			$conn->close();	
		
		
		?>

		</div>

	</div>
</body>
</html>