<?php
require_once 'db_connection.php';
require_once 'functions.php';

if (isset($_POST['postDiscussion'])) {

    $content = sanitiseInputs($_POST["postcontent"]);
    createDiscussion(OpenCon(), $content);
    CloseCon($conn);
    exit();
}

if (isset($_POST['postReply'])) {

    $content = sanitiseInputs($_POST["postcontent"]);
    $discussionId = $_POST["discussionid"];
    createReply(OpenCon(), $content, $discussionId);
    CloseCon($conn);
    exit();
}
