<?php

require_once "../session_config.php";

if (isset($_SESSION["site_to_edit"])) {
    unset($_SESSION["site_to_edit"]);
}

header("Location: ../../manage_site.php");
die();