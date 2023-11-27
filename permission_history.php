<?php

require_once "./includes/session_config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ./index.php");
    die();
}

// fetch permissions requests
require_once "./includes/dbh_inc.php";
require_once "./includes/fetch_data/fetch_permission_requests.php";
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
                    <a class="nav active" href="./permission_history.php"><i class="fa-solid fa-clock-rotate-left"></i><span>Permission History</span></a>
                    <!--  -->
                    <a class="nav" href="./change_pwd.php"><i class="fa-solid fa-unlock-keyhole"></i><span>Change Password</span></a>
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
            <div class="mb-lg"></div>
            <div class="font-xl mb-lg">Permission History</div>
            <!--  -->
            <div class="card">
                <table class="mb">
                    <tr class="bold-text">
                        <td>Permission</td>
                        <td>Sent At</td>
                        <td>Duration</td>
                        <td>Overtime</td>
                        <td>Status</td>
                    </tr>
                    <?php foreach ($permission_requests as $permission_request) { ?>
                        <?php if ($permission_request["is_read"] == 1 && $permission_request["user_id"] == $_SESSION["user_id"]) { ?>
                            <tr>
                                <td>
                                    <div class=""><?php echo ($permission_request["is_other"] == 1) ? "<span class='bold-text'>Other: </span>" : "" ?><?php echo htmlspecialchars($permission_request["permission_text"]) ?></div>
                                </td>
                                <td>
                                    <div class="font-sm light-text"><?php echo htmlspecialchars($permission_request["created_at"]) ?></div>
                                </td>
                                <td>
                                    <div class=""><?php echo htmlspecialchars($permission_request["duration"]) ?>
                                </td>
                                <td>
                                    <?php if ($permission_request["overtime"] && $permission_request["overtime"] != "00:00:00") { ?>
                                        <div class="error-text">+ <?php echo $permission_request["overtime"] ?></div>
                                    <?php } ?>
                                    <?php if ($permission_request["overtime"] && $permission_request["overtime"] == "00:00:00") { ?>
                                        <div class="success-text">+ <?php echo $permission_request["overtime"] ?></div>
                                    <?php } ?>
                                </td>
                                <td>
                                    <div class="">
                                        <?php if ($permission_request["permission_grant"] == 1) { ?>
                                            <div class="success-text"><i class="fa-solid fa-check"></i><?php echo ($permission_request["permission_state"] === "accept") ? "In Progress" : "Accepted" ?></div>
                                        <?php } ?>
                                        <?php if ($permission_request["permission_grant"] == 0) { ?>
                                            <div class="error-text"><i class="fa-solid fa-xmark"></i> Declined</div>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/ecdfbd10f7.js" crossorigin="anonymous"></script>
    <script src="./js/display_live_time.js"></script>
    <script src="./js/side-nav.js"></script>
    <script src="./js/pop-up.js"></script>
</body>

</html>