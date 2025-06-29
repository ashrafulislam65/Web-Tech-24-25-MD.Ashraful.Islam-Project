<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../Forms/login_user_form.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "revotv_db");
$user_email = $conn->real_escape_string($_SESSION['user']['email']);
$result = $conn->query("SELECT * FROM user_watchlist WHERE user_email = '$user_email'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Your Watchlist</title>
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="./watchlist.css">
</head>

<body>
    <?php include './header.php'; ?>

    <h2>Your Watchlist</h2>
    <div class="watchlist-container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
                <img src="<?= htmlspecialchars($row['movie_poster']) ?>" alt="">
                <h3><?= htmlspecialchars($row['movie_title']) ?></h3>
            </div>
        <?php endwhile; ?>
    </div>

    <?php include './footer.php'; ?>
</body>

</html>