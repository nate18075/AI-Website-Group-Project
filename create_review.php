<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Review</title>
    <style>
        .navbar,
    footer {
      background-color: white;
      color: rgb(0, 0, 0);
      padding: 20px;
      text-align: center;
      width: 100%;
      position: fixed;
      z-index: 1;
      /* Ensure navbar and footer stay above content */
    }

    .navbar {
      top: 0;
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
      bottom: 0;
    }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="navbar">
    <img src="C:\Users\B00961363\OneDrive - Ulster University\Desktop\assignment michael\image/logo.jpg" alt="Logo"
      style="position: absolute; top: 10px; left: 10px; height: 50px;">
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
        <h1>Submit Review</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="rating">Rating (1-5):</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required>
            <label for="review">Review:</label>
            <textarea id="review" name="review" rows="4" required></textarea>
            <button type="submit">Submit Review</button>
        </form>
    </div>
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
</body>
</html>

<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials
    $servername = "localhost:3306"; // Replace with your database server name
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "bookshop"; // Replace with your database name
    
    // Validate form data (you can add more validation as needed)
    $name = $_POST["name"];
    $rating = $_POST["rating"];
    $reviewText = $_POST["review"];
    
    try {
        // Connect to the database
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Insert review into the database
        $stmt = $pdo->prepare("INSERT INTO reviews (Name, Rating, ReviewText) VALUES (:name, :rating, :reviewText)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':reviewText', $reviewText);
        $stmt->execute();
        
        // Redirect back to the review display page
        header("Location: display_reviews.php");
        exit();
    } catch(PDOException $e) {
        // Display an error message if unable to connect or insert data
        echo "Error: " . $e->getMessage();
    }
}
?>
