<?php
require_once 'db_connection.php';
require_once 'functions.php';

if (isset($_POST["createAccount"])) {
    $name = sanitiseInputs($_POST["registerName"]);
    $surname = sanitiseInputs($_POST["registerSurname"]);
    $email = sanitiseInputs($_POST["registerEmail"]);
    $password = sanitiseInputs($_POST["registerPassword"]);
    $confirmPassword = sanitiseInputs($_POST["registerConfirmPassword"]);

    debug_to_console($password, $confirmPassword);

    // check passwords match
    if (passwordMatch($password, $confirmPassword) !== false) {
        header("location: ../index.php?error=Passwords Do Not Match");
        exit();
    };

    createUser(OpenCon(), $name, $surname, $email, $password);
    CloseCon($conn);
} elseif (isset($_POST["login"])) {
    $email = sanitiseInputs($_POST["loginEmail"]);
    $password = sanitiseInputs($_POST["loginPassword"]);

    loginUser(OpenCon(), $email, $password);
    CloseCon($conn);
} elseif (isset($_POST["editNames"])) {
    $id = $user = $_SESSION["user_id"];
    $name = sanitiseInputs($_POST["name"]);
    $surname = sanitiseInputs($_POST["surname"]);

    changeUserName(OpenCon(), $id, $name, $surname);
    CloseCon($conn);
} elseif (isset($_POST["editEmail"])) {
    $id = $user = $_SESSION["user_id"];
    $email = sanitiseInputs($_POST["email"]);

    changeUserEmail(OpenCon(), $id, $email);
    CloseCon($conn);
} elseif (isset($_POST["editPassword"])) {
    $id = $user = $_SESSION["user_id"];
    $password = sanitiseInputs($_POST["newPass"]);
    $confirmpassword = sanitiseInputs($_POST["newPassConfirm"]);

    // check passwords match
    if (passwordMatch($password, $confirmpassword) !== false) {
        header("location: ../profile.php?error=Passwords Do Not Match");
        exit();
    };

    changeUserPassword(OpenCon(), $id, $password);
    CloseCon($conn);
} elseif (isset($_POST["deleteAccount"])) {
    $id = $user = $_SESSION["user_id"];
    deleteUserAccount(OpenCon(), $id);
    CloseCon($conn);
} else {
    header("location: ../?error=error");
    exit();
};
