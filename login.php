<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; // Assuming no password for 'root' user as per previous context
$dbname = "wristwonders";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare data for insertion
    $email = $conn->real_escape_string($_POST['username']); // Assuming 'username' is used for both email and phone
    $password = $conn->real_escape_string($_POST['password']);

    // Encrypt password if needed (assuming plaintext for demonstration)
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email and password match in the database
    $checkLoginQuery = "SELECT * FROM register WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($checkLoginQuery);

    if ($result->num_rows > 0) {
        // Login successful, check if it's the specific admin user
        $user = $result->fetch_assoc();
        if ($user['email'] === 'Admin@gmail.com' && $user['password'] === 'Admin@123') {
            // Redirect to admin admin page
            echo "<script>window.location.href = '/handtime-html/admin/pages/admin.html';</script>";
            exit; // Stop further execution
        } else {
            // For regular users, redirect to home.html or another page
            echo "<script>window.location.href = 'home.html';</script>";
            exit; // Stop further execution
        }
    } else {
        // Login failed, show error message
        echo "<script>alert('Email or password incorrect. Please register first.');</script>";
        echo "<script>window.location.href = 'register.html';</script>";
        exit; // Stop further execution
    }
}

// Close connection
$conn->close();
?>
