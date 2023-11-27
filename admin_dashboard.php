<?php

require_once "./includes/session_config.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: ./admin.php");
    die();
}

require_once "./includes/dbh_inc.php";
require_once "./includes/fetch_data/fetch_technicians_model.php";
require_once "./includes/fetch_data/fetch_technicians.php";
require_once "./includes/fetch_data/fetch_site_options.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/pop-form.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/register-page.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="./assets/gemsIcon.png" type="image/x-icon">
    <title>Dashboard | Admin</title>
</head>

<body>
    <!--  -->
    <div class="dashboard">
        <div class="side-bar-container">
            <div class="side-bar">
                <div class="navs">
                    <!--  -->
                    <a class="nav active" href="./dashboard.php"><i class="fa-solid fa-gauge"></i><span>Dashboard</span></a>
                    <!--  -->
                    <a class="nav" href="./permission_grant.php"><i class="fa-solid fa-message"></i><span>Permission Grant</span></a>
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
            <?php if (isset($_GET["login"]) && $_GET["login"] === "success") { ?>
                <div class="success-message" id="pop-up">
                    <div class="success-text">Logged In</div>
                </div>
            <?php } ?>
            <!--  -->
            <?php if (isset($_GET["update_technician"]) && $_GET["update_technician"] === "success") { ?>
                <div class="success-message" id="pop-up">
                    <div class="success-text">Technician Updated</div>
                </div>
            <?php } ?>
            <!--  -->
            <div class="mb-lg"></div>
            <div class="font-xl">Dashboard</div>
            <!--  -->
            <div class="mb"><?php echo $_SESSION["admin_first_name"] . " " . $_SESSION["admin_last_name"]; ?></div>

            <!--  -->
            <div class="pop-form-container <?php echo (isset($_SESSION["update_technician_errors"]) || isset($_GET["edit_technician"])) ? "pop" : ""; ?>">
                <div class="pop-form register-page">
                    <!--  -->
                    <form action="./includes/edit_technician/unset_edit.php" method="post">
                        <button class="close" type="submit"><i class="fa-solid fa-xmark"></i></button>
                    </form>
                    <!--  -->
                    <div class="font-lg mb">EDIT TECHNICIAN</div>
                    <!--  -->
                    <!-- feedbacks -->
                    <?php if (isset($_SESSION["update_technician_errors"])) { ?>
                        <?php $errors =  $_SESSION["update_technician_errors"]; ?>

                        <?php foreach ($errors as $error) { ?>
                            <div class="error-message" id="pop-up">
                                <div class="error-text">
                                    <?php echo $error; ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <!--  -->
                    <form action="./includes/edit_technician/update_technician_inc.php" method="post">
                        <!--  -->
                        <?php if (isset($_GET["edit_technician"]) && isset($_SESSION["technician_to_edit"]["id"])) { ?>
                            <?php $technician_id = $_SESSION["technician_to_edit"]["id"] ?>
                            <input type="hidden" name="technician_id" id="technician-id" value="<?php echo $technician_id; ?>">
                        <?php } ?>
                        <!--  -->
                        <div>
                            <label for="first-name">First Name</label>
                            <?php if (isset($_GET["edit_technician"]) && isset($_SESSION["technician_to_edit"]["first_name"])) { ?>
                                <input type="text" name="first_name" id="first-name" value="<?php echo htmlspecialchars($_SESSION["technician_to_edit"]["first_name"]); ?>">
                            <?php } elseif (isset($_SESSION["update_technician_data"]["first_name"]) && !isset($_SESSION["update_technician_errors"]["first_name_not_alpha"])) { ?>
                                <input type="text" name="first_name" id="first-name" value="<?php echo htmlspecialchars($_SESSION["update_technician_data"]["first_name"]); ?>">
                            <?php } ?>
                        </div>
                        <div>
                            <label for="last-name">Last Name</label>
                            <?php if (isset($_GET["edit_technician"]) && isset($_SESSION["technician_to_edit"]["last_name"])) { ?>
                                <input type="text" name="last_name" id="last-name" value="<?php echo htmlspecialchars($_SESSION["technician_to_edit"]["last_name"]); ?>">
                            <?php } elseif (isset($_SESSION["update_technician_data"]["last_name"]) && !isset($_SESSION["update_technician_errors"]["last_name_not_alpha"])) { ?>
                                <input type="text" name="last_name" id="last-name" value="<?php echo htmlspecialchars($_SESSION["update_technician_data"]["last_name"]); ?>">
                            <?php } ?>
                        </div>
                        <div>
                            <label for="staff-id">Staff ID</label>
                            <?php if (isset($_GET["edit_technician"]) && isset($_SESSION["technician_to_edit"]["staff_id"])) { ?>
                                <input type="number" name="staff_id" id="staff-id" value="<?php echo htmlspecialchars($_SESSION["technician_to_edit"]["staff_id"]); ?>">
                            <?php } elseif (isset($_SESSION["update_technician_data"]["staff_id"]) && !isset($_SESSION["update_technician_errors"]["staff_id_taken"])) { ?>
                                <input type="number" name="staff_id" id="staff-id" value="<?php echo htmlspecialchars($_SESSION["update_technician_data"]["staff_id"]); ?>">
                            <?php } else { ?>
                                <input type="number" name="staff_id" id="staff-id">
                            <?php } ?>
                        </div>
                        <div>
                            <label for="dob">Date of Birth</label>
                            <?php if (isset($_GET["edit_technician"]) && isset($_SESSION["technician_to_edit"]["dob"])) { ?>
                                <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($_SESSION["technician_to_edit"]["dob"]); ?>">
                            <?php } elseif (isset($_SESSION["update_technician_data"]["dob"])) { ?>
                                <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($_SESSION["update_technician_data"]["dob"]); ?>">
                            <?php } ?>
                        </div>
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
                        <div>
                            <label for="email">Email</label>
                            <?php if (isset($_GET["edit_technician"]) && isset($_SESSION["technician_to_edit"]["email"])) { ?>
                                <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($_SESSION["technician_to_edit"]["email"]); ?>">
                            <?php } elseif (isset($_SESSION["update_technician_data"]["email"]) && !isset($_SESSION["update_technician_errors"]["invalid_email"]) && !isset($_SESSION["update_technician_errors"]["email_taken"])) { ?>
                                <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($_SESSION["update_technician_data"]["email"]); ?>">
                            <?php } else { ?>
                                <input type="text" name="email" id="email" >
                            <?php } ?>
                        </div>
                        <div>
                            <label for="status">Status</label>
                            <select name="status" id="status">
                                <option value=""></option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn">Update</button>
                    </form>
                </div>
            </div>
            <!--  -->
            <div class="card">
                <!--  -->
                <div class="font-lg mb">TECHNICIANS</div>

                <!--  -->
                <table class="mb">
                    <tr class="bold-text">
                        <td>Staff ID</td>
                        <td>Name</td>
                        <td>Site</td>
                        <td>Status</td>
                        <td>Clock In</td>
                        <td>Clock Out</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php foreach ($technicians as $technician) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($technician["staff_id"]) ?></td>
                            <td><?php echo htmlspecialchars($technician["first_name"]) . " " . htmlspecialchars($technician["last_name"]) ?></td>
                            <td><?php echo htmlspecialchars($technician["site"]) ?></td>
                            <td><?php echo htmlspecialchars($technician["status"]) ?></td>
                            <td>
                                <?php
                                if (fetch_technician_register($pdo, $technician["id"])) {
                                    echo fetch_technician_register($pdo, $technician["id"])["date"] . " " . fetch_technician_register($pdo, $technician["id"])["clockin"];
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (fetch_technician_register($pdo, $technician["id"]) && fetch_technician_register($pdo, $technician["id"])["clockout"] !== "0000-00-00 00:00:00") {
                                    echo fetch_technician_register($pdo, $technician["id"])["clockout"];
                                }
                                ?>
                            </td>
                            <td class="success-text font-sm">
                                <?php
                                if (fetch_technician_register($pdo, $technician["id"])) {
                                    echo (fetch_technician_register($pdo, $technician["id"])["register"] == 0) ? '' : 'Present';
                                }
                                ?>
                            </td>
                            <td class="font-lg"><a title="More Details" href="./technician_details.php?technician_id=<?php echo $technician["id"]; ?>"><i class="fa-solid fa-circle-info"></i></a></td>
                            <td>
                                <form action="./includes/edit_technician/edit_technician_inc.php" method="post">
                                    <input type="hidden" name="technician_id" id="technician-id" value="<?php echo $technician["id"] ?>">
                                    <button title="Edit" class="ic-btn font-lg" type="submit"><i class="fa-solid fa-pen-to-square"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/ecdfbd10f7.js" crossorigin="anonymous"></script>
    <script src="./js/side-nav.js"></script>
    <script src="./js/pop-up.js"></script>
    <script src="./js/pop-form.js"></script>
</body>

</html>

<?php unset($_SESSION["update_technician_errors"]); ?>