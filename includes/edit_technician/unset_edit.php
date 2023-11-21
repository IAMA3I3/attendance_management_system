<?php

require_once "../session_config.php";

if (isset($_SESSION["technician_to_edit"])) {
    unset($_SESSION["technician_to_edit"]);
}

header("Location: ../../admin_dashboard.php");
die();