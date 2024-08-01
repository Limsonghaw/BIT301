<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "bit301";

$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) {
	echo "Connection failed!";
	exit();
}