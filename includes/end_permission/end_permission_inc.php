<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $permission_id = $_POST["permission_id"];
    
    try {
        require_once "../dbh_inc.php";
        require_once "../session_config.php";
        require_once "./end_permission_model.php";

        // update time stop
        update_time_stop($pdo, $permission_id, date('H:i:s'));

        // handle overtime
        // get duration
        $permission = get_permission($pdo, $permission_id);
        $duration = $permission["duration"];
        switch ($duration) {
            case '31min - 1hr':
                $max_time = "01:00:00";
                break;
            
            case '16min - 30min':
                $max_time = "00:30:00";
                break;
            
            case '6min - 15min':
                $max_time = "00:15:00";
                break;
            
            case '5min or less':
                $max_time = "00:5:00";
                break;
            
            default:
                $max_time = "00:00:00";
                break;
        }
        // echo $max_time . "<br>";
        // get difference of time_start and time_stop
        $time_start = new DateTime($permission["time_start"]);
        $time_stop = new DateTime($permission["time_stop"]);
        $time_diff = $time_start->diff($time_stop);
        $time_spent = $time_diff->format("%H:%i:%s");
        echo $time_spent . "<br>";
        // update overtime
        $overtime = "00:00:00";
        if ($max_time < $time_spent) {
            $overtime = ((new DateTime($max_time))->diff(new DateTime($time_spent)))->format("%H:%i:%s");
        }
        // echo $overtime . "<br>";
        update_overtime($pdo, $permission_id, $overtime);

        $permission = get_permission($pdo, $permission_id);

        if ($permission["overtime"] && $permission["overtime"] != "00:00:00") {
            header("Location: ../../take_permission.php?end_permission=late");
        } else {
            header("Location: ../../take_permission.php?end_permission=true");
        }
        

        // header("Location: ../../take_permission.php?end_permission=true");

        $stmt = null;
        $pdo = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }
} else {
    header("Location: ../../take_permission.php");
    die();
}
