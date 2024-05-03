<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgb(220, 220, 220);
        }

        .navbar,
        footer {
            background-color: white;
            /* White background */
            color: black;
            /* Black text */
            padding: 25px 20px;
            /* Increased padding for better spacing */
            text-align: center;
        }

        .navbar {
            display: flex;
            justify-content: center;
            /* Center the navigation links */
            align-items: center;
        }

        .navbar a {
            color: black;
            /* Black text */
            padding: 14px 16px;
            /* Padding for navigation links */
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: rgb(0, 0, 0);
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333333;
            margin-top: 10px;
            /* Increase margin */
        }

        p {
            line-height: 1.6;
            color: #666666;
        }

        .highlight {
            color: rgb(51, 159, 153);
            font-weight: bold;
        }

        .button {
            display: inline-block;
            background-color: rgb(51, 159, 153);
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: rgb(51, 159, 153);
        }

        .footer-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 10px;
        }

        .footer-icons i {
            font-size: 24px;
            color: black;
            /* Black text */
        }

        .footer-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <?php
    // Your PHP code here
    ?>
    <nav class="navbar">
        <a href="index.html">Home</a> |
        <a href="about.html">About</a> |
        <a href="ContactUs.html">Contact</a> |
        <a href="display_reviews.php">Review</a> |
        <a href="browser.html">Browse</a> |
        <a href="login.html">Login</a> |
        <a href="register.html">Register</a>
    </nav>

</body>
</html>

<?php
// Include your database connection file here
// Assuming you're using MySQL
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "bookshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve book ID from URL parameter
$bookId = $_GET['bookId'];

// Initialize variables to hold form data
$orderDate = date("Y-m-d");
$paymentMethod = "";
$firstName = "";
$lastName = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and retrieve form data
    $paymentMethod = $_POST['paymentMethod'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    // Insert the new order into the orders table
    $sql = "INSERT INTO orders (BookID, OrderDate, PaymentMethod, FirstName, LastName)
            VALUES ('$bookId', '$orderDate', '$paymentMethod', '$firstName', '$lastName')";

    if ($conn->query($sql) === TRUE) {
        // Update stock amount
        $sql_update_stock = "UPDATE books SET StockQuantity = StockQuantity - 1 WHERE BookID = $bookId";
        $conn->query($sql_update_stock);

        echo "<div style='background-color: #4CAF50; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;'>Order placed successfully!</div>";
    } else {
        echo "<div style='background-color: #f44336; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Retrieve book information from the database based on the book ID for display
$sql_book = "SELECT title, price, StockQuantity FROM books WHERE BookID = $bookId";
$result_book = $conn->query($sql_book);

if ($result_book->num_rows > 0) {
    // Output data of the first row (assuming book ID is unique)
    $row = $result_book->fetch_assoc();
    $title = $row["title"];
    $price = $row["price"];
    $stock = $row["StockQuantity"];
    
    // Display book information
    echo "<h2>Book Information</h2>";
    echo "<p>Title: " . $title . "</p>";
    echo "<p>Price: $" . $price . "</p>";
    echo "<p>Stock: " . $stock . "</p>";

    // Display form for user information input
    echo "<h2>Enter your information to complete the purchase:</h2>";
    echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "?bookId=$bookId'>";
    echo "<div style='margin-bottom: 20px;'>";
    echo "<label for='paymentMethod'>Payment Method:</label>";
    echo "<input type='text' id='paymentMethod' name='paymentMethod' style='width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;'>";
    echo "</div>";
    echo "<div style='margin-bottom: 20px;'>";
    echo "<label for='firstName'>First Name:</label>";
    echo "<input type='text' id='firstName' name='firstName' style='width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;'>";
    echo "</div>";
    echo "<div style='margin-bottom: 20px;'>";
    echo "<label for='lastName'>Last Name:</label>";
    echo "<input type='text' id='lastName' name='lastName' style='width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;'>";
    echo "</div>";
    echo "<button type='submit' style='background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;'>Submit</button>";
    echo "</form>";
} else {
    echo "<div style='background-color: #f44336; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px;'>Book not found</div>";
}

$conn->close();
?>



<footer>
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <div class="footer-icons">
            <a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://www.twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="fa fa-instagram"></i></a>
            <a href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>
            <a href="https://www.youtube.com" target="_blank"><i class="fa fa-youtube"></i></a>
        </div>
        <div class="footer-info">
            <p>123 Library Street, Book City, 12345</p>
            <p>Email: info@librarytlc.com</p>
            <p>Phone: (123) 456-7890</p>
        </div>
    </footer>

