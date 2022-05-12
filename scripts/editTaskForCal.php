<?php
//updates the task dates on drag and drop or move task in the calendar
require_once 'db_connection.php';
require_once 'functions.php';

$projectId = $_SESSION["projectid"];

if (isset($_POST['id'])) {
    $taskId = $_POST["id"];
    $title = $_POST["title"];
    $start = $_POST["start"];
    $end = $_POST["end"];
    debug_to_console($taskId . $title . $start . $end);
    updateTask(OpenCon(), $taskId, $title, $start, $end);
    Closecon($conn);
}
