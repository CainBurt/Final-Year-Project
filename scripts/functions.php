<?php
session_start();

// print to console
function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

//sanitise inputs
function sanitiseInputs($input)
{
    $input = strip_tags($input);
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
};


//posts a task to the database
function createTask($conn, $taskTitle, $taskLabelId, $start, $end)
{
    $project = $_SESSION["projectid"];
    $sql = "INSERT INTO tbl_tasks(title, label_id, task_start, task_end, project_id) VALUES ('$taskTitle', '$taskLabelId', '$start', '$end', '$project');";

    if (mysqli_query($conn, $sql)) {
        // header("location: ../kanban.php?error=none&message=createsuccess");
        header("location: " . $_SERVER['HTTP_REFERER'] . "?error=none&message=createsuccess");
        exit();
    } else {
        header("location: ../kanban.php?errortasknotadded");
        exit();
    };
};

//edits a task in the database
function updateTask($conn, $taskId, $updatedTitle, $start, $end)
{
    $query = "UPDATE tbl_tasks SET title='$updatedTitle', task_start='$start', task_end='$end' WHERE id='$taskId';";

    if (mysqli_query($conn, $query)) {
        // header("location: ../kanban.php?error=none&message=editsuccess");
        header("location: " . $_SERVER['HTTP_REFERER'] . "?error=none&message=editsuccess");
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
        // header("location: ../kanban.php?error=none&message=deletesuccess");
        header("location: " . $_SERVER['HTTP_REFERER'] . "?error=none&message=deletesuccess");
        exit();
    } else {
        header("location: ../kanban.php.php?error=tasknotdeleted");
        exit();
    };
}

//post project
function saveProject($conn, $projectName, $projectDesc, $projectStart, $projectEnd, $creatorId)
{
    $sql = "INSERT INTO tbl_projects(project_name, project_description, project_start, project_end, creator_id) VALUES ('$projectName', '$projectDesc', '$projectStart', '$projectEnd', '$creatorId');";

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

// check if email is in database
function emailExists($conn, $email)
{
    $query = "SELECT * FROM tbl_users WHERE user_email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        header("location: ../?error=stmtfailed");
        exit();
    };
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        //add some stuff here when get to login
        return $row;
    } else {
        $result = false;
        return $result;
    };

    mysqli_stmt_close($stmt);
};

//checks the two fields match
function passwordMatch($password, $confirmPassword)
{

    if ($password !== $confirmPassword) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
};

// create account
function createUser($conn, $name, $surname, $email, $password)
{
    if (emailExists($conn, $email) !== false) {
        header("location: ../?error=emailtaken");
        exit();
    }

    // hash password
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO tbl_users(user_name, user_surname, user_email, user_password) VALUES ('$name', '$surname', '$email', '$hash');";
    if (mysqli_query($conn, $query)) {
        header("location: ../?error=none&message=accountcreated");
        exit();
    } else {
        header("location: ../?error=couldnotcreateaccount");
        exit();
    };
}


// login
function loginUser($conn, $email, $password)
{

    // check email exists
    $emailExists = emailExists($conn, $email);
    if ($emailExists === false) {
        header("location: ../?error=emailisfalse");
    };

    // check password matches hashed password
    $userPassword = $emailExists["user_password"];
    $checkpassword = password_verify($password, $userPassword);

    if ($checkpassword === false) {

        header("location: ../?error=passwordisfalse");
    } else if ($checkpassword == true) {

        session_start();
        $_SESSION["user_id"] = $emailExists["id"];
        header("location: ../projects.php");
        exit();
    };
}

// add a user to a project
function addUserToProject($conn, $project_id, $userData)
{
    $user_id = $userData["id"];

    // TODO a check to make sure a user isnt already added.
    $query = "INSERT INTO usersaddedtoprojects(user_id, project_id) VALUES ('$user_id', '$project_id');";
    if (mysqli_query($conn, $query)) {
        header("location: ../projectsettings.php?error=none&message=useradded");
        exit();
    } else {
        header("location: ../?error=couldnotadduser");
        exit();
    };
}

// remove user from a project in project settings page
function removeUserProject($conn, $userId, $projectId)
{
    $query = "DELETE FROM usersaddedtoprojects WHERE project_id='$projectId' AND user_id = '$userId';";
    if (mysqli_query($conn, $query)) {
        header("location: ../projectsettings.php?error=none&message=userremoved");
        exit();
    } else {
        header("location: ../projectsettings.php?error=couldnotremoveuser");
        exit();
    };
}

// leave a project from projects page
function leaveProject($conn, $userId, $projectId)
{
    $query = "DELETE FROM usersaddedtoprojects WHERE project_id='$projectId' AND user_id = '$userId';";
    if (mysqli_query($conn, $query)) {
        header("location: ../projects.php?error=none&message=userremoved");
        exit();
    } else {
        header("location: ../projects.php?error=couldnotremoveuser");
        exit();
    };
}

// create subtask
function createSubtask($conn, $taskId, $subtask)
{
    $query = "INSERT INTO tbl_subtasks(sub_name, sub_status, task_id) VALUES ('$subtask', 0 , '$taskId');";

    if (mysqli_query($conn, $query)) {
        header("location: ../tasks.php?error=none&message=createsubtasksuccess");
        exit();
    } else {
        header("location: ../tasks.php?errorsubtasknotadded");
        exit();
    };
}

//edits subtask
function updateSubtask($conn, $taskId, $updatedTitle)
{
    $query = "UPDATE tbl_subtasks SET sub_name='$updatedTitle' WHERE id='$taskId';";

    if (mysqli_query($conn, $query)) {
        header("location: ../tasks.php?error=none&message=editsuccess");
        exit();
    } else {
        header("location: ../tasks.php.php?error=tasknotupdated");
        exit();
    };
}

//deletes subtask
function deleteSubtask($conn, $taskId)
{
    $query = "DELETE FROM tbl_subtasks WHERE id='$taskId';";
    if (mysqli_query($conn, $query)) {
        header("location: ../tasks.php?error=none&message=deletesuccess");
        exit();
    } else {
        header("location: ../tasks.php?error=tasknotdeleted");
        exit();
    };
}

//changes user assigned to a task
function changeUserInTask($conn, $taskId, $userId)
{
    if ($userId == "NULL") {
        $userId = NULL;
    }
    $query = "UPDATE tbl_tasks SET assigned_user_id='$userId' WHERE id='$taskId';";

    if (mysqli_query($conn, $query)) {
        header("location: ../tasks.php?error=none&message=changeusersuccess");
        exit();
    } else {
        header("location: ../tasks.php.php?error=changeusernotupdated");
        exit();
    };
}

// get currently logged in users details
function currentDetails()
{
    $user = $_SESSION["user_id"];
    $query = "SELECT user_name, user_surname, user_email FROM tbl_users WHERE id = '$user';";
    $result = mysqli_query(OpenCon(), $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $userdata[] = $row;
            debug_to_console($row);
        }
        return $userdata;
    }
}

function changeUserName($conn, $id, $name, $surname)
{
    $query = "UPDATE tbl_users SET user_name='$name', user_surname='$surname' WHERE id='$id';";
    if (mysqli_query($conn, $query)) {
        header("location: ../profile.php?error=none&message=namechangesuccess");
        exit();
    } else {
        header("location: ../profile.php.php?error=changeusernamenotupdated");
        exit();
    };
}

function changeUserEmail($conn, $id, $email)
{
    $query = "UPDATE tbl_users SET user_email='$email' WHERE id='$id';";
    if (mysqli_query($conn, $query)) {
        header("location: ../profile.php?error=none&message=emailchangesuccess");
        exit();
    } else {
        header("location: ../profile.php.php?error=changeuseremailnotupdated");
        exit();
    };
}

function changeUserPassword($conn, $id, $password)
{
    // hash password
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE tbl_users SET user_password='$hash' WHERE id='$id';";
    if (mysqli_query($conn, $query)) {
        header("location: ../profile.php?error=none&message=passwordchangesuccess");
        exit();
    } else {
        header("location: ../profile.php.php?error=changeuserpasswordnotupdated");
        exit();
    };
}

function deleteUserAccount($conn, $id)
{
    $query = "DELETE FROM tbl_users WHERE id='$id';";
    if (mysqli_query($conn, $query)) {
        header("location: ../index.php?error=none&message=accountdeletesuccess");
        exit();
    } else {
        header("location: ../profile.php?error=couldnotdeleteaccount");
        exit();
    };
}

// check user isnt currently in the project or the project creator.
function userAlreadyAddedToProject($email)
{
    $project_id = $_SESSION['projectid'];
    $query = "SELECT * FROM tbl_users INNER JOIN usersaddedtoprojects ON usersaddedtoprojects.user_id = tbl_users.id WHERE project_id='$project_id' AND user_email='$email';";
    $result = mysqli_query(OpenCon(), $query);
    if (mysqli_num_rows($result) > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
};

function userCreatedProject($projectId, $email)
{
    // $query = "SELECT * FROM tbl_projects WHERE id='$project_id' AND creator_id='$user_id';";
    $query = "SELECT * FROM tbl_projects INNER JOIN tbl_users on tbl_users.id = tbl_projects.creator_id WHERE tbl_projects.id='$projectId' AND user_email='$email';";
    $result = mysqli_query(OpenCon(), $query);

    if (mysqli_num_rows($result) == 1) {
        // echo "User Did created project"
        return TRUE;
    } else {
        return FALSE;
        // echo "User didnt Created Project";
    }
}

// upload file function
function uploadFile($conn, $filename, $size, $projectId, $uploader_id)
{
    $query = "INSERT INTO tbl_files (filename, filesize, uploader_id, project_id) VALUES ('$filename', '$size', '$uploader_id', '$projectId')";
    if (mysqli_query($conn, $query)) {
        header("location: ../files.php?error=none&message=uploadedfile");
        exit();
    } else {
        header("location: ../files.php?error=couldnotuploadfile");
        exit();
    };
}

// get all files for the current project
function getAllFiles()
{
    $project_id = $_SESSION['projectid'];
    $query = "SELECT * FROM tbl_files WHERE project_id = '$project_id';";
    $result = mysqli_query(OpenCon(), $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $filesData[] = $row;
        }
        return $filesData;
    }
}

function getFileForDownload($conn, $id)
{
    $query = "SELECT * FROM tbl_files WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $file = mysqli_fetch_assoc($result);
    return $file;
}

function deleteFile($conn, $id)
{
    $query = "DELETE FROM tbl_files WHERE id='$id';";
    if (mysqli_query($conn, $query)) {
        header("location: ../fyp/files.php?error=none&message=deletesuccess");
        exit();
    } else {
        header("location: ../files.php?error=filenotdeleted");
        exit();
    };
}
