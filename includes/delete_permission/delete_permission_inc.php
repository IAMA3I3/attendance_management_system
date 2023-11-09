<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $permission_option_id = $_POST["permission_option_id"];

    try {
        require_once "../dbh_inc.php";
        require_once "./delete_permission_model.php";

        // delete permission option
        delete_permission_option($pdo, $permission_option_id);

        header("Location: ../../manage_permissions.php?delete_permission=success");

        $stmt = null;
        $pdo = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../manage_permissions.php");
    die();
}
