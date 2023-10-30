<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $site_option_id = $_POST["site_option_id"];

    try {
        require_once "../dbh_inc.php";
        require_once "./edit_site_model.php";

        // fetch site option from db
        $site_option = fetch_site_option($pdo, $site_option_id);

        require_once "../session_config.php";
        $_SESSION["site_to_edit"] = $site_option;

        header("Location: ../../manage_site.php?edit=true");

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../../manage_site.php");
    die();
}
