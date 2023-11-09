<?php

try {
    //fetch_site_options
    $query = "SELECT * FROM site_options;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $site_options = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
