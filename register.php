<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="text/css" rel="stylesheet" href="style.css" media="screen">
	<title>Register</title>
</head>
<body>

	<h1>Register</h1>
		<?php include 'navbar.php'; ?>
		<?php
		if(isset($_POST['new_username'])){
			include 'db_conn.php';
			$sql_query = 'insert into customers (username,first_name,last_name,email,create_date) Values ('.$_POST['username'].','.$_POST['first_name'].','.$_POST['last_name'].','.$_POST['email'].',CURRENT_DATE());';
			echo $sql_query;
			$result = $conn->query($sql_query);
			echo $result;
		}
		?>
	<div id="main">
		<form action='register.php' method='post'>
			<label for='username'>Username</label>
			<input for='username' name = 'new_username' type='text'>
			<label for=first_name'>first name</label>
			<input for='first_name' name = 'first_name' type='text'>
			<label for='last_name'>Last Name</label>
			<input for='last_name' type='text' name='last_name'>
			<label for='email'>Email</label>
			<input for='email' type='text' name='email'>
			<input type='submit' value='register'>
		</form>	
	</div>
	<div id="footer">

	</div>
</body>
</html>