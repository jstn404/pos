<?php
// Database connection
$servername = "localhost";
$username = "root";  // Your DB username
$password = "";      // Your DB password
$dbname = "bos_coffee"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
}

// Get the product_id from the request
$product_id = $_GET['product_id'];

// Query the database for product details using the product_id
$query = "SELECT product_id, name, price FROM products WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);  // Bind the product_id parameter
$stmt->execute();
$result = $stmt->get_result();

$product = $result->fetch_assoc();

if ($product) {
    // Return product details including the product_id
    echo json_encode([
        'productId' => $product['product_id'],  // Include product_id in the response
        'name' => $product['name'],
        'price' => $product['price']
    ]);
} else {
    echo json_encode(['error' => 'Product not found']);
}
?>
