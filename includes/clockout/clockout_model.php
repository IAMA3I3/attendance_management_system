<?php

declare(strict_types=1);

// record clockout time
function clock_out(object $pdo, int $user_id, int $last_id)
{
    $query = "UPDATE attendance SET clockout = CURRENT_TIME(), user_status = 'Completed' WHERE user_id = :user_id AND id = :last_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":last_id", $last_id);

    $stmt->execute();
}