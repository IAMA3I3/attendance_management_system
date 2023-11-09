<?php

try {
    $query = "SELECT * FROM users RIGHT JOIN take_permission ON users.id = take_permission.user_id ORDER BY created_at DESC;";

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $permission_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Query failed: ". $e->getMessage());
}