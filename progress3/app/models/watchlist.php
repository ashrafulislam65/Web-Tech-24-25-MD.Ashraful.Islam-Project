<?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="revotv_db";
    
    $conn = mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn){
        die("Connection Failed:".mysqli_connect_error());
    }
    $sql="CREATE TABLE User_Watchlist (
    User_Email VARCHAR(255),
    Movie_Id INT,
    Movie_Title VARCHAR(255),
    Movie_Bio TEXT,
    Movie_Rating FLOAT,
    PRIMARY KEY (User_Email, Movie_Id),
    FOREIGN KEY (User_Email) REFERENCES User_Info(User_Email) ON DELETE CASCADE
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Table User_Watchlist created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>