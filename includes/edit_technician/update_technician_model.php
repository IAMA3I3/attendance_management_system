<?php

declare(strict_types= 1);

// check for staff id in db exclude this
function check_staff_id_by_other(object $pdo, int $staff_id, $technician_id)
{
    $query = "SELECT * FROM users WHERE staff_id = :staff_id AND id != :id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":staff_id", $staff_id);
    $stmt->bindParam(":id", $technician_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

// check for email in db exclude this
function check_email_by_other(object $pdo, string $email, $technician_id)
{
    $query = "SELECT * FROM users WHERE email = :email AND id != :id";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":id", $technician_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

// update technician
function update_technician(object $pdo, $technician_id, string $first_name, string $last_name, int $staff_id, $dob, string $site, string $email, string $status)
{
    $query = "UPDATE users SET first_name = :first_name, last_name = :last_name, staff_id = :staff_id, dob = :dob, site = :site, email = :email, status = :status WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $technician_id);
    $stmt->bindParam(":first_name", $first_name);
    $stmt->bindParam(":last_name", $last_name);
    $stmt->bindParam(":staff_id", $staff_id);
    $stmt->bindParam(":dob", $dob);
    $stmt->bindParam(":site", $site);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":status", $status);

    $stmt->execute();
}