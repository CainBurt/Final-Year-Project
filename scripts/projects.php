<?php
require_once 'db_connection.php';
require_once 'functions.php';
// save project to database
if (isset($_POST["saveProject"])) {
    $projectName = sanitiseInputs($_POST["projectName"]);
    $projectDesc = sanitiseInputs($_POST["projectDesc"]);
    $projectStart = sanitiseInputs($_POST["projectStart"]);
    $projectEnd = sanitiseInputs($_POST["projectEnd"]);
    $creatorId = $_SESSION['user_id'];

    if ($projectStart >= $projectEnd) {
        header("location: ../projects.php?error=invaliddates");
        exit();
    };

    saveProject(OpenCon(), $projectName, $projectDesc, $projectStart, $projectEnd, $creatorId);
    CloseCon($conn);
    exit();
} else if (isset($_POST["saveEditProject"])) {
    $id = $_POST["projectId"];
    $title = $_POST["projectName"];
    $desc = $_POST["projectDesc"];
    $start = $_POST["projectStart"];
    $end = $_POST["projectEnd"];
    if ($start >= $end) {
        header("location: ../projects.php?error=Invalid Dates");
        exit();
    };
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
} else if (isset($_POST["addUserToProject"])) {
    $email = sanitiseInputs($_POST["user-email"]);
    $emailExists = emailExists(OpenCon(), $email);
    $project_id = $_SESSION['projectid'];

    if ($emailExists !== false && userAlreadyAddedToProject($email) !== TRUE) {
        addUserToProject(OpenCon(), $project_id, $emailExists);
        CloseCon($conn);
    } else {
        header("location: ../kanban.php?error=Email Deos Not Exist");
        exit();
    }
} else if (isset($_POST["removeUser"])) {

    $userId = $_POST["userId"];
    $projectId = $_SESSION['projectid'];
    removeUserProject(OpenCon(), $userId, $projectId);
    CloseCon($conn);
} else if (isset($_POST["removeUserFromProject"])) {

    $userId = $_SESSION["user_id"];
    $projectId = $_POST['delUserFromProjectId'];
    leaveProject(OpenCon(), $userId, $projectId);
    CloseCon($conn);
} else {
    function getAllProjects()
    {
        $creatorId = $_SESSION['user_id'];
        $query = "SELECT * FROM tbl_projects WHERE creator_id='$creatorId';";
        $result = mysqli_query(OpenCon(), $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $projects[] = $row;
            }
            return $projects;
        }
    }

    function getAllUsersInProject()
    {
        $project_id = $_SESSION['projectid'];
        $query = "SELECT * FROM tbl_users INNER JOIN usersaddedtoprojects ON usersaddedtoprojects.user_id = tbl_users.id WHERE project_id='$project_id';";
        $result = mysqli_query(OpenCon(), $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
            return $users;
        }
    }

    function getAddedToProjects()
    {
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM tbl_projects INNER JOIN usersaddedtoprojects ON usersaddedtoprojects.project_id = tbl_projects.id WHERE user_id='$user_id';";
        $result = mysqli_query(OpenCon(), $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
            return $users;
        }
    }

    function userCreatedCurrentProject()
    {

        // get current project
        $project_id = $_SESSION['projectid'];
        // get current user
        $user_id = $_SESSION['user_id'];
        // check if curent user created current project
        $query = "SELECT * FROM tbl_projects WHERE id='$project_id' AND creator_id='$user_id';";
        $result = mysqli_query(OpenCon(), $query);

        if (mysqli_num_rows($result) !== 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
