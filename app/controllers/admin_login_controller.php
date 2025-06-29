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

function clean_input($conn, $data)
{
    return mysqli_real_escape_string($conn, trim($data));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = isset($_POST['id']) ? clean_input($conn, $_POST['id']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $errors = [];

    if (empty($id) || empty($password)) {
        $errors[] = "Id and password are required.";
    }

    if (!empty($errors)) {
        $_SESSION['login_errors'] = $errors;
        header("Location: /web-tech-project/app/views/Forms/login_admin_form.php");
        exit();
    }

    $sql = "SELECT * FROM admin_info WHERE Admin_Id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($admin = mysqli_fetch_assoc($result)) {
        if ($admin['Admin_Password'] === $password) {

            $_SESSION['admin_id'] = $admin['Admin_Id'];
            $_SESSION['admin_name'] = $admin['Admin_Name'];
            header("Location: /web-tech-project/app/views/admin_home.php");
            exit();
        } else {
            $errors[] = "Invalid password.";
        }
    } else {
        $errors[] = "Admin ID not found.";
    }

    $_SESSION['login_errors'] = $errors;
    header("Location: /web-tech-project/app/views/Forms/login_admin_form.php");
    exit();
}
?>