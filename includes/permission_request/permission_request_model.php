<?php

declare(strict_types= 1);

// set is read
function is_read(object $pdo, $permission_id)
{
    $query = "UPDATE take_permission SET is_read = 1 WHERE id = :id";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":id", $permission_id);

    $stmt->execute();
}

// accept permission
function accept_permission(object $pdo, $permission_id, $time_start)
{
    $permission_state = "accept";
    $query = "UPDATE take_permission SET permission_grant = 1, permission_state = :permission_state, time_start = :time_start WHERE id = :id";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":id", $permission_id);
    $stmt->bindValue(":permission_state", $permission_state);
    $stmt->bindValue(":time_start", $time_start);

    $stmt->execute();
}

// decline permission
function decline_permission(object $pdo, $permission_id)
{
    $permission_state = "decline";
    $query = "UPDATE take_permission SET permission_grant = 0, permission_state = :permission_state WHERE id = :id";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":id", $permission_id);
    $stmt->bindValue(":permission_state", $permission_state);

    $stmt->execute();
}