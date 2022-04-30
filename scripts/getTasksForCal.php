<?php
require_once 'db_connection.php';
require_once 'functions.php';

$projectId = $_SESSION["projectid"];
$data = array();
$query = "SELECT tbl_tasks.id, tbl_tasks.title, tbl_tasks.task_start, tbl_tasks.task_end, tbl_users.user_name, tbl_users.user_surname FROM tbl_tasks LEFT JOIN tbl_users on tbl_users.id = tbl_tasks.assigned_user_id WHERE tbl_tasks.project_id='$projectId';";
// $query = "SELECT * FROM tbl_tasks WHERE project_id = '$projectId' ORDER BY id";
// debug_to_console($query);
$result = mysqli_query(OpenCon(), $query);


foreach ($result as $row) {
    $data[] = array(
        "id" => $row["id"],
        "title" => $row["title"],
        "start" => $row["task_start"],
        "end" => $row["task_end"],
        "user" => $row["user_name"] . " " . $row["user_surname"]
        // "user" => $row["assigned_user_id"]
    );
}

//json format
echo json_encode($data);
