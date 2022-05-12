<?php
// edits the task status on checkbox click
require "tasks.php";

$task_status = $_GET["status"];
$subtask_id = $_GET["subtask_id"];
$result = editSubtaskStatus($task_status, $subtask_id);
