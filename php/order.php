<?php
// Database connection
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";      // Replace with your database password
$dbname = "bos_coffee";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for database connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

// SQL query to fetch orders data
$sql = "SELECT order_id, product_name, price, status, date FROM orders";
$result = $conn->query($sql);

// Check if the query returns any rows
if ($result === false) {
  die("Error in query: " . $conn->error);
}

// Grouping by order_id
$groupedOrders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $order_id = $row['order_id'];
        if (!isset($groupedOrders[$order_id])) {
            $groupedOrders[$order_id] = [
                'order_id' => $order_id,
                'product_names' => [],
                'product_prices' => [],
                'date' => $row['date'],
                'status' => $row['status'],
                'total_amount' => 0
            ];
        }
        $groupedOrders[$order_id]['product_names'][] = $row['product_name'];
        $groupedOrders[$order_id]['product_prices'][] = $row['price'];
        $groupedOrders[$order_id]['total_amount'] += $row['price'];
    }
} else {
    echo "0 results found";
}

// Displaying the table
foreach ($groupedOrders as $order) {
    echo '<tr>';
    echo '<td>' . $order['order_id'] . '</td>';
    echo '<td>' . implode(', ', $order['product_names']) . '</td>';
    echo '<td>' . implode(', ', $order['product_prices']) . '</td>';
    echo '<td>' . $order['date'] . '</td>';
    echo '<td>' . $order['status'] . '</td>';
    echo '<td>' . $order['total_amount'] . '</td>';
    echo '</tr>';
}

// Close the database connection
$conn->close();
?>
