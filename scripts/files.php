<?php
require_once 'db_connection.php';
require_once 'functions.php';

if (isset($_POST['uploadFile'])) {
    $filename = $_FILES['file']['name'];
    $destination = $_SERVER['DOCUMENT_ROOT'] . '/fyp/uploads/' . $filename;

    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $file = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];
    $projectId = $_SESSION['projectid'];
    $uploader_id = $_SESSION['user_id'];

    // check file format
    if (!in_array($extension, ['zip', 'pdf', 'png', 'txt'])) {
        echo "Your file must be a .zip, .pdf .png or .txt";
    } elseif ($_FILES['file']['size'] > 100000) { //check file size
        echo "Your file is too large";
    } else {
        if (move_uploaded_file($file, $destination)) {
            uploadFile(OpenCon(), $filename, $size, $projectId, $uploader_id);
            CloseCon($conn);
        }
    }
}

if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];
    $file = getFileForDownload(OpenCon(), $id);
    // CloseCon($conn);
    $filepath = $_SERVER['DOCUMENT_ROOT'] . '/fyp/uploads/' . $file['filename'];

    if (file_exists($filepath)) {
        header('Content-Type: application/octet-stream');
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($_SERVER['DOCUMENT_ROOT'] . '/fyp/uploads/' . $file['name']));

        readfile($_SERVER['DOCUMENT_ROOT'] . '/fyp/uploads/' . $file['name']);
        exit();
    }
}
