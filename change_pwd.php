<?php

require_once "./includes/session_config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ./index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="./assets/gemsIcon.png" type="image/x-icon">
    <title>Dashboard | Technician</title>
</head>

<body>
    <!--  -->
    <div class="dashboard">
        <div class="side-bar-container">
            <div class="side-bar">
                <div class="navs">
                    <!--  -->
                    <a class="nav" href="./dashboard.php"><i class="fa-solid fa-gauge"></i><span>Dashboard</span></a>
                    <!--  -->
                    <a class="nav" href="./take_permission.php"><i class="fa-solid fa-person-walking-arrow-loop-left"></i><span>Take Permission</span></a>
                    <!--  -->
                    <a class="nav" href="./permission_history.php"><i class="fa-solid fa-clock-rotate-left"></i><span>Permission History</span></a>
                    <!--  -->
                    <a class="nav active" href="./change_pwd.php"><i class="fa-solid fa-unlock-keyhole"></i><span>Change Password</span></a>
                    <!--  -->
                </div>
            </div>
            <div class="menu-ic">
                <i class="fa-solid fa-bars" id="bars"></i>
            </div>
        </div>

        <!--  -->
        <div class="body">
            <div class="mb-lg"></div>
            <div class="font-xl mb-lg">Change Password</div>
            <!--  -->
            <div class="card mb-lg">
                <!--  -->
                <?php if (isset($_SESSION["change_pwd_errors"])) { ?>
                    <?php $errors = $_SESSION["change_pwd_errors"]; ?>

                    <?php foreach ($errors as $error) { ?>
                        <div class="error-message" id="pop-up">
                            <div class="error-text"><?php echo $error ?></div>
                        </div>
                    <?php } ?>
                <?php } ?>
                <!--  -->
                <?php if (isset($_GET["change_pwd"]) && $_GET["change_pwd"] === "success") { ?>
                    <div class="success-message" id="pop-up">
                        <div class="success-text">Password Changed</div>
                    </div>
                <?php } ?>
                <!--  -->
                <form class="flex-input btw-y" action="./includes/change_pwd/change_pwd_inc.php" method="post">
                    <input type="hidden" name="user_id" id="user-id" value="<?php echo $_SESSION["user_id"] ?>">
                    <div>
                        <label for="current-pwd">Current Password</label>
                        <input type="password" name="current_pwd" id="current-pwd">
                    </div>
                    <div>
                        <label for="new-pwd">New Password</label>
                        <input type="password" name="new_pwd" id="new-pwd">
                    </div>
                    <div>
                        <label for="confirm-pwd">Confirm Password</label>
                        <input type="password" name="confirm_pwd" id="confirm-pwd">
                    </div>
                    <div class="py"></div>
                    <div>
                        <button type="submit" class="btn m-auto">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/ecdfbd10f7.js" crossorigin="anonymous"></script>
    <script src="./js/display_live_time.js"></script>
    <script src="./js/side-nav.js"></script>
    <script src="./js/pop-up.js"></script>
</body>

</html>

<?php unset($_SESSION["change_pwd_errors"]) ?>