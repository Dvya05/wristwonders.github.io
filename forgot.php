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
    $email = $_POST['email'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Validate if passwords match
    if ($newPassword != $confirmNewPassword) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        // Check if the email exists in the database
        $checkEmailQuery = "SELECT * FROM register WHERE email = '$email'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            // Email found, update the password
            $updatePasswordQuery = "UPDATE register SET password = '$newPassword' WHERE email = '$email'";

            if ($conn->query($updatePasswordQuery) === TRUE) {
                echo "<script>alert('Password updated successfully. Redirecting to login page...');</script>";
                echo "<script>window.location.href = 'index.html';</script>";
                exit; // Stop further execution
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            // Email not found in database
            echo "<script>alert('Email not registered. Redirecting to register page...');</script>";
            echo "<script>window.location.href = 'register.html';</script>";
            exit; // Stop further execution
        }
    }
}

// Close connection
$conn->close();
?>
