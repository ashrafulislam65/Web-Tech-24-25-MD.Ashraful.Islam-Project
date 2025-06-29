<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../index.css">
</head>

<body>
    <?php include './header.php'; ?>

    <section class="container">
        <div id="actor-profiles-container"></div>
    </section>

    <script src="./actor_profiles.js"></script>
    <?php include './footer.php'; ?>
</body>

</html>