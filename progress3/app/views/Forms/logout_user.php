<?php
session_start();
session_unset();
session_destroy();
header("Location: /web-tech-project/app/views/Forms/login_user_form.php");
exit();
?>
