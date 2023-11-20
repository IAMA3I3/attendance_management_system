<?php

declare(strict_types= 1);

// update time stop
function update_time_stop(object $pdo, $permission_id, $current_time)
{
    $permission_state = "end";
    $query = "UPDATE take_permission SET time_stop = :current_time, permission_state = :permission_state WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $permission_id);
    $stmt->bindParam(":current_time", $current_time);
    $stmt->bindParam(":permission_state", $permission_state);

    $stmt->execute();
}

// get duration
function get_permission(object $pdo, $permission_id)
{
    $query = "SELECT * FROM take_permission WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $permission_id);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

// update overtime
function update_overtime(object $pdo, $permission_id, $overtime)
{
    $query = "UPDATE take_permission SET overtime = :overtime WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $permission_id);
    $stmt->bindParam(":overtime", $overtime);
    $stmt->execute();
}