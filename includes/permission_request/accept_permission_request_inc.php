<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $permission_id = $_POST["permission_id"];

    try {
        require_once "../dbh_inc.php";
        require_once "./permission_request_model.php";

        // set is read
        is_read($pdo, $permission_id);
        // accept permission
        accept_permission($pdo, $permission_id);

        header("Location: ../../permission_grant.php?permission=accept");

        $stmt = null;
        $pdo = null;
        die();
    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }
} else {
    header("Location: ../../permission_grant.php");
    die();
}
