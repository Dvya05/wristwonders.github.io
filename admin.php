<?php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data['action'] === 'delete') {
        $id = $data['id'];
        $sql = "DELETE FROM register WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error deleting record.']);
        }
    } else {
        // Handle update
        $id = $data['id'];
        $username = $data['username'];
        $email = $data['email'];
        $sql = "UPDATE register SET username = '$username', email = '$email' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error updating record.']);
        }
    }
} else {
    $sql = "SELECT id, email, username FROM register";
    $result = $conn->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
}

$conn->close();
?>
