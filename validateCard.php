<?php
// Database connection (replace with your credentials)
$host = 'localhost'; 
$dbname = 'galaxica';
$username = 'root';
$password = '';

try {
    // Establish a database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the card number and PIN from the POST request
    $cardNum = $_POST['cardNum'];
    $cardPin = $_POST['cardPin'];

    // Prepare the SQL query to check the card number and PIN
    $stmt = $pdo->prepare("SELECT * FROM dummydebit WHERE cardNum = :cardNum AND cardPin = :cardPin");
    $stmt->bindParam(':cardNum', $cardNum);
    $stmt->bindParam(':cardPin', $cardPin);

    // Execute the query
    $stmt->execute();

    // Check if a matching record was found
    if ($stmt->rowCount() > 0) {
        // Card validated successfully
        // Fetch the latest booking from the bookings table
        $bookingStmt = $pdo->query('SELECT username, senior, adult, children, totalPrice, bookingDate FROM bookings ORDER BY id DESC LIMIT 1');
        $booking = $bookingStmt->fetch(PDO::FETCH_ASSOC);

        // Check if the booking data is available
        if ($booking) {
            // Insert the booking details along with card number and PIN into the transaction table
            $insertStmt = $pdo->prepare("INSERT INTO transaction (username, senior, adult, children, totalPrice, bookingDate, cardNum, cardPin) 
                                        VALUES (:username, :senior, :adult, :children, :totalPrice, :bookingDate, :cardNum, :cardPin)");

            $insertStmt->bindParam(':username', $booking['username']);
            $insertStmt->bindParam(':senior', $booking['senior']);
            $insertStmt->bindParam(':adult', $booking['adult']);
            $insertStmt->bindParam(':children', $booking['children']);
            $insertStmt->bindParam(':totalPrice', $booking['totalPrice']);
            $insertStmt->bindParam(':bookingDate', $booking['bookingDate']);
            $insertStmt->bindParam(':cardNum', $cardNum);
            $insertStmt->bindParam(':cardPin', $cardPin);

            // Execute the insert query
            $insertStmt->execute();

            // Return success response
            echo json_encode(['valid' => true, 'message' => 'Card validated and transaction recorded.']);
        } else {
            echo json_encode(['valid' => false, 'message' => 'Booking details not found.']);
        }
    } else {
        echo json_encode(['valid' => false, 'message' => 'Invalid card number or PIN.']);
    }
} catch (PDOException $e) {
    echo json_encode(['valid' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
