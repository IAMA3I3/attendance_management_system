<?php

require_once "./includes/session_config.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: ./admin.php");
    die();
}

require_once "./includes/dbh_inc.php";
require_once "./includes/fetch_data/fetch_technicians_model.php";
require_once "./includes/fetch_data/fetch_technicians.php";
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
    <!--  -->
    <div class="dashboard">
        <div class="side-bar-container">
            <div class="side-bar">
                <div class="navs">
                    <!--  -->
                    <a class="nav active" href="#"><i class="fa-solid fa-gauge"></i><span>Dashboard</span></a>
                    <!--  -->
                    <a class="nav" href="./register.php"><i class="fa-solid fa-user-plus"></i><span>Register Technician</span></a>
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
            <?php if (isset($_GET["login"]) && $_GET["login"] === "success") { ?>
                <div class="success-message" id="pop-up">
                    <div class="success-text">Logged In</div>
                </div>
            <?php } ?>
            <!--  -->
            <?php if (isset($_GET["register"]) && $_GET["register"] === "success") { ?>
                <div class="success-message" id="pop-up">
                    <div class="success-text">Registered Successfully</div>
                </div>
            <?php } ?>
            <!--  -->
            <div class="font-xl">Dashboard</div>
            <!--  -->
            <div class="mb">Logged in as <?php echo $_SESSION["admin_first_name"] . " " . $_SESSION["admin_last_name"]; ?></div>

            <!--  -->
            <table class="mb">
                <tr class="bold-text">
                    <td>Staff ID</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Site</td>
                    <td>Status</td>
                    <td></td>
                    <td>More Datails</td>
                </tr>
                <?php foreach ($technicians as $technician) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($technician["staff_id"]) ?></td>
                        <td><?php echo htmlspecialchars($technician["first_name"]) ?></td>
                        <td><?php echo htmlspecialchars($technician["last_name"]) ?></td>
                        <td><?php echo htmlspecialchars($technician["site"]) ?></td>
                        <td><?php echo htmlspecialchars($technician["status"]) ?></td>
                        <td>
                            <?php
                            if (fetch_technician_register($pdo, $technician["id"])) {
                                echo (fetch_technician_register($pdo, $technician["id"])["register"] == 0) ? '' : 'Present';
                            }
                            ?>
                        </td>
                        <td><a href="./technician_details.php?technician_id=<?php echo $technician["id"]; ?>" class="btn">More Details</a></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/ecdfbd10f7.js" crossorigin="anonymous"></script>
    <script src="./js/side-nav.js"></script>
    <script src="./js/pop-up.js"></script>
</body>

</html>