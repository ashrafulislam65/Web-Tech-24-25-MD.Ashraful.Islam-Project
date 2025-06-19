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
    $email = isset($_POST['email']) ? clean_input($conn, $_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $errors = [];

    if (empty($email) || empty($password)) {
        $errors[] = "Email and password are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (!empty($errors)) {
        $_SESSION['login_errors'] = $errors;
        header("Location: /web-tech-project/app/views/Forms/user_loging_controller.php");
        exit();
    }

    
    $sql = "SELECT * FROM user_info WHERE User_Email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user['User_Password'])) {
            
            $_SESSION['user'] = [
                'id' => $user['User_ID'],
                'email' => $user['User_Email'],
                'fname' => $user['FName'],
                'lname' => $user['LName'],
                'username' => $user['User_Name'],
                'profile_picture' => $user['Profile_Picture']
            ];

            header("Location: /web-tech-project/app/index.php");
            exit();
        } else {
            $_SESSION['login_errors'] = ["Invalid password."];
        }
    } else {
        $_SESSION['login_errors'] = ["User not found."];
    }

    header("Location: /web-tech-project/app/views/Forms/user_loging_controller.php");
    exit();
}

mysqli_close($conn);
?>
