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
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['countryCode'] . $_POST['phoneNumber']; // Concatenate country code and phone number
    $password = $_POST['newPassword'];

    // Check if the email already exists
    $check_query = "SELECT * FROM register WHERE email = '$email'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        // Email already exists in database
        echo "exists";
    } else {
        // Email does not exist, proceed with registration
        // SQL query to insert data into the register table
        $sql = "INSERT INTO register (username, email, pnumber, password) VALUES ('$username', '$email', '$phoneNumber', '$password')";

        if ($conn->query($sql) === TRUE) {
            // Registration successful
            echo "registered";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>
