
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../index.css">

</head>

<body>
    <!-- header -->
    <?php include '../Layouts/header.php'; ?>
    <!-- user register form -->

    <section class="register_body">
       
         <?php
        session_start();
        if (isset($_SESSION['register_errors'])) {
            foreach ($_SESSION['register_errors'] as $error) {
                echo "<p style='color: red;'>$error</p>";
            }
            unset($_SESSION['register_errors']);
        }

        if (isset($_SESSION['register_success'])) {
            echo "<p style='color: green;'>{$_SESSION['register_success']}</p>";
            unset($_SESSION['register_success']);
        }
        ?>
        <form action="../../controllers/register_controller.php" method="POST" class="register-container">
            <h2>Create Account</h2>

            <label>First Name:
                <input type="text" name="fname" required>
            </label>

            <label>Last Name:
                <input type="text" name="lname" required>
            </label>

            <label>Username:
                <input type="text" name="username" required>
            </label>

            <label>Email:
                <input type="email" name="email" required>
            </label>

            <label>Password:
                <input type="password" name="password" required>
            </label>

            <label>Profile Picture URL:
                <input type="url" name="photo_url" required>
            </label>

            <button type="submit">Register</button>
            <p>Already have an account? <a href="./login_user_form.php">Login</a></p>
        </form>
    </section>
    <!-- footer -->
    <?php include '../Layouts/footer.php'; ?>

</body>

</html>