<?php

require_once "./includes/session_config.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: ./admin.php");
    die();
}

require_once "./includes/dbh_inc.php";
require_once "./includes/fetch_data/fetch_site_options.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="./assets/gemsIcon.png" type="image/x-icon">
    <title>Dashboard | Admin</title>
</head>

<body>
    <div class="dashboard">

        <!--  -->
        <div class="side-bar-container">
            <div class="side-bar">
                <div class="navs">
                    <!--  -->
                    <a class="nav" href="./admin_dashboard.php"><i class="fa-solid fa-gauge"></i><span>Dashboard</span></a>
                    <!--  -->
                    <a class="nav active" href="./register.php"><i class="fa-solid fa-user-plus"></i><span>Register Technician</span></a>
                    <!--  -->
                    <a class="nav" href="./manage_site.php"><i class="fa-solid fa-screwdriver-wrench"></i><span>Manage Site</span></a>
                    <!--  -->
                    <form class="" action="./includes/admin_logout/logout_inc.php" method="post" onsubmit="return confirm('Do you really want to Log out?');">
                        <button type="submit" class=""><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span></button>
                    </form>
                </div>
            </div>
            <div class="menu-ic">
                <i class="fa-solid fa-bars" id="bars"></i>
            </div>
        </div>

        <!--  -->
        <div class="body">
            <!-- feedbacks -->
            <?php if (isset($_SESSION["register_errors"])) { ?>
                <?php $errors = $_SESSION["register_errors"]; ?>

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

            <!--  -->
            <!--  -->
            <div class="font-lg">REGISTER TECHNICIAN</div>
            <form class="btw-y" action="./includes/register/register_inc.php" method="post" enctype="multipart/form-data">
                <!--  -->
                <div>
                    <label for="first-name">First Name</label>
                    <?php if (isset($_SESSION["input_data"]["first_name"]) && !isset($_SESSION["register_errors"]["first_name_not_alpha"])) { ?>
                        <input type="text" name="first_name" id="first-name" value="<?php echo $_SESSION["input_data"]["first_name"]; ?>">
                    <?php } else { ?>
                        <input type="text" name="first_name" id="first-name">
                    <?php } ?>
                </div>
                <!--  -->
                <div>
                    <label for="last-name">Last Name</label>
                    <?php if (isset($_SESSION["input_data"]["last_name"]) && !isset($_SESSION["register_errors"]["last_name_not_alpha"])) { ?>
                        <input type="text" name="last_name" id="last-name" value="<?php echo $_SESSION["input_data"]["last_name"]; ?>">
                    <?php } else { ?>
                        <input type="text" name="last_name" id="last-name">
                    <?php } ?>
                </div>
                <!--  -->
                <div>
                    <label for="staff-id">Staff ID</label>
                    <?php if (isset($_SESSION["input_data"]["staff_id"]) && !isset($_SESSION["register_errors"]["id_registered"])) { ?>
                        <input type="number" name="staff_id" id="staff-id" value="<?php echo $_SESSION["input_data"]["staff_id"]; ?>">
                    <?php } else { ?>
                        <input type="number" name="staff_id" id="staff-id">
                    <?php } ?>
                </div>
                <!--  -->
                <div>
                    <label for="dob">Date of Birth</label>
                    <?php if (isset($_SESSION["input_data"]["dob"])) { ?>
                        <input type="date" name="dob" id="dob" value="<?php echo $_SESSION["input_data"]["dob"] ?>">
                    <?php } else { ?>
                        <input type="date" name="dob" id="dob">
                    <?php } ?>
                </div>
                <!--  -->
                <div>
                    <label for="site">Site</label>
                    <select name="site" id="site">
                        <option value=""></option>
                        <?php foreach ($site_options as $site_option) { ?>
                            <option value="<?php echo htmlspecialchars($site_option["site_name"]) ?>">
                                <?php echo htmlspecialchars($site_option["site_name"]) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <!--  -->
                <div>
                    <label for="passport">Passport</label>
                    <input type="file" name="passport" id="passport">
                </div>
                <!--  -->
                <div>
                    <label for="email">Email</label>
                    <?php if (isset($_SESSION["input_data"]["email"]) && !isset($_SESSION["register_errors"]["invalid_email"]) && !isset($_SESSION["register_errors"]["email_registered"])) { ?>
                        <input type="text" name="email" id="email" value="<?php echo $_SESSION["input_data"]["email"]; ?>">
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
    </div>

    <script src="https://kit.fontawesome.com/ecdfbd10f7.js" crossorigin="anonymous"></script>
    <script src="./js/side-nav.js"></script>
    <script src="./js/pop-up.js"></script>
</body>

</html>

<!--  -->
<?php unset($_SESSION["register_errors"]); ?>
<?php unset($_SESSION["input_data"]); ?>