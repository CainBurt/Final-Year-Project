<?php
session_start();

//sanitise inputs
function sanitiseInputs($input){
    $input = strip_tags($input);
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
};


//posts a task to the database
function post($conn, $taskTitle, $taskLabelId)
{
    $project = $_SESSION["projectid"];
    $sql = "INSERT INTO tbl_tasks(title, label_id, project_id) VALUES ('$taskTitle', '$taskLabelId', '$project');";

    if (mysqli_query($conn, $sql)) {
        header("location: ../kanban.php?error=none&message=createsuccess");
        exit();
    } else {
        header("location: ../kanban.php?errortasknotadded");
        exit();
    };
};

//edits a task in the database
function updateTask($conn, $taskId, $updatedTitle)
{
    $query = "UPDATE tbl_tasks SET title='$updatedTitle' WHERE id='$taskId';";

    if (mysqli_query($conn, $query)) {
        header("location: ../kanban.php?error=none&message=editsuccess");
        exit();
    } else {
        header("location: ../kanban.php.php?error=tasknotupdated");
        exit();
    };
}

//deletes a task
function deleteTask($conn, $taskId)
{
    $query = "DELETE FROM tbl_tasks WHERE id='$taskId';";
    if (mysqli_query($conn, $query)) {
        header("location: ../kanban.php?error=none&message=deletesuccess");
        exit();
    } else {
        header("location: ../kanban.php.php?error=tasknotdeleted");
        exit();
    };
}

//post project
function saveProject($conn, $projectName, $projectDesc, $projectStart, $projectEnd)
{
    $sql = "INSERT INTO tbl_projects(project_name, project_description, project_start, project_end) VALUES ('$projectName', '$projectDesc', '$projectStart', '$projectEnd');";

    if (mysqli_query($conn, $sql)) {
        header("location: ../projects.php?error=none&message=createprojectsuccess");
        exit();
    } else {
        header("location: ../projects.php?error=projectnotadded");
        exit();
    };
};

//delete project
function deleteProject($conn, $projectId)
{
    $query = "DELETE FROM tbl_projects WHERE id='$projectId';";

    if (mysqli_query($conn, $query)) {
        header("location: ../projects.php?error=none&message=projectdeleted");
        exit();
    } else {
        header("location: ../projects.php?error=projectnotdeleted");
        exit();
    };
};

//edit project
function updateProject($conn, $id, $title, $desc, $start, $end)
{
    $query = "UPDATE tbl_projects SET project_name='$title', project_description='$desc', project_start='$start', project_end='$end' WHERE id='$id';";
    if (mysqli_query($conn, $query)) {
        header("location: ../projects.php?error=none&message=projectupdated");
        exit();
    } else {
        header("location: ../projects.php?error=projectnotupdated");
        exit();
    };
}


