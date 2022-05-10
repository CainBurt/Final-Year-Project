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
        header("location: " . $_SERVER['HTTP_REFERER'] . "?message=createsuccess");
        exit();
    } else {
        header("location: ../kanban.php?error=Task Not Added");
        exit();
    };
};

//edits a task in the database
function updateTask($conn, $taskId, $updatedTitle, $start, $end)
{
    $query = "UPDATE tbl_tasks SET title='$updatedTitle', task_start='$start', task_end='$end' WHERE id='$taskId';";

    if (mysqli_query($conn, $query)) {
        // header("location: ../kanban.php?error=none&message=editsuccess");
        header("location: " . $_SERVER['HTTP_REFERER'] . "?message=editsuccess");
        exit();
    } else {
        header("location: ../kanban.php.php?error=Task Not Updated");
        exit();
    };
}

//deletes a task
function deleteTask($conn, $taskId)
{
    $query = "DELETE FROM tbl_tasks WHERE id='$taskId';";
    if (mysqli_query($conn, $query)) {
        // header("location: ../kanban.php?error=none&message=deletesuccess");
        header("location: " . $_SERVER['HTTP_REFERER'] . "?message=deletesuccess");
        exit();
    } else {
        header("location: ../kanban.php.php?error=Task Not Deleted");
        exit();
    };
}

//post project
function saveProject($conn, $projectName, $projectDesc, $projectStart, $projectEnd, $creatorId)
{
    $sql = "INSERT INTO tbl_projects(project_name, project_description, project_start, project_end, creator_id) VALUES ('$projectName', '$projectDesc', '$projectStart', '$projectEnd', '$creatorId');";

    if (mysqli_query($conn, $sql)) {
        $GET_last_ID = mysqli_insert_id($conn);
        addUserToProjectOnCreate($conn, $GET_last_ID, $creatorId);
        // header("location: ../projects.php?error=none&message=createprojectsuccess");
        exit();
    } else {
        header("location: ../projects.php?error=Project Not Created");
        exit();
    };
};

//delete project
function deleteProject($conn, $projectId)
{
    $query = "DELETE FROM tbl_projects WHERE id='$projectId';";

    if (mysqli_query($conn, $query)) {
        header("location: ../projects.php?message=projectdeleted");
        exit();
    } else {
        header("location: ../projects.php?error=Project Not Deleted");
        exit();
    };
};

//edit project
function updateProject($conn, $id, $title, $desc, $start, $end)
{
    $query = "UPDATE tbl_projects SET project_name='$title', project_description='$desc', project_start='$start', project_end='$end' WHERE id='$id';";
    if (mysqli_query($conn, $query)) {
        header("location: ../projects.php?message=projectupdated");
        exit();
    } else {
        header("location: ../projects.php?error=Project Not Updated");
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
        header("location: ../?message=accountcreated");
        exit();
    } else {
        header("location: ../?error=Could Not Create Account");
        exit();
    };
}


// login
function loginUser($conn, $email, $password)
{

    // check email exists
    $emailExists = emailExists($conn, $email);
    if ($emailExists === false) {
        header("location: ../?error=Email and Password Combination Does not Exist");
    };

    // check password matches hashed password
    $userPassword = $emailExists["user_password"];
    $checkpassword = password_verify($password, $userPassword);

    if ($checkpassword === false) {

        header("location: ../?error=Email and Password Combination Does not Exist");
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
        header("location: ../projectsettings.php?message=useradded");
        exit();
    } else {
        header("location: ../?error=Could Not Add User");
        exit();
    };
}

// add a user to a project when project is created
function addUserToProjectOnCreate($conn, $project_id, $user_id)
{
    $query = "INSERT INTO usersaddedtoprojects(user_id, project_id) VALUES ('$user_id', '$project_id');";
    if (mysqli_query($conn, $query)) {
        header("location: ../projects.php?message=useradded");
        exit();
    } else {
        header("location: ../?error=Could Not Add User");
        exit();
    };
}

// remove user from a project in project settings page
function removeUserProject($conn, $userId, $projectId)
{
    $query = "DELETE FROM usersaddedtoprojects WHERE project_id='$projectId' AND user_id = '$userId';";
    if (mysqli_query($conn, $query)) {
        header("location: ../projectsettings.php?message=userremoved");
        exit();
    } else {
        header("location: ../projectsettings.php?error=Could Not Remove User");
        exit();
    };
}

// leave a project from projects page
function leaveProject($conn, $userId, $projectId)
{
    $query = "DELETE FROM usersaddedtoprojects WHERE project_id='$projectId' AND user_id = '$userId';";
    if (mysqli_query($conn, $query)) {
        header("location: ../projects.php?message=userremoved");
        exit();
    } else {
        header("location: ../projects.php?error=Could Not Remove User");
        exit();
    };
}

// create subtask
function createSubtask($conn, $taskId, $subtask)
{
    $query = "INSERT INTO tbl_subtasks(sub_name, sub_status, task_id) VALUES ('$subtask', 0 , '$taskId');";

    if (mysqli_query($conn, $query)) {
        header("location: ../tasks.php?message=createsubtasksuccess");
        exit();
    } else {
        header("location: ../tasks.php?error=Subtask Not Added");
        exit();
    };
}

//edits subtask
function updateSubtask($conn, $taskId, $updatedTitle)
{
    $query = "UPDATE tbl_subtasks SET sub_name='$updatedTitle' WHERE id='$taskId';";

    if (mysqli_query($conn, $query)) {
        header("location: ../tasks.php?message=editsuccess");
        exit();
    } else {
        header("location: ../tasks.php.php?error=Task Not Updated");
        exit();
    };
}

//deletes subtask
function deleteSubtask($conn, $taskId)
{
    $query = "DELETE FROM tbl_subtasks WHERE id='$taskId';";
    if (mysqli_query($conn, $query)) {
        header("location: ../tasks.php?message=deletesuccess");
        exit();
    } else {
        header("location: ../tasks.php?error=Task Not Deleted");
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
        header("location: ../tasks.php?message=changeusersuccess");
        exit();
    } else {
        header("location: ../tasks.php.php?error=Change User Not Updated");
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
        header("location: ../profile.php?message=namechangesuccess");
        exit();
    } else {
        header("location: ../profile.php.php?error=Change User Name Not Updated");
        exit();
    };
}

function changeUserEmail($conn, $id, $email)
{
    $query = "UPDATE tbl_users SET user_email='$email' WHERE id='$id';";
    if (mysqli_query($conn, $query)) {
        header("location: ../profile.php?message=emailchangesuccess");
        exit();
    } else {
        header("location: ../profile.php.php?error=Change User Email Not Updated");
        exit();
    };
}

function changeUserPassword($conn, $id, $password)
{
    // hash password
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE tbl_users SET user_password='$hash' WHERE id='$id';";
    if (mysqli_query($conn, $query)) {
        header("location: ../profile.php?message=passwordchangesuccess");
        exit();
    } else {
        header("location: ../profile.php.php?error=Change User Password Not Updated");
        exit();
    };
}

function deleteUserAccount($conn, $id)
{
    $query = "DELETE FROM tbl_users WHERE id='$id';";
    if (mysqli_query($conn, $query)) {
        header("location: ../index.php?message=accountdeletesuccess");
        exit();
    } else {
        header("location: ../profile.php?error=Could Not Delete Account");
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

function userCreatedProjectById($projectId, $id)
{
    // $query = "SELECT * FROM tbl_projects WHERE id='$project_id' AND creator_id='$user_id';";
    $query = "SELECT * FROM tbl_projects INNER JOIN tbl_users on tbl_users.id = tbl_projects.creator_id WHERE tbl_projects.id='$projectId' AND tbl_users.id='$id';";
    $result = mysqli_query(OpenCon(), $query);

    if (mysqli_num_rows($result) >= 1) {
        // echo "User Did created project"
        return TRUE;
    } else {
        return FALSE;
        // echo "User didnt Created Project";
    }
}

function createdCurrentProject($userid)
{

    // get current project
    $project_id = $_SESSION['projectid'];

    // check if curent user created current project
    $query = "SELECT * FROM tbl_projects WHERE id='$project_id' AND creator_id='$userid';";
    $result = mysqli_query(OpenCon(), $query);

    if (mysqli_num_rows($result) !== 0) {
        // echo "User Did Not create project"
        return TRUE;
    } else {
        return FALSE;
        // echo "User Created Project";
    }
}

// upload file function
function uploadFile($conn, $filename, $size, $projectId, $uploader_id)
{
    $query = "INSERT INTO tbl_files (filename, filesize, uploader_id, project_id) VALUES ('$filename', '$size', '$uploader_id', '$projectId')";
    if (mysqli_query($conn, $query)) {
        header("location: ../files.php?message=uploadedfile");
        exit();
    } else {
        header("location: ../files.php?error=Could Not Upload File");
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
        header("location: ../fyp/files.php?message=deletesuccess");
        exit();
    } else {
        header("location: ../files.php?error=File Not Deleted");
        exit();
    };
}

function createDiscussion($conn, $content)
{
    $userId = $_SESSION["user_id"];
    $project = $_SESSION["projectid"];
    $sql = "INSERT INTO tbl_discussion(dis_content, project_id, creator_id) VALUES ('$content', '$project', '$userId');";

    if (mysqli_query($conn, $sql)) {
        header("location: " . $_SERVER['HTTP_REFERER'] . "?message=createpostsuccess");
        exit();
    } else {
        header("location: ../discussion.php?error= Post Could Not be Created");
        exit();
    };
}

function getAllDiscussions()
{
    $project_id = $_SESSION['projectid'];
    $query = "SELECT tbl_discussion.id, dis_content, project_id, creator_id, user_name, user_surname FROM tbl_discussion INNER JOIN tbl_users on  tbl_discussion.creator_id = tbl_users.id WHERE project_id = '$project_id';";
    $result = mysqli_query(OpenCon(), $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $discussionData[] = $row;
        }
        return $discussionData;
    }
}

function createReply($conn, $content, $discussionId)
{
    $userId = $_SESSION["user_id"];
    $sql = "INSERT INTO tbl_reply(reply_content, discussion_id, creator_id) VALUES ('$content', '$discussionId', '$userId');";

    if (mysqli_query($conn, $sql)) {
        header("location: " . $_SERVER['HTTP_REFERER'] . "?message=createpostsuccess");
        exit();
    } else {
        header("location: ../discussion.php?error= Reply Could not be Created");
        exit();
    };
}

function getAllReply($discussionId)
{
    $query = "SELECT tbl_reply.id, reply_content, discussion_id, creator_id, user_name, user_surname FROM tbl_reply INNER JOIN tbl_users on  tbl_reply.creator_id = tbl_users.id WHERE discussion_id = '$discussionId';";
    $result = mysqli_query(OpenCon(), $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $discussionData[] = $row;
        }
        return $discussionData;
    }
}

function deleteDiscussion($conn, $id)
{
    $query = "DELETE FROM tbl_discussion WHERE id='$id';";
    if (mysqli_query($conn, $query)) {
        header("location: " . $_SERVER['HTTP_REFERER'] . "?message=createpostsuccess");
        exit();
    } else {
        header("location: ../fyp/discussion.php?error=Post Could Not be Deleted");
        exit();
    };
}

function deleteReply($conn, $id)
{
    $query = "DELETE FROM tbl_reply WHERE id='$id';";
    if (mysqli_query($conn, $query)) {
        header("location: " . $_SERVER['HTTP_REFERER'] . "?message=createpostsuccess");
        exit();
    } else {
        header("location: ../fyp/discussion.php?error=Reply Could Not be Deletd");
        exit();
    };
}

function getUserNameById($id)
{
    $query = "SELECT user_name, user_surname FROM tbl_users WHERE id='$id'";
    $result = mysqli_query(OpenCon(), $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $userName[] = $row;
        }
        return $userName;
    }
}
