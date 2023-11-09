<?php

declare(strict_types= 1);

// check if status exist in db
function search_title(object $pdo, string $title)
{
    $query = "SELECT * FROM permission_options WHERE title = :title;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":title", $title);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

// add permission
function add_permission(object $pdo, string $title, string $description)
{

    $query = "INSERT INTO permission_options (title, description) VALUES (:title, :description);";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":description", $description);
    $stmt->execute();
}

// update permission
function update_permission(object $pdo, $permission_option_id, string $title, string $description)
{
    $query = "UPDATE permission_options SET title = :title, description = :description WHERE id = :id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $permission_option_id);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":description", $description);
    $stmt->execute();
}