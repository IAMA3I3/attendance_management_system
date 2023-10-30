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
    <link rel="shortcut icon" href="./assets/gemsIcon.png" type="image/x-icon">
    <title>Dashboard | Technician</title>
</head>

<body>
    <!--  -->
    <div class="container">
        <!--  -->
        <?php if (isset($_GET["clockin"]) && $_GET["clockin"] === "success") { ?>
            <div class="success-message">
                <div class="success-text">Clocked In</div>
            </div>
        <?php } ?>
        <!--  -->
        <div class="font-xl">Dashboard</div>
        <!--  -->
        <div class="">Logged in as <?php echo $_SESSION["user_first_name"] . " " . $_SESSION["user_last_name"]; ?></div>
        <!--  -->
        <form action="./includes/clockout/clockout_inc.php" method="post" onsubmit="return confirm('You will not be able to clock in until after 24 hours of last clock in, Do you really want to Clock out now?');">
            <button type="submit" class="btn">Clock Out</button>
            <div class="font-sm light-text">At <span id="live-time"></span></div>
        </form>
    </div>

    <script src="./js/display_live_time.js"></script>
</body>

</html>