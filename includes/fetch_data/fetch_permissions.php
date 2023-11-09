<?php

try {
    // fetch permission
    $query = "SELECT * FROM permission_options;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $permission_options = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}