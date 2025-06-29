<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "revotv_db";

// Create DB connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Delete user by email
    $stmt = $conn->prepare("DELETE FROM user_info WHERE User_Email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "User deleted successfully";
    } else {
        http_response_code(500);
        echo "Error deleting user";
    }

    $stmt->close();
} else {
    http_response_code(400);
    echo "Invalid request";
}

$conn->close();
?>