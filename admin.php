<?php

require_once "./includes/session_config.php";

$last_login = date("d", mktime(date("H") - 20, 0, 0, date("m"), date("d"), date("Y")));
$present_login = date("d", mktime(date("H"), 0, 0, date("m"), date("d"), date("Y")));

// echo $present_login === $last_login;
// echo date("H");
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
    <div class="form-page">
        <!-- bg -->
        <img src="./assets/login.jpg" alt="" class="bg">
        <!--  -->
        <div class="form-card-container">
            <div class="form-card">
                <!--  -->
                <div class="logo mb">
                    <img src="./assets/gemsLogo.png" alt="">
                </div>
                <!--  -->
                <div class="font-lg mb">ADMIN LOGIN</div>
                <!-- feedbacks -->
                <?php if (isset($_SESSION["login_errors"])) { ?>
                    <?php $errors = $_SESSION["login_errors"]; ?>

                    <?php foreach ($errors as $error) { ?>
                        <div class="error-message" id="pop-up">
                            <div class="error-text">
                                <?php echo $error; ?>
                            </div>
                        </div>
                    <?php } ?>

                    <!--  -->
                <?php } ?>
                <!--  -->
                
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
        </div>
    </div>

    <script src="./js/pop-up.js"></script>
</body>

</html>

<?php unset($_SESSION["login_errors"]); ?>