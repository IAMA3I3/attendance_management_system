<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $site_option_id = $_POST["site_option_id"];

    try {
        require_once "../dbh_inc.php";
        require_once "./delete_site_model.php";

        // delete site option
        delete_site_option($pdo, $site_option_id);

        header("Location: ../../manage_site.php?delete_site=success");

        $stmt = null;
        $pdo = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../manage_site.php");
    die();
}
