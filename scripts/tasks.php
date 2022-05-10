<?php
require_once 'db_connection.php';
require_once 'functions.php';


if (isset($_POST["saveTask"])) {

    $taskTitle = $_POST["task"];
    $taskLabelId = $_POST["list"];
    $startDate = $_POST["start"];
    $endDate = $_POST["end"];

    if ($startDate >= $endDate) {
        header("location: ../kanban.php?error=Invalid Dates");
        exit();
    };

    createTask(OpenCon(), $taskTitle, $taskLabelId, $startDate, $endDate);
    CloseCon($conn);
    exit();
} elseif (isset($_POST["editTask"])) {

    $taskId = $_POST["task-id"];
    $updatedTitle = $_POST["task-title"];
    $startDate = $_POST["task-start"];
    $endDate = $_POST["task-end"];

    if ($startDate >= $endDate) {
        header("location: ../kanban.php?error=Invalid Dates");
        exit();
    };

    updateTask(OpenCon(), $taskId, $updatedTitle, $startDate, $endDate);
    CloseCon($conn);
    exit();
} elseif (isset($_POST["deleteTask"])) {
    $taskId = $_POST["task-id"];
    deleteTask(OpenCon(), $taskId);
    CloseCon($conn);
} elseif (isset($_POST["createSubtask"])) {
    $taskId = sanitiseInputs($_POST["task-id"]);
    $subtask = sanitiseInputs($_POST["subtaskname"]);
    createSubtask(OpenCon(), $taskId, $subtask);
    CloseCon($conn);
} elseif (isset($_POST["editSubtask"])) {

    $taskId = $_POST["task-id"];
    $updatedTitle = $_POST["task-title"];
    updateSubtask(OpenCon(), $taskId, $updatedTitle);
    CloseCon($conn);
    exit();
} elseif (isset($_POST["deleteSubtask"])) {
    $taskId = $_POST["task-id"];
    deleteSubtask(OpenCon(), $taskId);
    CloseCon($conn);
} elseif (isset($_POST["changeUser"])) {
    $taskId = $_POST["task-id"];
    $userId = $_POST["user"];

    changeUserInTask(OpenCon(), $taskId, $userId);
    CloseCon($conn);
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
        $project = $_SESSION["projectid"];
        $query = "SELECT * FROM tbl_tasks WHERE label_id=$labelId AND project_id=$project";
        $result = mysqli_query(OpenCon(), $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tasks[] = $row;
            }
            return $tasks;
        }
    }

    function editTaskLabel($label_Id, $task_Id)
    {
        $query = "UPDATE tbl_tasks SET label_id=$label_Id WHERE id=$task_Id";
        $result = mysqli_query(OpenCon(), $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tasks[] = $row;
            }
            return $tasks;
        }
    }

    function getSubtasksByTaskId($task_Id)
    {
        $query = "SELECT * FROM tbl_subtasks WHERE task_id=$task_Id";
        $result = mysqli_query(OpenCon(), $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $subtasks[] = $row;
            }
            return $subtasks;
        }
    }

    function editSubtaskStatus($status, $subtask_Id)
    {
        $query = "UPDATE tbl_subtasks SET sub_status='$status' WHERE id='$subtask_Id';";
        $result = mysqli_query(OpenCon(), $query);
        debug_to_console($result);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tasks[] = $row;
            }
            return $tasks;
        }
    }
};
