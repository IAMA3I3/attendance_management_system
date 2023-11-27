<?php

require_once "./includes/session_config.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: ./admin.php");
    die();
}

require_once "./includes/dbh_inc.php";
require_once "./includes/fetch_data/fetch_permissions.php";

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
                    <a class="nav" href="./permission_grant.php"><i class="fa-solid fa-message"></i><span>Permission Grant</span></a>
                    <!--  -->
                    <a class="nav" href="./register.php"><i class="fa-solid fa-user-plus"></i><span>Register Technician</span></a>
                    <!--  -->
                    <a class="nav" href="./manage_site.php"><i class="fa-solid fa-screwdriver-wrench"></i><span>Manage Site</span></a>
                    <!--  -->
                    <a class="nav active" href="./manage_permissions.php"><i class="fa-solid fa-person-walking-arrow-loop-left"></i><span>Manage Permissions</span></a>
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

            <!--  -->
            <?php if (isset($_GET["add_permission"]) && $_GET["add_permission"] === "success") { ?>
                <div class="success-message" id="pop-up">
                    <div class="success-text">Permission Added</div>
                </div>
            <?php } ?>
            <!--  -->
            <?php if (isset($_GET["update_permission"]) && $_GET["update_permission"] === "success") { ?>
                <div class="success-message" id="pop-up">
                    <div class="success-text">Permission Updated</div>
                </div>
            <?php } ?>
            <!--  -->
            <?php if (isset($_GET["delete_permission"]) && $_GET["delete_permission"] === "success") { ?>
                <div class="info-message" id="pop-up">
                    <div class="info-text">Permission Removed</div>
                </div>
            <?php } ?>
            <!--  -->
            <!--  -->
            <div class="mb-lg"></div>
            <div class="font-xl mb">Manage Permissions</div>
            <!--  -->
            <button class="btn-outline" id="pop-btn"><i class="fa-solid fa-plus"></i>Add Permissions</button>
            <!--  -->
            <div class="pop-form-container <?php echo (isset($_SESSION["add_permission_errors"]) || isset($_GET["permission_edit"])) ? 'pop' : ''; ?>">
                <div class="pop-form">
                    <!--  -->
                    <form action="./includes/edit_permission/unset_permission_edit.php" method="post">
                        <button class="close" type="submit"><i class="fa-solid fa-xmark"></i></button>
                    </form>
                    <!-- <div class="close">
                        <i class="fa-solid fa-xmark"></i>
                    </div> -->
                    <!--  -->
                    <div class="font-lg mb"><?php echo (isset($_GET["permission_edit"])) ? 'EDIT PERMISSION' : 'ADD PERMISSION'; ?></div>
                    <!--  -->
                    <?php if (isset($_SESSION["add_permission_errors"])) { ?>
                        <?php $errors = $_SESSION["add_permission_errors"]; ?>

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
                    <form class="btw-y" action="<?php echo (isset($_GET["permission_edit"])) ? './includes/edit_permission/update_permission_inc.php' : './includes/add_permission/add_permission_inc.php'; ?>" method="post">
                        <!--  -->
                        <?php if (isset($_GET["permission_edit"]) && isset($_SESSION["permission_to_edit"]["id"])) { ?>
                            <input type="hidden" name="permission_option_id" id="permission-option-id" value="<?php echo htmlspecialchars($_SESSION["permission_to_edit"]["id"]) ?>">
                        <?php } ?>
                        <!--  -->
                        <div>
                            <label for="title">Title</label>
                            <?php if (isset($_SESSION["add_permission_data"]["title"]) && !isset($_SESSION["add_permission_errors"]["title_used"])) { ?>
                                <input type="text" name="title" id="title" value="<?php echo $_SESSION["add_permission_data"]["title"]; ?>">
                            <?php } else if (isset($_GET["permission_edit"]) && isset($_SESSION["permission_to_edit"]["title"])) { ?>
                                <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($_SESSION["permission_to_edit"]["title"]) ?>">
                            <?php } else { ?>
                                <input type="text" name="title" id="title">
                            <?php } ?>
                        </div>
                        <!--  -->
                        <div>
                            <label for="description">Description</label>
                            <?php if (isset($_SESSION["add_permission_data"]["description"])) { ?>
                                <textarea name="description" id="description"><?php echo $_SESSION["add_permission_data"]["description"]; ?></textarea>
                            <?php } else if (isset($_GET["permission_edit"]) && isset($_SESSION["permission_to_edit"]["description"])) { ?>
                                <textarea name="description" id="description"><?php echo htmlspecialchars($_SESSION["permission_to_edit"]["description"]) ?></textarea>
                            <?php } else { ?>
                                <textarea name="description" id="description"></textarea>
                            <?php } ?>
                        </div>
                        <!--  -->
                        <!--  -->
                        <button type="submit" class="btn"><?php echo (isset($_GET["permission_edit"])) ? 'Update' : 'Add'; ?></button>
                    </form>
                </div>
            </div>
            <!--  -->
            <div class="card">
                <div class="font-lg mb">PERMISSIONS</div>
                <!--  -->
                <table class="mb">
                    <tr class="bold-text">
                        <td>Title</td>
                        <td>Description</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php foreach ($permission_options as $permission_option) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($permission_option["title"]); ?></td>
                            <td><?php echo htmlspecialchars($permission_option["description"]); ?></td>
                            <td>
                                <form action="./includes/edit_permission/edit_permission_inc.php" method="post">
                                    <input type="hidden" name="permission_option_id" id="permission-option-id" value="<?php echo $permission_option["id"] ?>">
                                    <button title="Edit" class="font-lg ic-btn primary-text" type="submit"><i class="fa-solid fa-pen-to-square"></i></button>
                                </form>
                            </td>
                            <td>
                                <form action="./includes/delete_permission/delete_permission_inc.php" method="post" onsubmit="return confirm('This permission will be completely removed');">
                                    <input type="hidden" name="permission_option_id" id="permission-option-id" value="<?php echo $permission_option["id"] ?>">
                                    <button title="Delete" class="font-lg ic-btn error-text" type="submit"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <!--  -->
        </div>
    </div>

    <script src="https://kit.fontawesome.com/ecdfbd10f7.js" crossorigin="anonymous"></script>
    <script src="./js/side-nav.js"></script>
    <script src="./js/pop-up.js"></script>
    <script src="./js/pop-form.js"></script>
</body>

</html>

<?php
if (isset($_SESSION["add_permission_errors"])) {
    unset($_SESSION["permission_to_edit"]);
}
?>

<?php unset($_SESSION["add_permission_errors"]); ?>
<?php unset($_SESSION["add_permission_data"]); ?>