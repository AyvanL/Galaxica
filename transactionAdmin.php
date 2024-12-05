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

// Retrieve transactions from the database
$sql = "SELECT id, username, senior, adult, children, totalPrice, BookingDate, cardNum FROM transaction";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Transactions</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div style="display: flex;">
    <div class="sideNav">
        <div style="display: flex;">
            <img src="logo.png" alt="logo" width="100px">
            <h2 style="color: white; padding-top: 15px;">Galaxica<br>Admin</h2>
        </div>

        <nav>
            <h4><a href="userAdmin.php">User Account</a></h4>
            <h4><a href="bookingAdmin.php">Bookings</a></h4>
            <h4><a href="#">Transactions</a></h4>
        </nav>
    </div>
    
    <div style="width: 100%">
        <h1 style="text-align: center; padding-top: 20px;">Transactions</h1>

        <!-- Display transactions -->
        <table class="table table-bordered" style="margin-top: 20px; width: 100%;">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Senior Ticket</th>
                    <th>Adult Ticket</th>
                    <th>Children Ticket</th>
                    <th>Price</th>
                    <th>Transaction Date</th>
                    <th>Debit Card Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["senior"] . "</td>";
                        echo "<td>" . $row["adult"] . "</td>";
                        echo "<td>" . $row["children"] . "</td>";
                        echo "<td>" . $row["totalPrice"] . "</td>";
                        echo "<td>" . $row["BookingDate"] . "</td>";
                        echo "<td>" . $row["cardNum"] . "</td>";
                        echo "<td>
                                <a href='transactionEdit.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a> 
                                <a href='transactionDelete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this transaction?\");'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Close connection
$conn->close();
?>
</body>
</html>
