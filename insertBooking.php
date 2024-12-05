<?php
// Database connection
$host = 'localhost'; // Change as needed
$dbname = 'galaxica'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    // Set up the PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get POST data
    $senior = $_POST['senior'];
    $adult = $_POST['adult'];
    $children = $_POST['children'];
    $totalPrice = $_POST['totalPrice'];
    $bookingDate = $_POST['bookingDate'];

    // Fetch the most recently logged username
$loggedQuery = "SELECT loggedUsername FROM logged ORDER BY id DESC LIMIT 1"; // Assuming `id` is an auto-incrementing primary key
$loggedStmt = $pdo->query($loggedQuery);
$loggedUser = $loggedStmt->fetch(PDO::FETCH_ASSOC);

if ($loggedUser && isset($loggedUser['loggedUsername'])) { // Correct the column reference
    $username = $loggedUser['loggedUsername']; // Use the correct column name

    // Prepare SQL query for insertion
    $sql = "INSERT INTO bookings (senior, adult, children, totalPrice, bookingDate, username) 
            VALUES (:senior, :adult, :children, :totalPrice, :bookingDate, :username)";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':senior', $senior);
    $stmt->bindParam(':adult', $adult);
    $stmt->bindParam(':children', $children);
    $stmt->bindParam(':totalPrice', $totalPrice);
    $stmt->bindParam(':bookingDate', $bookingDate);
    $stmt->bindParam(':username', $username); // Bind the loggedUsername
        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "Booking saved successfully.";
        } else {
            echo "Failed to save the booking.";
        }
    } else {
        echo "No logged user found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
