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
    if (!in_array($extension, ['zip', 'pdf', 'png', 'txt', '.doc'])) {
        header("location: " . $_SERVER['HTTP_REFERER'] . "?error=Your file must be a .zip, .pdf .png .txt or .doc");
    } elseif ($_FILES['file']['size'] > 100000) {
        header("location: " . $_SERVER['HTTP_REFERER'] . "?error=Your file is too large");
    } elseif (file_exists($destination)) {
        header("location: " . $_SERVER['HTTP_REFERER'] . "?error=File already exists");
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

if (isset($_GET['del_file_id'])) {
    $id = $_GET['del_file_id'];
    $file = getFileForDownload(OpenCon(), $id);
    $filename = $file["filename"];
    $delPath = $_SERVER['DOCUMENT_ROOT'] . '/fyp/uploads/' . $filename;
    if (unlink($delPath)) {
        deleteFile(OpenCon(), $id);
        CloseCon($conn);
    }
}
