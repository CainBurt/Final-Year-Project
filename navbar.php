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
        <a id="toggleSidebar" class="pl-3" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars white"></i>
        </a>
        <a class="navbar-brand col me-0 px-3" href="/fyp/projects.php"><strong>All Projects</strong></a>

        <div class="text-secondary nav-item">
            <a href="#"><i class="px-3 fa-solid fa-gear white"></i></a>
            <a href="#"><i class="px-3 fa-solid fa-user white"></i></a>
            <a href="#"><i class="px-3 fa-solid fa-arrow-right-from-bracket white"></i></a>
        </div>

    </header>

    <?php
    //acronym creator of project name
    if (preg_match_all('/\b(\w)/', strtoupper($_SESSION['projectname']), $m)) {
        $acronym = implode('', $m[1]);
    }
    ?>


    <?php
    // hides sidebar if on a projects page
    $url = $_SERVER["REQUEST_URI"];
    if (strpos($url, "/fyp/projects.php") !== false) {
    ?>
        <style>
            #sidebar-container {
                display: none !important;
            }

            #toggleSidebar {
                display: none !important;
            }
        </style>
    <?php } ?>


    <div class="row" id="body-row">
        <nav id="sidebar-container" class="sidebar-expanded d-none d-md-block bg-light">

            <ul class="list-group">
                <li class="nav-item">
                    <h5 class="text-center pt-3 menu-collapsed"><?php echo $_SESSION['projectname'] ?></h5>
                    <h5 id="projectName" class="text-center pt-3 acronym"><?php echo $acronym ?></h5>
                    <hr>
                </li>

                <a href="/fyp/kanban.php" class="list-group-item list-group-item-action bg-light border-0">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa-solid fa-bars-progress fa-fw mr-3"></span>
                        <span class="menu-collapsed">Kanban</span>
                    </div>
                </a>

                <a href="/fyp/tasks.php" class="list-group-item list-group-item-action bg-light border-0">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-tasks fa-fw mr-3"></span>
                        <span class="menu-collapsed">Tasks</span>
                    </div>
                </a>
            </ul>

        </nav>
        <?php
        // col length if on a projects page
        $url = $_SERVER["REQUEST_URI"];
        if (strpos($url, "/fyp/projects.php") !== false) {
        ?>
            <main class="col p-4">
            <?php } else { ?>
                <main class="col p-4">

                <?php   } ?>