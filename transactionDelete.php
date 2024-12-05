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

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Delete transaction from database
    $delete_sql = "DELETE FROM transaction WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $transaction_id);
    
    if ($delete_stmt->execute()) {
        echo "Transaction deleted successfully!";
        header("Location: transactionAdmin.php");
        exit();
    } else {
        echo "Error deleting transaction: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container" style="max-width: 500px; margin-top: 20px;">
        <h2>Are you sure you want to delete this transaction?</h2>
        <form method="GET">
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="transactionAdmin.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
