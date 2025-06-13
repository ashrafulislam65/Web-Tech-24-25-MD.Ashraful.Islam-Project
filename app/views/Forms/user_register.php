<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    
    <form action="../controllers/RegisterController.php" method="POST">
        <label>First Name: <input type="text" name="fname" required></label><br>
        <label>Last Name: <input type="text" name="lname" required></label><br>
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <label>Profile Picture URL: <input type="url" name="photo_url" required></label><br>
        <button type="submit">Register</button>
    </form>

</body>

</html>