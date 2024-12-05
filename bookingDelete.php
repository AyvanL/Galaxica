<?php
// Assuming you are connected to a MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "galaxica";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete the booking
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $deleteSql = "DELETE FROM bookings WHERE id = $id";
    
    if ($conn->query($deleteSql) === TRUE) {
        header("Location: bookingAdmin.php"); // Redirect to the admin page after successful deletion
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
