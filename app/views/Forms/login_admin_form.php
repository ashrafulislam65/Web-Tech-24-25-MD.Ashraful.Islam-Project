<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../index.css" />

</head>

<body>
    <!--Header  -->
    <?php include '../Layouts/header.php'; ?>
    <h1>Admin Login</h1>
    <section class="body_login">
        <form action="../../controllers/admin_login_controller.php" method="post" class="login-container">
            <h2>Login</h2>
            <input type="text" name="id" placeholder="Admin Id" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign In</button>
        </form>
    </section>

    hi i am login page
    <!-- footer -->
    <?php include '../Layouts/footer.php'; ?>


</body>

</html>