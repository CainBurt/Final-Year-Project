<?php
//posts a task to the database
function post($conn, $taskTitle, $taskLabelId)
{

    $sql = "INSERT INTO tbl_tasks(title, label_id) VALUES ('$taskTitle', '$taskLabelId');";

    if (mysqli_query($conn, $sql)) {
        header("location: ../kanban.php?error=none&message=createsuccess");
        exit();
    } else {
        header("location: ../kanban.php?errortasknotadded");
        exit();
    };
};
