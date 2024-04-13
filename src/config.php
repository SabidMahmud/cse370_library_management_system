<?php
// Database configuration
$dbHost = 'localhost'; // or your host name
$dbUsername = 'root'; // your database username
$dbPassword = ''; // your database password
$dbName = 'libraryDB'; // your database name

// Create connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "DB Connected successfully\n";



