<?php

require_once "./includes/session_config.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: ./admin.php");
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
    <link rel="stylesheet" href="css/pop-form.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="./assets/gemsIcon.png" type="image/x-icon">
    <title>Dashboard | Admin</title>
</head>

<body>
    <div class="dashboard">
        <div class="side-bar-container">
            <div class="side-bar">
                <div class="navs">
                    <!--  -->
                    <a class="nav" href="./admin_dashboard.php"><i class="fa-solid fa-gauge"></i><span>Dashboard</span></a>
                    <!--  -->
                    <a class="nav active" href="#"><i class="fa-solid fa-message"></i><span>Permission Grant</span></a>
                    <!--  -->
                    <a class="nav" href="./register.php"><i class="fa-solid fa-user-plus"></i><span>Register Technician</span></a>
                    <!--  -->
                    <a class="nav" href="./manage_site.php"><i class="fa-solid fa-screwdriver-wrench"></i><span>Manage Site</span></a>
                    <!--  -->
                    <a class="nav" href="./manage_permissions.php"><i class="fa-solid fa-person-walking-arrow-loop-left"></i><span>Manage Permissions</span></a>
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
            <!--  -->
            <?php if (isset($_GET["permission"]) && $_GET["permission"] === "decline") { ?>
                <div class="info-message" id="pop-up">
                    <div class="info-text">Permission Declined</div>
                </div>
            <?php } ?>
            <!--  -->
            <?php if (isset($_GET["permission"]) && $_GET["permission"] === "accept") { ?>
                <div class="success-message" id="pop-up">
                    <div class="success-text">Permission Granted</div>
                </div>
            <?php } ?>
            <!--  -->
            <div class="mb-lg"></div>
            <div class="font-xl mb-lg">Permission Grant</div>
            <!--  -->
            <div class="card">
                <div class="font-lg mb">REQUESTS</div>
                <table class="mb">
                    <tr class="bold-text">
                        <td>Technician</td>
                        <td>Sent At</td>
                        <td>Permission</td>
                        <td>Duration</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php foreach ($permission_requests as $permission_request) { ?>
                        <?php if ($permission_request["is_read"] == 0) { ?>
                            <tr>
                                <td>
                                    <div class=""><?php echo htmlspecialchars($permission_request["first_name"]) . " " . htmlspecialchars($permission_request["last_name"]) ?></div>
                                </td>
                                <td>
                                    <div class="font-sm light-text"><?php echo htmlspecialchars($permission_request["created_at"]) ?></div>
                                </td>
                                <td>
                                    <div class=""><?php echo ($permission_request["is_other"] == 1) ? "<span class='bold-text'>Other: </span>" : "" ?><?php echo htmlspecialchars($permission_request["permission_text"]) ?></div>
                                </td>
                                <td>
                                    <div class=""><span class="bold-text">Duration:</span> <?php echo htmlspecialchars($permission_request["duration"]) ?></div>
                                </td>
                                <td>
                                    <form action="./includes/permission_request/accept_permission_request_inc.php" method="post">
                                        <input type="hidden" name="permission_id" id="permission-id" value="<?php echo $permission_request["id"]; ?>">
                                        <button type="submit" class="btn-outline-success w-150-px"><i class="fa-solid fa-check"></i> Accept</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="./includes/permission_request/decline_permission_request.php" method="post">
                                        <input type="hidden" name="permission_id" id="permission-id" value="<?php echo $permission_request["id"]; ?>">
                                        <button type="submit" class="btn-outline-danger w-150-px"><i class="fa-solid fa-xmark"></i> Decline</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </table>
            </div>
            <div class="mb-lg"></div>
            <!--  -->
            <div class="card mb-lg">
                <div class="font-lg mb">PERMISSIONS</div>
                <table class="mb">
                    <tr class="bold-text">
                        <td>Technician</td>
                        <td>Sent At</td>
                        <td>Permission</td>
                        <td>Duration</td>
                        <td>Overtime</td>
                        <td>Status</td>
                    </tr>
                    <?php foreach ($permission_requests as $permission_request) { ?>
                        <?php if ($permission_request["is_read"] == 1) { ?>
                            <tr>
                                <td>
                                    <div class=""><?php echo htmlspecialchars($permission_request["first_name"]) . " " . htmlspecialchars($permission_request["last_name"]) ?></div>
                                </td>
                                <td>
                                    <div class="font-sm light-text"><?php echo htmlspecialchars($permission_request["created_at"]) ?></div>
                                </td>
                                <td>
                                    <div class=""><?php echo ($permission_request["is_other"] == 1) ? "<span class='bold-text'>Other: </span>" : "" ?><?php echo htmlspecialchars($permission_request["permission_text"]) ?></div>
                                </td>
                                <td>
                                    <div class="display-none" id="timer-up"><?php echo (((new DateTime(date('H:i:s')))->diff((new DateTime($permission_request["time_start"])))->format('%H:%i:%s'))) ?></div>
                                    <div class=""><?php echo htmlspecialchars($permission_request["duration"]) ?>
                                        <?php if ($permission_request["permission_grant"] == 1 && $permission_request["permission_state"] === "accept") { ?>
                                            | <span class="" id="show-timer"></span>
                                        <?php } ?>
                                    </div>
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
    <script src="./js/side-nav.js"></script>
    <script src="./js/pop-up.js"></script>
    <script src="./js/pop-form.js"></script>
    <script src="./js/timer-up.js"></script>
</body>

</html>