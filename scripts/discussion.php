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

if (isset($_GET['del_post_id'])) {
    $id = $_GET['del_post_id'];
    deleteDiscussion(OpenCon(), $id);
    CloseCon($conn);
}

if (isset($_GET['del_reply_id'])) {
    $id = $_GET['del_reply_id'];
    deleteReply(OpenCon(), $id);
    CloseCon($conn);
}
