<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "revotv_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection Failed:" . mysqli_connect_error());
}
$sql = "CREATE TABLE User_Activity (
    User_Email VARCHAR(255),
    Movie_Id INT,
    User_Rating FLOAT,
    User_Comment TEXT,
    PRIMARY KEY (User_Email, Movie_Id),
    FOREIGN KEY (User_Email) REFERENCES User_Info(User_Email) ON DELETE CASCADE
    )";

if (mysqli_query($conn, $sql)) {
    echo "Table User_Activity created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>