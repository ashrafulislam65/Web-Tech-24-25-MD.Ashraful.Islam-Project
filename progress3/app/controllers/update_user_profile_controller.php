<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /web-tech-project/app/views/Forms/login_user_form.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "revotv_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Input sanitization
function clean_input($conn, $data) {
    return mysqli_real_escape_string($conn, trim($data));
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];

    $userEmail = $_SESSION['user']['email'];

    $fname = isset($_POST['fname']) ? clean_input($conn, $_POST['fname']) : '';
    $lname = isset($_POST['lname']) ? clean_input($conn, $_POST['lname']) : '';
    $username = isset($_POST['username']) ? clean_input($conn, $_POST['username']) : '';
    $profilePicture = isset($_POST['profile_picture']) ? clean_input($conn, $_POST['profile_picture']) : '';

    // Validation
    if (empty($fname) || empty($lname) || empty($username)) {
        $errors[] = "All fields except profile picture are required.";
    }

    // Optional: validate profile picture URL format
    if (!empty($profilePicture) && !filter_var($profilePicture, FILTER_VALIDATE_URL)) {
        $errors[] = "Invalid URL format for profile picture.";
    }

    if (!empty($errors)) {
        $_SESSION['update_errors'] = $errors;
        header("Location: /web-tech-project/app/views/Layouts/settings.php");
        exit();
    }

    // Update query
    $sql = "UPDATE user_info SET FName = ?, LName = ?, User_Name = ?, Profile_Picture = ? WHERE User_Email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $username, $profilePicture, $userEmail);

    if (mysqli_stmt_execute($stmt)) {
        // Update session
        $_SESSION['user']['fname'] = $fname;
        $_SESSION['user']['lname'] = $lname;
        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['profile_picture'] = $profilePicture;

        $_SESSION['update_success'] = "Profile updated successfully!";
    } else {
        $_SESSION['update_errors'] = ["Database error: " . mysqli_error($conn)];
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Redirect back
    header("Location: /web-tech-project/app/views/Layouts/settings.php");
    exit();
}
?>
