<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['user']['email'])) {
    http_response_code(401);
    echo json_encode(["error" => "Not logged in"]);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['movie_title']) || !isset($input['movie_poster'])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid input"]);
    exit;
}

$conn = new mysqli("localhost", "root", "", "revotv_db");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$email = $conn->real_escape_string($_SESSION['user']['email']);
$title = $conn->real_escape_string($input['movie_title']);
$poster = $conn->real_escape_string($input['movie_poster']);

// Check if already exists
$check = $conn->query("SELECT * FROM User_Watchlist WHERE user_email = '$email' AND movie_title = '$title'");
if ($check && $check->num_rows > 0) {
    echo json_encode(["message" => "Already in watchlist"]);
    exit;
}

$sql = "INSERT INTO User_Watchlist (user_email, movie_title, movie_poster) 
        VALUES ('$email', '$title', '$poster')";

if ($conn->query($sql)) {
    echo json_encode(["message" => "Added to watchlist"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Insert failed: " . $conn->error]);
}
?>