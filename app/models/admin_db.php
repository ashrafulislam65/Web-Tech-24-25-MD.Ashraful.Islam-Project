<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "revotv_db";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "CREATE VIEW Admin_db AS
        SELECT 
            User_Name,
            Profile_Picture,
            User_Email
        FROM 
            User_Info";

if (mysqli_query($conn, $sql)) {
    echo "View Admin_db created successfully";
} else {
    echo "Error creating view: " . mysqli_error($conn);
}

mysqli_close($conn);
