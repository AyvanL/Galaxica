<?php
// Assuming you're connected to a MySQL database
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

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to delete the user
    $sql = "DELETE FROM user WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
        header("Location: userAdmin.php"); // Redirect back to the main page after deletion
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
