<?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="revotv_db";
    
    $conn = mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn){
        die("Connection Failed:".mysqli_connect_error());
    }
    $sql="CREATE TABLE User_Info (
    User_Email VARCHAR(255) PRIMARY KEY,
    FName VARCHAR(100),
    LName VARCHAR(100),
    Profile_Picture VARCHAR(255), 
    User_Name VARCHAR(100) UNIQUE,
    User_Password VARCHAR(255)
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Table User_Info created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>