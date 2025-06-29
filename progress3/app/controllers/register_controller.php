<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "revotv_db";


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


function clean_input($conn, $data) {
    return mysqli_real_escape_string($conn, trim($data));
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = isset($_POST['fname']) ? clean_input($conn, $_POST['fname']) : '';
    $lastName = isset($_POST['lname']) ? clean_input($conn, $_POST['lname']) : '';
    $userName = isset($_POST['username']) ? clean_input($conn, $_POST['username']) : '';
    $email = isset($_POST['email']) ? clean_input($conn, $_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $photoURL = isset($_POST['photo_url']) ? clean_input($conn, $_POST['photo_url']) : '';

    
    $errors = [];

    if (empty($firstName) || empty($lastName) || empty($userName) || empty($email) || empty($password) || empty($photoURL)) {
        $errors[] = "All fields are required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (!filter_var($photoURL, FILTER_VALIDATE_URL)) {
        $errors[] = "Invalid photo URL.";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

   
    $checkSql = "SELECT * FROM user_info WHERE User_Email = ? OR User_Name = ?";
    $stmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $userName);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $errors[] = "Email or username already exists.";
    }

    if (!empty($errors)) {
        $_SESSION['register_errors'] = $errors;
        header("Location: /web-tech-project/app/views/Forms/user_register.php");
        exit();
    }

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $insertSql = "INSERT INTO user_info (User_Email, FName, LName, Profile_Picture, User_Name, User_Password)
                  VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertSql);
    mysqli_stmt_bind_param($stmt, "ssssss", $email, $firstName, $lastName, $photoURL, $userName, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['register_success'] = "Registration successful. Please log in.";
        header("Location: /web-tech-project/app/views/Forms/user_register.php");
        exit();
    } else {
        $_SESSION['register_errors'] = ["Registration failed. Try again."];
        header("Location:/web-tech-project/app/views/Forms/login_user_form.php");
        exit();
    }
}

mysqli_close($conn);
?>
