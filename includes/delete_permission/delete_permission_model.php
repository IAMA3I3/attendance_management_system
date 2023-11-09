<?php

declare(strict_types=1);

// delete permission option
function delete_permission_option(object $pdo, int $permission_option_id)
{
    $query = "DELETE FROM permission_options WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $permission_option_id);

    $stmt->execute();
}