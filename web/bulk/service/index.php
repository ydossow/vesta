<?php
// Init
error_reporting(NULL);
ob_start();
session_start();

include($_SERVER['DOCUMENT_ROOT']."/inc/main.php");

$service = $_POST['service'];
$action = $_POST['action'];

if ($_SESSION['user'] == 'admin') {
    switch ($action) {
        case 'stop': $cmd='v-stop-service';
            break;
        case 'start': $cmd='v-start-service';
            break;
        case 'restart': $cmd='v-restart-service';
            break;
        default: header("Location: /list/services/"); exit;
    }
    foreach ($service as $value) {
        $value = escapeshellarg($value);
        exec (VESTA_CMD.$cmd." ".$value, $output, $return_var);
    }
}

header("Location: /list/services/");
