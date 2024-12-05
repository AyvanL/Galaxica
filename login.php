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

// Get data from AJAX request
$user = $_POST['username'];
$pass = $_POST['password'];

// Prevent SQL injection
$user = $conn->real_escape_string($user);
$pass = $conn->real_escape_string($pass);

// Check if user exists and password is correct
$sql = "SELECT * FROM user WHERE username='$user' AND password='$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // If login is successful, insert the username into the 'logged' table
    $stmt = $conn->prepare("INSERT INTO logged (loggedUsername) VALUES (?)");
    $stmt->bind_param("s", $user);

    if ($stmt->execute()) {
        echo "success"; // Send success response to the AJAX call
    } else {
        echo "error"; // Error during insertion
    }

    $stmt->close();
} else {
    echo "error"; // Login credentials are invalid
}

$conn->close();
?>
