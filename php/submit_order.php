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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the unique order ID (shared for all products)
    $order_id = $_POST['order_id'];

    // Get the product data
    $product_ids = $_POST['product_id'];
    $product_names = $_POST['product_name'];
    $prices = $_POST['price'];

    // Set the default status
    $status = 'success';

    // Get the current timestamp
    $date = date('Y-m-d H:i:s');

    // Loop through the products and insert each into the database
    foreach ($product_ids as $index => $product_id) {
        $product_name = mysqli_real_escape_string($conn, $product_names[$index]);
        $price = mysqli_real_escape_string($conn, $prices[$index]);

        // SQL query to insert the order details
        $sql = "INSERT INTO orders (order_id, product_id, status, product_name, date, price) 
                VALUES ('$order_id', '$product_id', '$status', '$product_name', '$date', '$price')";

        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Redirect or show success message
    echo "Order submitted successfully!";
}
?>
