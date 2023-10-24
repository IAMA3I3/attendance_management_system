<?php

require_once "../session_config.php";

require_once "../dbh_inc.php";
require_once "./clockout_model.php";

// record clockout time
clock_out($pdo, $_SESSION["user_id"], $_SESSION["last_id"]);

$stmt = null;
$pdo = null;

session_unset();
session_destroy();

header("Location: ../../index.php");
die();