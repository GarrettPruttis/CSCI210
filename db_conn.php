
<?php

$servername = "localhost";
$username = "www-data"; //make sure user exists in database //Might just want to use "root"
$password = "abcde12345"; //mysql;

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>