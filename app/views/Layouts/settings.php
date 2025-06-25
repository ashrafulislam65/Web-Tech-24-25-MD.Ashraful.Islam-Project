<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /web-tech-project/app/views/Forms/login_user_form.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="../../index.css">
</head>
<body>
    <?php include './header.php'; ?>

    <div class="settings-container" style="padding: 20px; max-width: 600px; margin: auto;">
        <h2>User Settings</h2>

        <!-- Profile Picture Display -->
        <?php if (!empty($user['profile_picture'])): ?>
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile Picture" style="width: 120px; height: 120px; border-radius: 50%;">
            </div>
        <?php endif; ?>

        <!-- Success/Error Messages -->
        <?php if (isset($_SESSION['update_success'])): ?>
            <p style="color: green;"><?php echo $_SESSION['update_success']; unset($_SESSION['update_success']); ?></p>
        <?php elseif (isset($_SESSION['update_errors'])): ?>
            <?php foreach ($_SESSION['update_errors'] as $error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endforeach; unset($_SESSION['update_errors']); ?>
        <?php endif; ?>

        <!-- Update Form -->
        <form action="../../controllers/update_user_profile_controller.php" method="POST">
            <label>First Name:</label>
            <input type="text" name="fname" value="<?= htmlspecialchars($user['fname']) ?>" required><br><br>

            <label>Last Name:</label>
            <input type="text" name="lname" value="<?= htmlspecialchars($user['lname']) ?>" required><br><br>

            <label>Username:</label>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required><br><br>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required readonly><br><br>

            <label>Profile Picture URL:</label>
            <input type="url" name="profile_picture" value="<?= htmlspecialchars($user['profile_picture']) ?>"><br><br>

            <button type="submit">Update Profile</button>
        </form>
    </div>

    <?php include './footer.php'; ?>
</body>
</html>
