<?php

declare(strict_types=1);

// delete site option
function delete_site_option(object $pdo, int $site_option_id)
{
    $query = "DELETE FROM site_options WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $site_option_id);

    $stmt->execute();
}