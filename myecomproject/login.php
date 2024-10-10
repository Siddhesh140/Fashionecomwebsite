<?php
// Database configuration
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "my_website";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the login form data
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare SQL query to fetch the user based on the email
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if a user exists with the entered email
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verify the password
    if (password_verify($password, $user['password_hash'])) {
        echo "Login successful! Welcome " . $user['username'];
    } else {
        echo "Incorrect password!";
    }
} else {
    echo "No user found with that email!";
}

// Close connection
$stmt->close();
$conn->close();

// Allow requests from any origin
header("Access-Control-Allow-Origin: *");

// Allow specific methods
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

// Allow specific headers (e.g., Content-Type)
header("Access-Control-Allow-Headers: Content-Type");

// Continue with your PHP logic...
