<?php

try {
    // fetch all technicians
    if (isset($_SESSION["last_id"])) {
        $technicians = fetch_all_technicians_with_attendance($pdo, $_SESSION["last_id"]);
    } else {
        $technicians = fetch_all_technicians($pdo);
    }

} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}