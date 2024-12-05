<?php
// Database connection parameters
$servername = "localhost"; // Replace with your database host
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "galaxica";      // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = array();

try {
    // SQL query to delete all entries in the `logged` table
    $sql = "DELETE FROM logged"; // This deletes all rows from the `logged` table
    $stmt = $conn->prepare($sql);

    // Execute the query
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['message'] = "Failed to execute query.";
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = "Error: " . $e->getMessage();
}

// Close the connection
$conn->close();

// Send JSON response back to the client
header('Content-Type: application/json');
echo json_encode($response);
?>
