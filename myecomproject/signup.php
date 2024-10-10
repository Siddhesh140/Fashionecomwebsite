<?php
// Database configuration
$servername = "localhost";
$dbusername = "root";  // Default XAMPP username
$dbpassword = "";      // Default XAMPP password (empty)
$dbname = "my_website";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check if password and confirm password match
if ($password !== $confirm_password) {
    echo "Passwords do not match!";
    exit();
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL query
$sql = "INSERT INTO users (username, email, phone_number, date_of_birth, password_hash) 
        VALUES (?, ?, ?, ?, ?)";

// Prepare and bind the query
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $username, $email, $phone, $dob, $hashed_password);

// Execute the query
if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
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
