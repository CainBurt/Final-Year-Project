<?php
require_once 'db_connection.php';
require_once 'functions.php';

$projectId = $_SESSION["projectid"];
$data = array();
$query = "SELECT * FROM tbl_tasks WHERE project_id = '$projectId' ORDER BY id";

$result = mysqli_query(OpenCon(), $query);

foreach ($result as $row) {
    $data[] = array(
        "id" => $row["id"],
        "title" => $row["title"],
        "start" => $row["task_start"],
        "end" => $row["task_end"]
    );
}

//json format
echo json_encode($data);
