<?php
$servername = "localhost:3306"; // Change this if your MySQL server is hosted elsewhere
$username = "root";
$password = "";
$dbname = "bookshop"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get email and password from form submission
$email = $_POST['email'];
$password = $_POST['password'];

// Sanitize inputs to prevent SQL injection
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);

// Perform user authentication
$sql = "SELECT * FROM login WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User authentication successful
    // Redirect to index.html
    header("Location: index.html");
    exit(); // Ensure that script execution stops after redirection
} else {
    // User authentication failed
    echo "Invalid email or password";
}

// Close connection
$conn->close();
?>
