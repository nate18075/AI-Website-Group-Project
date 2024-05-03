<?php
session_start(); // Start session to access user information

// Database credentials
$servername = "localhost:3306"; // Replace with your database server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "bookshop"; // Replace with your database name

try {
    // Attempt to connect to the database
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query the database to retrieve all reviews
    $stmt = $pdo->query("SELECT * FROM reviews");
    
    // Check if there are any rows returned
    if ($stmt->rowCount() > 0) {
        // Fetch all rows
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "No reviews found."; // Display message if no reviews found
    }
} catch(PDOException $e) {
    // Display an error message if unable to connect or query execution fails
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <style>
       footer {
    bottom: 0;
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
    padding-bottom: 150px; /* Add more padding to the bottom to accommodate the footer */
}

.container {
    max-width: 800px;
    margin: 80px auto 20px; /* Center the container and push it down from the navbar */
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow-y: auto; /* Add vertical scroll */
    max-height: calc(100vh - 200px); /* Adjust height to fit viewport minus header and footer */
}

h1 {
    text-align: center;
}

.review {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.review p {
    margin: 5px 0;
}

.navbar {
    background-color: white;
    color: rgb(0, 0, 0);
    padding: 20px;
    text-align: center;
    width: 100%;
    position: fixed;
    top: 0;
    z-index: 2; /* Ensure the navbar stays above other content */
}

.navbar a {
    color: rgb(0, 0, 0);
    padding: 14px 16px;
    text-decoration: none;
}

.navbar a:hover {
    background-color: #ddd;
    color: black;
}

footer {
    background-color: white;
    color: rgb(0, 0, 0);
    padding: 20px;
    text-align: center;
    width: 100%;
    position: fixed;
    bottom: 0;
    z-index: 1; /* Ensure the footer stays below other content */
}

.footer-icons a {
    color: rgb(0, 0, 0);
    padding: 10px;
    text-decoration: none;
}

.footer-info p {
    margin: 5px 0;
}

    </style>
</head>
<body>
<div class="navbar">
        <img src="C:\Users\B00961363\OneDrive - Ulster University\Desktop\assignment michael\image/logo.jpg" alt="Logo" style="position: absolute; top: 10px; left: 10px; height: 50px;">
        <nav>
        <a href="index.html">Home</a> |
      <a href="about.html">About</a> |
      <a href="ContactUs.html">Contact</a> |
      <a href="display_reviews.php">Review</a> |
      <a href="browser.html">Browse</a> |
      <a href="login.html">Login</a> |
      <a href="register.html">Register</a> |
      </div>
      <div class="container">
        <h1>Reviews</h1>
        <?php if(!empty($reviews)): ?>
            <?php foreach($reviews as $review): ?>
                <div class="review">
                    <?php if(isset($review['Name'])): ?>
                        <p><strong>User:</strong> <?php echo $review['Name']; ?></p>
                    <?php endif; ?>
                    <p><strong>Rating:</strong> <?php echo $review['Rating']; ?></p>
                    <p><strong>Review Text:</strong> <?php echo $review['ReviewText']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No reviews found.</p>
        <?php endif; ?>
        <a href="create_review.php" class="btn">Create Review</a>
    </div>
</body>

<footer>
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

</html>
