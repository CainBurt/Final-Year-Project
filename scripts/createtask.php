<?php

if (isset($_POST["saveTask"])) {
    require_once 'db_connection.php';
    require_once 'functions.php';
    $taskLabel = $_POST["list"];
    $taskTitle = $_POST["task"];

    post(OpenCon(), $taskLabel, $taskTitle);
    CloseCon($conn);
    exit();
} else {
    header("location: ../tasks.php");
    exit();
};
