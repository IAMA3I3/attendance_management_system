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
    <link rel="shortcut icon" href="./assets/gemsIcon.png" type="image/x-icon">
    <title>Dashboard | Admin</title>
</head>

<body>
    <!--  -->
    <div class="container">
        <!--  -->
        <?php if (isset($_GET["login"]) && $_GET["login"] === "success") { ?>
            <div class="success-message">
                <div class="success-text">Logged In</div>
            </div>
        <?php } ?>
        <!--  -->
        <?php if (isset($_GET["register"]) && $_GET["register"] === "success") { ?>
            <div class="success-message">
                <div class="success-text">Registered Successfully</div>
            </div>
        <?php } ?>
        <!--  -->
        <div class="font-xl">Dashboard</div>
        <!--  -->
        <div class="mb">Logged in as <?php echo $_SESSION["admin_first_name"] . " " . $_SESSION["admin_last_name"]; ?></div>
        <!--  -->
        <div class="mb">
            <a href="./register.php" class="btn">Register Technician</a>
        </div>
        <!--  -->
        <table>
            <tr class="bold-text">
                <td>ID No.</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Site</td>
                <td>On Duty</td>
                <td>Status</td>
                <td>More Datails</td>
            </tr>
            <?php foreach ($technicians as $technician) { ?>
                <tr>
                    <td><?php echo $technician["id_number"] ?></td>
                    <td><?php echo $technician["first_name"] ?></td>
                    <td><?php echo $technician["last_name"] ?></td>
                    <td><?php echo $technician["site"] ?></td>
                    <td>On Duty</td>
                    <td><?php echo $technician["user_status"] ?></td>
                    <td><a href="#" class="btn">More Details</a></td>
                </tr>
            <?php } ?>
        </table>
        <!--  -->
        <form action="./includes/admin_logout/logout_inc.php" method="post" onsubmit="return confirm('Do you really want to Log out?');">
            <button type="submit" class="btn">Logout</button>
        </form>
    </div>
</body>

</html>