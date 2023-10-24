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
    <title>Register Admin</title>
</head>

<body>
    <div class="container">

        <!-- feedbacks -->
        <?php if (isset($_SESSION["signup_errors"])) { ?>
            <?php $errors = $_SESSION["signup_errors"]; ?>

            <?php foreach ($errors as $error) { ?>
                <div class="error-message">
                    <div class="error-text">
                        <?php echo $error; ?>
                    </div>
                </div>
            <?php } ?>

            <!--  -->
        <?php } ?>
        <?php if (isset($_GET["signup"]) && $_GET["signup"] === "success") { ?>
            <div class="success-message">
                <div class="success-text">Registered Successfully</div>
            </div>
        <?php } ?>
        <!--  -->

        <!--  -->
        <div class="font-lg">REGISTER ADMIN</div>
        <form class="btw-y" action="./includes/admin_signup/signup_inc.php" method="post">
            <!--  -->
            <div>
                <label for="first-name">First Name</label>
                <?php if (isset($_SESSION["signup_data"]["first_name"]) && !isset($_SESSION["signup_errors"]["first_name_not_alpha"])) { ?>
                    <input type="text" name="first_name" id="first-name" value="<?php echo $_SESSION["signup_data"]["first_name"]; ?>">
                <?php } else { ?>
                    <input type="text" name="first_name" id="first-name">
                <?php } ?>
            </div>
            <!--  -->
            <div>
                <label for="last-name">Last Name</label>
                <?php if (isset($_SESSION["signup_data"]["last_name"]) && !isset($_SESSION["signup_errors"]["last_name_not_alpha"])) { ?>
                    <input type="text" name="last_name" id="last-name" value="<?php echo $_SESSION["signup_data"]["last_name"]; ?>">
                <?php } else { ?>
                    <input type="text" name="last_name" id="last-name">
                <?php } ?>
            </div>
            <!--  -->
            <div>
                <label for="email">Email</label>
                <?php if (isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["signup_errors"]["invalid_email"]) && !isset($_SESSION["signup_errors"]["email_registered"])) { ?>
                    <input type="text" name="email" id="email" value="<?php echo $_SESSION["signup_data"]["email"]; ?>">
                <?php } else { ?>
                    <input type="text" name="email" id="email">
                <?php } ?>
            </div>
            <!--  -->
            <div>
                <label for="pwd">Password</label>
                <input type="password" name="pwd" id="pwd">
            </div>
            <!--  -->
            <div>
                <label for="confirm-pwd">Confirm Password</label>
                <input type="password" name="confirm_pwd" id="confirm-pwd">
            </div>
            <!--  -->
            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</body>

</html>

<!--  -->
<?php unset($_SESSION["signup_errors"]); ?>
<?php unset($_SESSION["signup_data"]); ?>