<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Information</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Books Information</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Genre</th>
            <th>Price</th>
            <th>Publication Date</th>
            <th>Language</th>
            <th>Stock Quantity</th>
            <th>Author</th>
            <th>Description</th>
        </tr>
        <?php
        // Connect to the database
        $servername = "localhost:3306";
        $username = "root";
        $password = "";
        $dbname = "bookshop";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to fetch data from books table where BookID = 1
        $sql = "SELECT Title, Genre, Price, PublicationDate, Language, StockQuantity, Author, Description FROM books WHERE BookID = 4";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Title"] . "</td>";
                echo "<td>" . $row["Genre"] . "</td>";
                echo "<td>" . $row["Price"] . "</td>";
                echo "<td>" . $row["PublicationDate"] . "</td>";
                echo "<td>" . $row["Language"] . "</td>";
                echo "<td>" . $row["StockQuantity"] . "</td>";
                echo "<td>" . $row["Author"] . "</td>";
                echo "<td>" . $row["Description"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
