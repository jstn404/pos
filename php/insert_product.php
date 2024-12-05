<?php
// Database connection
$servername = "localhost";
$username = "root"; // Your DB username
$password = ""; // Your DB password
$dbname = "bos_coffee"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category = $_POST['category'];
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];

    // Check if an image is uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Read the file content
        $image_data = file_get_contents($_FILES["image"]["tmp_name"]);

        // Prepare SQL query to insert product data into the database
        $sql = "INSERT INTO products (category, name, detail, price, image) VALUES (?, ?, ?, ?, ?)";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind the parameters to the SQL statement
            // "s" for string (category, name, detail, image), "d" for decimal (price)
            $stmt->bind_param("ssssb", $category, $name, $detail, $price, $image_data);

            // Send the image data as a chunk
            $stmt->send_long_data(4, $image_data);

            // Execute the statement
            if ($stmt->execute()) {
                echo "New product has been added successfully.<br>";
                // Redirect to product list page or confirmation page
                header("Location: ../index.php");
                exit;
            } else {
                echo "Error: " . $stmt->error . "<br>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing the statement: " . $conn->error . "<br>";
        }
    } else {
        echo "No image uploaded, please upload an image.<br>";
    }

    // Close the connection
    $conn->close();
}
?>
