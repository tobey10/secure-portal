<?php

$host = "localhost";
$username = "root";
$dbpassword = "root";

$db_name = "secure-portal";
$conn = mysqli_connect($host, $username, $dbpassword, $db_name);

if ($conn->connect_error) {
	die("connection failed " . $conn->connect_error);
}