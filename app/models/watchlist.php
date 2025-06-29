<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "revotv_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection Failed:" . mysqli_connect_error());
}
$sql = "CREATE TABLE User_Watchlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(255),
    movie_title VARCHAR(255),
    movie_poster TEXT,
    UNIQUE(user_email, movie_title)
    )";

if (mysqli_query($conn, $sql)) {
    echo "Table User_Watchlist created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>