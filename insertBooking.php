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
    $username = $_POST['username'];  // Get the username from the POST data

    // Prepare SQL query
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
    $stmt->bindParam(':username', $username);  // Bind the username

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Booking saved successfully.";
    } else {
        echo "Failed to save the booking.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
