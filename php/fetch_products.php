<?php
// Database connection
$servername = "localhost";
$username = "root";  // Your DB username
$password = "";      // Your DB password
$dbname = "bos_coffee"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch products from the database
$sql = "SELECT product_id, category, name, detail, price, image FROM products";
$result = $conn->query($sql);

// Check if there are any products
if ($result->num_rows > 0) {
    // Loop through the results and display the products
    while($row = $result->fetch_assoc()) {
        // Output the product details
        echo "<div class='product' data-id='" . $row['product_id'] . "' onclick='passProductId(this)'>";
        echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' />";
        echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
        echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";
        echo "<p><strong>Details:</strong> " . htmlspecialchars($row['detail']) . "</p>";
        echo "<p><strong>Price:</strong> $" . htmlspecialchars($row['price']) . "</p>";

        // Display the image (assuming the image is stored as BLOB in the database)
        // Use base64 encoding for embedding the image

        echo "</div>";
    }
} else {
    echo "No products found.";
}

// Close connection
$conn->close();
?>
