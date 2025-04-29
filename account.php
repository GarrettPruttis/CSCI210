<!DOCTYPE html>
<html lang="en-us">
<head >
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="text/css" rel="stylesheet" href="style.css" media="screen">
	<title>Account</title>
</head>
<body>

	<h1>Manage Your Account</h1>
	<?php
	include 'navbar.php';
	//echo $_SESSION['cust_ID'];
	if(isset($_POST['username']) || isset($_SESSION['cust_ID'])){
		include 'db_conn.php';
		if (isset( $_POST['username'])){
			$sql_query = 'SELECT cust_ID,username,first_name,last_name,email,create_date FROM cows.customers WHERE username='.'"'.$_POST['username'].'"';
			echo $sql_query;
		}else{
			$sql_query = 'SELECT cust_ID,username,first_name,last_name,email,create_date FROM cows.customers WHERE cust_ID='.'"'.$_SESSION['cust_ID'].'"';
		}		
		//echo $sql_query;
		$result = $conn->query($sql_query);
		if ($result->num_rows == 0) {
			header('location:login.php');
		}
		$row = $result->fetch_assoc();
		$_SESSION['cust_ID'] = $row['cust_ID'];

	}else{
		header('location:login.php');
	}
	if(isset($_GET['logout'])){
		if($_GET['logout'] === 'true'){
			unset($_SESSION['cust_ID']);	
			header('location:login.php');
		}
	}
	?>
	
	
		<div id="main">
		<h2>Welcome <?php echo $row['first_name'].' '.$row['last_name'];?></h2>
		<h3><?php echo $row['username'].'  '.$row['email'];?></h3>
		<h3>Loyal Customer since: <?php echo $row['create_date'];?></h3>
		<?php echo '<form action="account.php" method="get"><input for="logout" name="logout" value="true" hidden><input type="submit" value="Logout">';?>

	
	</div>
	<div id="footer">

	</div>
</body>
</html>