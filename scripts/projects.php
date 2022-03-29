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
}
