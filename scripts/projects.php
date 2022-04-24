<?php
require_once 'db_connection.php';
require_once 'functions.php';

// save project to database
if (isset($_POST["saveProject"])) {
    $projectName = sanitiseInputs($_POST["projectName"]);
    $projectDesc = sanitiseInputs($_POST["projectDesc"]);
    $projectStart = sanitiseInputs($_POST["projectStart"]);
    $projectEnd = sanitiseInputs($_POST["projectEnd"]);

    saveProject(OpenCon(), $projectName, $projectDesc, $projectStart, $projectEnd);
    CloseCon($conn);
    exit();
} else if (isset($_POST["saveEditProject"])) {
    $id = $_POST["projectId"];
    $title = $_POST["projectName"];
    $desc = $_POST["projectDesc"];
    $start = $_POST["projectStart"];
    $end = $_POST["projectEnd"];
    updateProject(OpenCon(), $id, $title, $desc, $start, $end);
    CloseCon($conn);
} else if (isset($_POST["deleteProject"])) {

    $projectId = $_POST["delProjectId"];
    deleteProject(OpenCon(), $projectId);
    CloseCon($conn);
} else if (isset($_GET["projectid"])) { //starts session with project variables
    session_start();
    $_SESSION['projectid'] = $_GET["projectid"];
    $_SESSION['projectname'] = $_GET["projectname"];
    header("location: ../kanban.php?projectvarinsession");
} else {
    function getAllProjects()
    {
        $query = "SELECT * FROM tbl_projects";
        $result = mysqli_query(OpenCon(), $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $projects[] = $row;
            }
            return $projects;
        }
    }
}

if (isset($_DELETE["deleteProject"])) {
    echo "DLETE THIS PROJECT?";
}
