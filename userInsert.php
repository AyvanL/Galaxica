<?php
// Database configuration
$servername = "localhost"; // Change this to your server name
$username = "root";        // Change this to your database username
$password = "";            // Change this to your database password
$dbname = "galaxica";      // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['Fname'];
    $lname = $_POST['Lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to insert user data
    $sql = "INSERT INTO user (first_name, last_name, username, email, password)
            VALUES ('$fname', '$lname', '$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to loggedUser.html if successful
        echo "<script>alert('Account created successfully! Please login.'); window.location.href='index.html';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
