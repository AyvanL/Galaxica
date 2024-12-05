<?php
// Assuming you're using MySQLi for the database connection
$host = 'localhost'; // Your database host
$user = 'root'; // Your database user
$password = ''; // Your database password
$dbname = 'galaxica'; // Your database name

// Create a connection to the database
$conn = new mysqli($host, $user, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the AJAX request
$username = $_POST['username'];  // Username to fetch the bookings by

// Retrieve all bookings for the username
$query = "SELECT * FROM bookings WHERE username = '$username' ORDER BY id DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Initialize an array to hold all rows
    $rows = [];

    // Fetch all rows and add them to the array
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    // Return the data as JSON
    header('Content-Type: application/json'); // Ensure the response is JSON
    echo json_encode($rows); // Return all rows as JSON to the front-end
} else {
    // Handle no records found
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No bookings found for this username.']);
}

// Close the connection
$conn->close();
?>
