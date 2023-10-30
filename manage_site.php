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
    <link rel="shortcut icon" href="./assets/gemsIcon.png" type="image/x-icon">
    <title>Manage Site</title>
</head>

<body>
    <div class="container">
        <!-- feedbacks -->
        <?php if (isset($_SESSION["add_site_errors"])) { ?>
            <?php $errors = $_SESSION["add_site_errors"]; ?>

            <?php foreach ($errors as $error) { ?>
                <div class="error-message">
                    <div class="error-text">
                        <?php echo $error; ?>
                    </div>
                </div>
            <?php } ?>

            <!--  -->
        <?php } ?>
        <!--  -->
        <?php if (isset($_GET["add_site"]) && $_GET["add_site"] === "success") { ?>
            <div class="success-message">
                <div class="success-text">Site Added</div>
            </div>
        <?php } ?>
        <!--  -->
        <?php if (isset($_GET["update_site"]) && $_GET["update_site"] === "success") { ?>
            <div class="success-message">
                <div class="success-text">Site Updated</div>
            </div>
        <?php } ?>
        <!--  -->
        <?php if (isset($_GET["delete_site"]) && $_GET["delete_site"] === "success") { ?>
            <div class="info-message">
                <div class="info-text">Site Removed</div>
            </div>
        <?php } ?>
        <!--  -->

        <!--  -->
        <div class="mb"></div>
        <div class="mb">
            <a href="./admin_dashboard.php" class="btn">Home</a>
        </div>
        <!--  -->
        <div class="font-lg"><?php echo (isset($_GET["edit"])) ? 'EDIT SITE' : 'ADD SITE'; ?></div>
        <form class="btw-y" action="<?php echo (isset($_GET["edit"])) ? './includes/edit_site/update_site_inc.php' : './includes/add_site/add_site_inc.php'; ?>" method="post">
            <!--  -->
            <?php if (isset($_GET["edit"]) && isset($_SESSION["site_to_edit"]["id"])) { ?>
                <input type="hidden" name="site_option_id" id="site-option-id" value="<?php echo htmlspecialchars($_SESSION["site_to_edit"]["id"]) ?>">
            <?php } ?>
            <!--  -->
            <div>
                <label for="site-name">Site Name</label>
                <?php if (isset($_SESSION["add_site_data"]["site_name"]) && !isset($_SESSION["add_site_errors"]["site_name_taken"])) { ?>
                    <input type="text" name="site_name" id="site-name" value="<?php echo $_SESSION["add_site_data"]["site_name"]; ?>">
                <?php } else if (isset($_GET["edit"]) && isset($_SESSION["site_to_edit"]["site_name"])) { ?>
                    <input type="text" name="site_name" id="site-name" value="<?php echo htmlspecialchars($_SESSION["site_to_edit"]["site_name"]) ?>">
                <?php } else { ?>
                    <input type="text" name="site_name" id="site-name">
                <?php } ?>
            </div>
            <!--  -->
            <div>
                <label for="description">Description</label>
                <?php if (isset($_SESSION["add_site_data"]["description"])) { ?>
                    <textarea name="description" id="description"><?php echo $_SESSION["add_site_data"]["description"]; ?></textarea>
                <?php } else if (isset($_GET["edit"]) && isset($_SESSION["site_to_edit"]["description"])) { ?>
                    <textarea name="description" id="description"><?php echo htmlspecialchars($_SESSION["site_to_edit"]["description"]) ?></textarea>
                <?php } else { ?>
                    <textarea name="description" id="description"></textarea>
                <?php } ?>
            </div>
            <!--  -->
            <div>
                <label for="location">Location</label>
                <?php if (isset($_SESSION["add_site_data"]["location"])) { ?>
                    <textarea name="location" id="location"><?php echo $_SESSION["add_site_data"]["location"]; ?></textarea>
                <?php } else if (isset($_GET["edit"]) && isset($_SESSION["site_to_edit"]["location"])) { ?>
                    <textarea name="location" id="location"><?php echo htmlspecialchars($_SESSION["site_to_edit"]["location"]) ?></textarea>
                <?php } else { ?>
                    <textarea name="location" id="location"></textarea>
                <?php } ?>
            </div>
            <!--  -->
            <div>
                <label for="longitude">Longitude</label>
                <?php if (isset($_SESSION["add_site_data"]["longitude"])) { ?>
                    <input type="number" name="longitude" id="longitude" step="any" value="<?php echo $_SESSION["add_site_data"]["longitude"] ?>">
                <?php } else if (isset($_GET["edit"]) && isset($_SESSION["site_to_edit"]["longitude"])) { ?>
                    <input type="number" name="longitude" id="longitude" step="any" value="<?php echo htmlspecialchars($_SESSION["site_to_edit"]["longitude"]) ?>">
                <?php } else { ?>
                    <input type="number" name="longitude" id="longitude" step="any">
                <?php } ?>
            </div>
            <!--  -->
            <div>
                <label for="latitude">Latitude</label>
                <?php if (isset($_SESSION["add_site_data"]["latitude"])) { ?>
                    <input type="number" name="latitude" id="latitude" step="any" value="<?php echo $_SESSION["add_site_data"]["latitude"] ?>">
                <?php } else if (isset($_GET["edit"]) && isset($_SESSION["site_to_edit"]["latitude"])) { ?>
                    <input type="number" name="latitude" id="latitude" step="any" value="<?php echo htmlspecialchars($_SESSION["site_to_edit"]["latitude"]) ?>">
                <?php } else { ?>
                    <input type="number" name="latitude" id="latitude" step="any">
                <?php } ?>
            </div>
            <!--  -->
            <button type="submit" class="btn"><?php echo (isset($_GET["edit"])) ? 'Update' : 'Add'; ?></button>
        </form>

        <!--  -->
        <table class="mb">
            <tr class="bold-text">
                <td>Site Name</td>
                <td>Description</td>
                <td>Location</td>
                <td>Longitude</td>
                <td>Latitude</td>
                <td></td>
                <td></td>
            </tr>
            <?php foreach ($site_options as $site_option) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($site_option["site_name"]) ?></td>
                    <td><?php echo htmlspecialchars($site_option["description"]) ?></td>
                    <td><?php echo htmlspecialchars($site_option["location"]) ?></td>
                    <td><?php echo htmlspecialchars($site_option["longitude"]) ?></td>
                    <td><?php echo htmlspecialchars($site_option["latitude"]) ?></td>
                    <td>
                        <form action="./includes/edit_site/edit_site_inc.php" method="post">
                            <input type="hidden" name="site_option_id" id="site-option-id" value="<?php echo $site_option["id"] ?>">
                            <button class="btn" type="submit">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form action="./includes/delete_site/delete_site_inc.php" method="post" onsubmit="return confirm('<?php echo htmlspecialchars($site_option['site_name']) ?> will be completely removed');">
                            <input type="hidden" name="site_option_id" id="site-option-id" value="<?php echo $site_option["id"] ?>">
                            <button class="btn bg-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>

<?php unset($_SESSION["add_site_errors"]); ?>
<?php unset($_SESSION["add_site_data"]); ?>
<?php unset($_SESSION["site_to_edit"]); ?>