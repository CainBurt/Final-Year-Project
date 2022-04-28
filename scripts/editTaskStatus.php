<?php
require "tasks.php";

$task_status = $_GET["status"];
$subtask_id = $_GET["subtask_id"];
$result = editSubtaskStatus($task_status, $subtask_id);
