
<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="text/css" rel="stylesheet" href="style.css" media="screen">

	<title>Cattle Catalog</title>
</head>
<body>
<h1>Checkout</h1>
<?php include 'navbar.php';  include 'db_conn.php';?>
	<div id="main">
		<div class="noncontainer">
		<?php 
			// Check to see if the buy button is pressed
			if(isset($_GET['buy']) && $_GET['buy'] === 'true'){

				//Query and execution to see which order we are on. Need to increment the order number by one to create a new cart
				$sql_query = "SELECT COUNT(*) FROM cows.orders";
				//echo $sql_query;
				$result = $conn->query($sql_query);
				$row = $result->fetch_assoc();
				//intval is str -> int typecast
				$ORDER_NUM = intval($row["COUNT(*)"]);
				
				//Grab the cusotmers current cart
				$sql_query = 'SELECT * FROM cows.carts WHERE cows.carts.cust_ID ='.'"' . $_SESSION['cust_ID'] . '"';
				$result = $conn->query($sql_query);	

				//Puts the cart into the  orders table
				//Begins a SQL transaction. essentially if something fails, all of the entries will be rolled back
				$conn->begin_transaction();

				
				//Populates an arrray full of values that we will use to insert into orders
				$values=[];
				while ($row = $result->fetch_assoc()) {

						//This is our SQL and query for entering the product into our cart stored in the Database
						$ORDER_NUM += 1;
						$PROD_ID = $row['product_ID'];
						$CUST_ID = $row['cust_ID'];
						$QUANTITY = $row['Quantity'];
						
						// .= is str concatination. Addes a row to our query
						$values[] = "($ORDER_NUM, $PROD_ID, $CUST_ID, $QUANTITY)";
				}
				if (!empty($values)) {
					try {
						
						$sql_query = "INSERT INTO cows.orders (order_num, product_ID, Cust_ID, Quantity) Values ". implode(", ", $values);
						echo $sql_query;
						$result = $conn->query($sql_query);	
						$conn->commit();

						//Clear the cart
						$sql_query = "DELETE FROM cows.carts WHERE ".'"' . $_SESSION['cust_ID'] . '"';
						$result = $conn->query($sql_query);
						echo '<br>Order Successfully Purchased';
					} catch (mysqli_sql_exception $exception){
						//roll back the order table to the beggining of our transaction
						$conn->rollback();
						throw $exception;
					} 
				}else{
					echo "Your Cart is Empty";
				}

			
				
			}
			// checks to see if the clear button is pressed & Clears the cart
			if(isset($_GET['clear']) && $_GET['clear'] === 'true'){
				$sql_query = "DELETE FROM cows.carts WHERE ".'"' . $_SESSION['cust_ID'] . '"';
				$result = $conn->query($sql_query);

			}
			
				
				$sql_query = 'SELECT cust_ID,username,first_name,last_name,email,create_date FROM cows.customers WHERE cust_ID='.'"'.$_SESSION['cust_ID'].'"';
				$result = $conn->query($sql_query);
				if ($result->num_rows == 0) {
					header('location:login.php');
				}
				$cust = $result->fetch_assoc();


				//Sql Statement. Note the dual left joins
				$sql_query = 'SELECT cows.products.product_ID, cows.products.image_link, cows.products.product_name, cows.products.price, cows.carts.quantity FROM cows.products LEFT JOIN cows.carts ON cows.carts.product_ID = cows.products.product_ID LEFT JOIN cows.customers ON cows.carts.cust_ID = cows.customers.cust_ID WHERE cows.customers.cust_ID ='.'"' . $_SESSION['cust_ID'] . '"';
				if(isset($_GET['view']) && $_GET['view'] === 'true'){
					//Non functional WIP
					'SELECT * FROM cows.orders WHERE cows.orders.cust_ID ='.'"' . $_SESSION['cust_ID'] . '"';
				}
				//echo $sql_query;
				
				$result = $conn->query($sql_query);
				//var_dump($result);
				
				// this creates our table that our products are listed in
				echo '<table>';
				echo '<tr><th>Montana Tech Livestock Auction</th><th>customer:'.$cust['first_name'].' '.$cust['last_name'].'</th></tr>';
				echo '<tr> <th>Product ID</th><th>Name</th><th></th><th>Quantity</th><th>Price Each</th><th>Total Price</th></tr>';
				$Total_price = 0;
				
				while ($row = $result->fetch_assoc()) {

					echo '<tr>';
					echo '<td>'.$row['product_ID'].'</td>';
					echo '<td>'.$row['product_name'].'</td><td></td>';
					echo '<td>'.$row['quantity'].'</td>';
					echo '<td>'.$row['price'].'</td>';
					$price = $row['quantity'] * $row['price'];
					$Total_price = $Total_price + $price;
					echo '<td>'.$price.'</td>';
					
    					echo '</tr>';
  				}
				echo '<tr><td>Totals<td><td></td><td></td><td></td><td>'.$Total_price.' </td></tr>';
				
				echo '<tr><td></td><td></td><td></td>';
				
				echo"<td><form action='checkout.php'><input type='text' for='clear' name='view' value='true' hidden></input><input type='submit' method='get' value='view all orders'></input></form></td>";
				echo "<td><form action='checkout.php'><input type='text' for='clear' name='clear' value='true' hidden></input><input type='submit' method='get' value='clear'></input></form></td>";
		
				echo "<td><form action='checkout.php'><input type='text' for='buy' name='buy' value='true' hidden></input><input type='submit' method='get' value='buy'></input></form></td>";
				echo '</tr></table>';

			//} else {
  			//	echo "Your Cart is Empty";
			//}
				

			

			
			$conn->close();
		?>

		</div>

	</div>
</body>
</html>