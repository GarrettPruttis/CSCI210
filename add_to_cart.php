




<?php
session_start();

// This is for a cart using a session variablel. Don't do this
//if(!(isset($_SESSION['cart']))){
//	$_SESSION['cart'] = [];
//}


include 'db_conn.php';

//Query and execution to see which order we are on. Need to increment the order number by one to create a new cart
$sql_query = "SELECT COUNT(*) FROM cows.carts";
//echo $sql_query;
$result = $conn->query($sql_query);
$row = $result->fetch_assoc();
$ORDER_NUM = intval($row["COUNT(*)"]) + 1;

//This is our SQL and query for entering the product into our cart stored in the Database
$PROD_ID = $_POST['product_ID'];
$CUST_ID = $_SESSION['cust_ID'];
$QUANTITY = $_POST['quantity'];

$sql_query = "INSERT INTO cows.carts (order_num, product_ID, Cust_ID, Quantity) Values ($ORDER_NUM, $PROD_ID, $CUST_ID, $QUANTITY)";
$result = $conn->query($sql_query);

$conn->close();

header('location:catalog.php');


//'SELECT product_ID, image_link, product_name, quantity, price FROM cows.products WHERE product_ID='.$_GET['id'];
//$new_entry = ["cust"=>$_POST['cust'],"product_id"=> $_POST['product_ID'],"price"=>$_POST['price'],"quantity"=>$_POST['quantity'],"name"=>$_POST['product_name']];
//array_push($_SESSION['cart'],$new_entry);

?>
