<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $technician_id = $_POST["technician_id"];

    try {
        require_once "../dbh_inc.php";
        require_once "./edit_technician_model.php";

        // fetch technician from db
        $technician = fetch_technician($pdo, $technician_id);

        require_once "../session_config.php";
        $_SESSION["technician_to_edit"] = $technician;

        header("Location: ../../admin_dashboard.php?edit_technician=true");

        die();
    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }
} else {
    header("Location: ../../admin_dashboard.php");
    die();
}
