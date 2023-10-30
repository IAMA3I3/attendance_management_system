<?php

try {
    // fetch technician details
    $user_id = $_GET["technician_id"];

    $technician_details = fetch_technician_with_attendance($pdo, $user_id);

    if ($technician_details) {
        $last_technician_details = end($technician_details);
    }

    if (!$technician_details) {
        $technician_details = fetch_technician($pdo, $user_id);
        $last_technician_details = $technician_details;
    }

    if (!$technician_details || !$last_technician_details) {
        header("Location: ./admin_dashboard.php");
        die();
    }

    $att_dates = [];

    if (@$last_technician_details["date"]) {
        foreach ($technician_details as $technician_detail) {
            $att_dates[] = [
                "date" => $technician_detail["date"],
                "clockin" => $technician_detail["clockin"],
                "clockout" => $technician_detail["clockout"]
            ];
        }
    }

    $date_times = [];

    foreach ($att_dates as $att_date)
    {
        $att = explode(" ", $att_date["clockout"]);
        $date_times[] = [
            "clockout_date" => $att[0],
            "clockout_time" => $att[1]
        ];
    }

} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
