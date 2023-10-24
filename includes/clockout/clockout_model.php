<?php

declare(strict_types=1);

// record clockout time
function clock_out(object $pdo, int $user_id)
{
    $query = "UPDATE attendance SET clockout = CURRENT_TIME() WHERE user_id = :user_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id);

    $stmt->execute();
}