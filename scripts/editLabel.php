<?php
// for changing the label on kanban drag and drop
require "tasks.php";

$label_id = $_GET["label_id"];
$task_id = $_GET["task_id"];

$result = editTaskLabel($label_id, $task_id);
