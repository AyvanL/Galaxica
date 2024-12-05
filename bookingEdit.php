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

// Fetch the booking to edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM bookings WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
    } else {
        echo "Booking not found!";
        exit();
    }
}

// Update the booking
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $senior = $_POST['senior'];
    $adult = $_POST['adult'];
    $children = $_POST['children'];
    $bookingDate = $_POST['bookingDate'];

    $updateSql = "UPDATE bookings SET username = '$username', senior = $senior, adult = $adult, children = $children, bookingDate = '$bookingDate' WHERE id = $id";
    
    if ($conn->query($updateSql) === TRUE) {
        header("Location: bookingAdmin.php"); // Redirect back to admin page after successful update
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2>Edit Booking</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $booking['username']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="senior" class="form-label">Senior Tickets</label>
                <input type="number" class="form-control" id="senior" name="senior" value="<?php echo $booking['senior']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="adult" class="form-label">Adult Tickets</label>
                <input type="number" class="form-control" id="adult" name="adult" value="<?php echo $booking['adult']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="children" class="form-label">Children Tickets</label>
                <input type="number" class="form-control" id="children" name="children" value="<?php echo $booking['children']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="bookingDate" class="form-label">Booking Date</label>
                <input type="date" class="form-control" id="bookingDate" name="bookingDate" value="<?php echo $booking['bookingDate']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Booking</button>
        </form>
    </div>
</body>
</html>
