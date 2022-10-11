<?php
// Script to connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "news-cms";
$conn = mysqli_connect($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
else
{
//   echo "Connected successfully";
}
?>