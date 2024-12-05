<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "galaxica";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve the latest logged username (or modify as needed)
$sql = "SELECT loggedUsername FROM logged ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the username
    $row = $result->fetch_assoc();
    echo $row['loggedUsername']; // Output the username
} else {
    echo "No user logged";
}

$conn->close();
?>
