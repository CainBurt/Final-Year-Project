<?php
//posts a task to the database
function post($conn, $taskLabel, $taskTitle)
{

    $sql = "INSERT INTO tasks(taskLabel, taskTitle) VALUES ('$taskLabel', '$taskTitle');";

    if (mysqli_query($conn, $sql)) {
        header("location: ../tasks.php?error=none&message=createsuccess");
        exit();
    } else {
        header("location: ../tasks.php?error=postnotadded");
        exit();
    };
};
