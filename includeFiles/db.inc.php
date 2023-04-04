<?php

// MySQL server hostname
$host = "localhost";

// MySQL username (default is root)
$username = "root";

// MySQL password - Leaving as default (empty)
$password = "";

// MySQL database name
$dbname = "clotheswap_db";

// Creating connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Checking connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
