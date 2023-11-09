<?php

require_once "../session_config.php";

if (isset($_SESSION["permission_to_edit"])) {
    unset($_SESSION["permission_to_edit"]);
}

header("Location: ../../manage_permissions.php");
die();