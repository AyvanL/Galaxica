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

$sql = "SELECT id, first_name, last_name, username, email, password FROM user";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
            <h4><a href="#">User Account</a></h4>
            <h4><a href="bookingAdmin.php">Bookings</a></h4>
            <h4><a href="transactionAdmin.php">Transactions</a></h4>
            <h4 style="margin-top: 200px;"><a href="index.html">Logout</a></h4>
        </nav>
    </div>
    
    <div style="width: 100%">
    <h1 style="text-align: center; padding-top: 20px;">User Account</h1>
    <table class="table table-bordered" style="margin-top: 20px; width: 100%;">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["first_name"] . "</td>";
                    echo "<td>" . $row["last_name"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["password"] . "</td>";
                    echo "<td>
                            <a href='userEdit.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a> 
                            <a href='userDelete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// Close connection
$conn->close();
?>
</body>
</html>
