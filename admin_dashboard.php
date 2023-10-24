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
        <div class="font-xl">Dashboard</div>
        <div class="">Logged in as <?php echo $_SESSION["user_first_name"] . " " . $_SESSION["user_last_name"]; ?></div>
        <form action="./includes/admin_logout/logout_inc.php" method="post" onsubmit="return confirm('Do you really want to Log out?');">
            <button type="submit" class="btn">Logout</button>
        </form>
    </div>
</body>

</html>