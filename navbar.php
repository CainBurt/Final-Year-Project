<?php include_once 'scripts/tasks.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FYP</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!--load all Font Awesome styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" integrity="sha384-/frq1SRXYH/bSyou/HUp/hib7RVN1TawQYja658FEOodR/FQBKVqT9Ol+Oz3Olq5" crossorigin="anonymous">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/style.css">
    </link>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/form.js"></script>


</head>

<body>

    <header class="navbar navbar-dark sticky-top red flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col me-0 px-3" href="/fyp/projects.php"><strong>Projects</strong></a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="text-secondary nav-item">
            <a href="#"><i class="px-3 fa-solid fa-gear white"></i></a>
            <a href="#"><i class="px-3 fa-solid fa-user white"></i></a>
            <a href="#"><i class="px-3 fa-solid fa-arrow-right-from-bracket white"></i></a>
        </div>

    </header>


    <?php
    // hides sidebar if on a projects page
    $url = $_SERVER["REQUEST_URI"];
    if (strpos($url, "/fyp/projects.php") !== false) {
    ?>
        <style>
            .sidebar {
                display: none !important;
            }
        </style>
    <?php } ?>


    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="width: 100%;">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <h5 class="text-center"><?php echo $_SESSION['projectname'] ?></h5>
                            <hr>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/fyp/kanban.php">
                                <i class="fa-solid fa-bars-progress"></i>
                                Kanban
                            </a>
                            <a class="nav-link active" aria-current="page" href="/fyp/tasks.php">
                                <i class="fa-solid fa-list-check"></i>
                                Tasks
                            </a>


                        </li>
                    </ul>
                </div>
            </nav>
            <?php
            // col length if on a projects page
            $url = $_SERVER["REQUEST_URI"];
            if (strpos($url, "/fyp/projects.php") !== false) {
            ?>
                <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4 ">
                <?php } else { ?>
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                    <?php   } ?>