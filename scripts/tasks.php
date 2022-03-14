<?php
require_once 'db_connection.php';

if (isset($_POST["saveTask"])) {
    require_once 'functions.php';
    $taskTitle = $_POST["task"];
    $taskLabelId = $_POST["list"];
    post(OpenCon(), $taskTitle, $taskLabelId);
    CloseCon($conn);
    exit();
} else {
    function getAllLabels()
    {
        $query = "SELECT * FROM tbl_labels";
        $result = mysqli_query(OpenCon(), $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $labels[] = $row;
            }
            return $labels;
        }
    }

    function getTasksByLabel($labelId)
    {
        $query = "SELECT * FROM tbl_tasks WHERE label_id=$labelId";
        $result = mysqli_query(OpenCon(), $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tasks[] = $row;
            }
            return $tasks;
        }
    }
};
