<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: /web-tech-project/app/views/Forms/login_admin_form.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "revotv_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$users = [];
$sql = "SELECT * FROM user_info";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
$total = count($users);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="./admin_home.css">
</head>

<body>
    <?php include 'Layouts/header.php'; ?>

    <main class="admin-container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</h1>
        <p>Total Registered Users: <strong><?php echo $total; ?></strong></p>

        <h2>User Management</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>FName</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Profile Picture</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['User_Email']); ?></td>
                        <td><?php echo htmlspecialchars($user['FName']); ?></td>
                        <td><?php echo htmlspecialchars($user['LName']); ?></td>
                        <td><?php echo htmlspecialchars($user['User_Name']); ?></td>
                        <td><?php echo htmlspecialchars($user['User_Password']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($user['Profile_Picture']); ?>" width="50" height="50" />
                        </td>
                        <td>
                            <button class="btn-delete" data-email="<?php echo $user['User_Email']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <script src="./admin_home.js"></script>
    <?php include 'Layouts/footer.php'; ?>
</body>

</html>