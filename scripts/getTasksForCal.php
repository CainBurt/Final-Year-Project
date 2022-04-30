<?php
require_once 'db_connection.php';
require_once 'functions.php';

$projectId = $_SESSION["projectid"];
$data = array();
$query = "SELECT * FROM tbl_tasks LEFT JOIN tbl_users on tbl_tasks.assigned_user_id = tbl_users.id AND tbl_tasks.project_id='$projectId';";
// $query = "SELECT * FROM tbl_tasks WHERE project_id = '$projectId' ORDER BY id";
$result = mysqli_query(OpenCon(), $query);

foreach ($result as $row) {
    $data[] = array(
        "id" => $row["id"],
        "title" => $row["title"],
        "start" => $row["task_start"],
        "end" => $row["task_end"],
        "user" => $row["user_name"] . " " . $row["user_surname"]
    );
}

//json format
echo json_encode($data);
