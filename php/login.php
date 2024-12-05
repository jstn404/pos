<?php
// Start session for user authentication
session_start();

// Database connection details
$servername = "localhost";
$username = "root"; // Update with your DB username
$password = ""; // Update with your DB password
$dbname = "bos_coffee";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Prepare SQL query to fetch user data
    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user is found with the given username
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the password (assuming plain text for this example)
        if ($input_password === $row['password']) {
            // Set session variables for successful login
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['username'] = $row['username'];

            // Redirect to the admin dashboard (or another page)
            header("Location: ../index.php");
            exit;
        } else {
            // Invalid password
            $_SESSION['error_message'] = "Incorrect credentials";
            header("Location: ../login.html");
            exit;
        }
    } else {
        // No user found
        $_SESSION['error_message'] = "Invalid credentials";
        header("Location: ../login.html");
        exit;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

?>
