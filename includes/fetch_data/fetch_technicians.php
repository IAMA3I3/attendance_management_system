<?php

try {
    // fetch all technicians
    $technicians = fetch_all_technicians($pdo);

    

} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}