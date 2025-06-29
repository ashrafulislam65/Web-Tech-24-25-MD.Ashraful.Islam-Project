<?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="revotv_db";
    
    $conn = mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn){
        die("Connection Failed:".mysqli_connect_error());
    }
    $sql="CREATE TABLE Admin_Info (
    Admin_Id VARCHAR(100) PRIMARY KEY,
    Admin_Name VARCHAR(100),
    Admin_Password VARCHAR(255)
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Table Admin_Info created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>