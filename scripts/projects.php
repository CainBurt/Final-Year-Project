<?php
require_once 'db_connection.php';
require_once 'functions.php';

// save project to database
if (isset($_POST["saveProject"])) {
    $projectName = $_POST["projectName"];
    $projectDesc = $_POST["projectDesc"];
    $projectStart = $_POST["projectStart"];
    $projectEnd = $_POST["projectEnd"];

    saveProject(OpenCon(), $projectName, $projectDesc, $projectStart, $projectEnd);
    CloseCon($conn);
    exit();
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
