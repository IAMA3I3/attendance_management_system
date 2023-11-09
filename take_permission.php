<?php

require_once "./includes/session_config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ./index.php");
    die();
}


// fetch permission options
require_once "./includes/dbh_inc.php";
require_once "./includes/fetch_data/fetch_permissions.php";

// get permission state
require_once "./includes/take_permission/take_permission_model.php";
// fetch permission state
$current_permission = fetch_last_permission($pdo, $_SESSION["user_id"]);

$_SESSION["permission_state"] = $current_permission["permission_state"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/register-page.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="./assets/gemsIcon.png" type="image/x-icon">
    <title>Dashboard | Technician</title>
</head>

<body>
    <!--  -->
    <div class="dashboard reg">
        <div class="side-bar-container">
            <div class="side-bar">
                <div class="navs">
                    <!--  -->
                    <a class="nav" href="./dashboard.php"><i class="fa-solid fa-gauge"></i><span>Dashboard</span></a>
                    <!--  -->
                    <a class="nav active" href="#"><i class="fa-solid fa-person-walking-arrow-loop-left"></i><span>Take Permission</span></a>
                    <!--  -->
                </div>
            </div>
            <div class="menu-ic">
                <i class="fa-solid fa-bars" id="bars"></i>
            </div>
        </div>

        <!--  -->
        <div class="body">
            <!--  -->
            <div class="register-page">
                <!-- feedbacks -->
                <?php if (isset($_SESSION["take_permission_errors"])) { ?>
                    <?php $errors = $_SESSION["take_permission_errors"]; ?>

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
                <?php if (isset($_GET["take_permission"]) && $_GET["take_permission"] === "success") { ?>
                    <div class="success-message" id="pop-up">
                        <div class="success-text">Permission Sent</div>
                    </div>
                <?php } ?>
                <!--  -->
                <div class="mb-lg"></div>
                <?php if (isset($_SESSION["permission_state"]) && $_SESSION["permission_state"] === "sent") { ?>
                    <div class="font-xl mb-lg">Wait For Response</div>
                    <div class="loading-container">
                        <img src="./assets/loading.gif" alt="">
                    </div>
                <?php } else if (isset($_SESSION["permission_state"]) && $_SESSION["permission_state"] === "accept") { ?>
                    <div class="font-xl mb-lg">Permission Granted</div>
                <?php } else { ?>
                    <div class="font-xl mb-lg">Take Permission</div>
                    <!--  -->
                    <form class="btw-y" action="./includes/take_permission/take_permission_inc.php" method="post">
                        <input type="hidden" name="user_id" id="user-id" value="<?php echo htmlspecialchars($_SESSION["user_id"]); ?>">
                        <div>
                            <label for="select-permission">Select Permission</label>
                            <select name="select_permission" id="select-permission">
                                <option value=""></option>
                                <!--  -->
                                <?php foreach ($permission_options as $permission_option) { ?>
                                    <option title="<?php echo htmlspecialchars($permission_option["description"]) ?>" value="<?php echo htmlspecialchars($permission_option["title"]) ?>"><?php echo htmlspecialchars($permission_option["title"]) ?></option>
                                <?php } ?>
                                <!--  -->
                                <option title="Type other reason to take permission in text field below" value="other">Other</option>
                            </select>
                        </div>
                        <!--  -->
                        <div>
                            <label for="other-reason">Other Reason (conditional)</label>
                            <textarea name="other_reason" id="other-reason"></textarea>
                        </div>
                        <!--  -->
                        <div>
                            <label for="duration">Duration</label>
                            <select name="duration" id="duration">
                                <option value=""></option>
                                <option value="5_less">5min or less</option>
                                <option value="6_15">6min - 15min</option>
                                <option value="16_30">16min - 30min</option>
                                <option value="31_1">31min - 1hr</option>
                            </select>
                        </div>
                        <!--  -->
                        <button type="submit" class="btn">Submit</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/ecdfbd10f7.js" crossorigin="anonymous"></script>
    <script src="./js/display_live_time.js"></script>
    <script src="./js/side-nav.js"></script>
    <script src="./js/pop-up.js"></script>
</body>

</html>

<!--  -->
<?php unset($_SESSION["take_permission_errors"]); ?>