<?php

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wristwonders";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$item = isset($_POST['item']) ? $_POST['item'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : 0;
$watches = isset($_POST['watches']) ? $_POST['watches'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';

// Prepare SQL statement
$sql = "INSERT INTO products (item, price, watches, description) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("siss", $item, $price, $watches, $description);

// Execute statement
if ($stmt->execute()) {
  echo "Product added to cart successfully.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();

?>
