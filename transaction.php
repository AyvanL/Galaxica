<?php
// Database connection (replace with your credentials)
$host = 'localhost'; 
$dbname = 'galaxica';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch the latest entry in the table
    $stmt = $pdo->query('SELECT username, senior, adult, children, totalPrice, bookingDate FROM bookings ORDER BY id DESC LIMIT 1');
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if booking data is fetched correctly
    if ($booking) {
        // Return the data as JSON
        echo json_encode($booking);
    } else {
        echo json_encode(['message' => 'No booking found']);
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
