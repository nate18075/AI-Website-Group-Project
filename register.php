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

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

// Validate password and confirm password match
if ($password !== $confirm_password) {
    die("Passwords do not match");
}

// Sanitize inputs to prevent SQL injection
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);
$firstname = $conn->real_escape_string($firstname);
$lastname = $conn->real_escape_string($lastname);

// Check if email already exists in database
$sql_check_email = "SELECT * FROM login WHERE email='$email'";
$result_check_email = $conn->query($sql_check_email);

if ($result_check_email->num_rows > 0) {
    // Email already exists, return error message
    $response = array(
        "success" => false,
        "message" => "Email already exists"
    );
    echo json_encode($response);
    exit(); // Stop further execution
}

// Insert user into database
$sql = "INSERT INTO login (email, password, firstname, lastname) VALUES ('$email', '$password', '$firstname', '$lastname')";

if ($conn->query($sql) === TRUE) {
    // Registration successful
    $response = array(
        "success" => true,
        "message" => "Registration successful"
    );
    echo json_encode($response);
} else {
    // Error inserting user
    $response = array(
        "success" => false,
        "message" => "Error: " . $sql . "<br>" . $conn->error
    );
    echo json_encode($response);
}

// Close connection
$conn->close();
?>
