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
    <h1>User Login</h1>
    <section class="body_login">
        <form action="login_process.php" method="post" class="login-container">
            <h2>Login</h2>
            <input type="email" name="email" placeholder="Email address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign In</button>
            <p>Don't have an account? <a href="./user_register.php">Register</a></p>
        </form>
    </section>

    hi i am login page
    <!-- footer -->
    <?php include '../Layouts/footer.php'; ?>


</body>

</html>