<?php
require_once 'db_connection.php';
require_once 'functions.php';

if (isset($_POST["createAccount"])) {
    $name = sanitiseInputs($_POST["registerName"]);
    $surname = sanitiseInputs($_POST["registerSurname"]);
    $email = sanitiseInputs($_POST["registerEmail"]);
    $password = sanitiseInputs($_POST["registerPassword"]);
    $confirmpassword = sanitiseInputs($_POST["registerConfirmPassword"]);

    createUser(OpenCon(), $name, $surname, $email, $password, $confirmpassword);
    CloseCon($conn);
} elseif (isset($_POST["login"])) {
    $email = sanitiseInputs($_POST["loginEmail"]);
    $password = sanitiseInputs($_POST["loginPassword"]);

    loginUser(OpenCon(), $email, $password);
    CloseCon($conn);
} else {
    header("location: ../?error=error");
    exit();
};
