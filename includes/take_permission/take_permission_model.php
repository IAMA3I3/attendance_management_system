<?php

declare(strict_types= 1);

// send permission
function send_permission(object $pdo, $user_id, string $permission, string $duration)
{
    $permission_state = "sent";
    $query = "INSERT INTO take_permission (user_id, permission_text, duration, permission_state) VALUES (:user_id, :permission_text, :duration, :permission_state);";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":permission_text", $permission);
    $stmt->bindParam(":duration", $duration);
    $stmt->bindParam(":permission_state", $permission_state);
    $stmt->execute();
}

// fetch permission state
function fetch_last_permission(object $pdo, $user_id)
{
    $query = "SELECT * FROM take_permission WHERE user_id = :user_id ORDER BY created_at DESC";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}