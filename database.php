<?php
$servername = "localhost";
$username = "gmylcsnm_bsit4buser";
$password = "2+_hj@+?DWQ?";
$dbname = "gmylcsnm_bsit4b";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>