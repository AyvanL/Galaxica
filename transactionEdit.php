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

// Get the transaction ID from URL
$transaction_id = $_GET['id'];

// Retrieve transaction details based on ID
$sql = "SELECT id, username, senior, adult, children, totalPrice, BookingDate, cardNum FROM transaction WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $transaction_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Transaction not found.");
}

// Handle form submission to update transaction
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $senior = $_POST['senior'];
    $adult = $_POST['adult'];
    $children = $_POST['children'];
    $totalPrice = $_POST['totalPrice'];
    $BookingDate = $_POST['BookingDate'];
    $cardNum = $_POST['cardNum'];

    // Update transaction in database
    $update_sql = "UPDATE transaction SET username = ?, senior = ?, adult = ?, children = ?, totalPrice = ?, BookingDate = ?, cardNum = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("siiisssi", $username, $senior, $adult, $children, $totalPrice, $BookingDate, $cardNum, $transaction_id);
    
    if ($update_stmt->execute()) {
        echo "Transaction updated successfully!";
        header("Location: transactionAdmin.php");
        exit();
    } else {
        echo "Error updating transaction: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaction</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container" style="max-width: 800px; margin-top: 20px;">
        <h2>Edit Transaction</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="senior" class="form-label">Senior Ticket</label>
                <input type="number" class="form-control" id="senior" name="senior" value="<?php echo $row['senior']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="adult" class="form-label">Adult Ticket</label>
                <input type="number" class="form-control" id="adult" name="adult" value="<?php echo $row['adult']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="children" class="form-label">Children Ticket</label>
                <input type="number" class="form-control" id="children" name="children" value="<?php echo $row['children']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="totalPrice" class="form-label">Total Price</label>
                <input type="text" class="form-control" id="totalPrice" name="totalPrice" value="<?php echo $row['totalPrice']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="BookingDate" class="form-label">Booking Date</label>
                <input type="text" class="form-control" id="BookingDate" name="BookingDate" value="<?php echo $row['BookingDate']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="cardNum" class="form-label">Debit Card Number</label>
                <input type="text" class="form-control" id="cardNum" name="cardNum" value="<?php echo $row['cardNum']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Transaction</button>
        </form>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
