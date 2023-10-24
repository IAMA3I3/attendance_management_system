<?php

require_once "./includes/session_config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="./assets/gemsIcon.png" type="image/x-icon">
    <title>Login | Admin</title>
</head>

<body>
    <div class="container">
        <!-- feedbacks -->
        <?php if (isset($_SESSION["login_errors"])) { ?>
            <?php $errors = $_SESSION["login_errors"]; ?>

            <?php foreach ($errors as $error) { ?>
                <div class="error-message">
                    <div class="error-text">
                        <?php echo $error; ?>
                    </div>
                </div>
            <?php } ?>

            <!--  -->
        <?php } ?>
        <!--  -->
        <div class="font-lg">ADMIN LOGIN</div>
        <form class="btw-y" action="./includes/admin_login/login_inc.php" method="post">
            <!--  -->
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
            </div>
            <!--  -->
            <div>
                <label for="pwd">Password</label>
                <input type="password" name="pwd" id="pwd">
            </div>
            <!--  -->
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>

</html>

<?php unset($_SESSION["login_errors"]); ?>