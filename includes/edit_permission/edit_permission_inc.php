<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $permission_option_id = $_POST["permission_option_id"];

    try {
        require_once "../dbh_inc.php";
        require_once "./edit_permission_model.php";

        // fetch site option from db
        $permission_option = fetch_permission_option($pdo, $permission_option_id);

        require_once "../session_config.php";
        $_SESSION["permission_to_edit"] = $permission_option;

        header("Location: ../../manage_permissions.php?permission_edit=true");

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../manage_permissions.php");
    die();
}
