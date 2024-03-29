<?php include_once 'scripts/tasks.php'; ?>
<?php include_once 'scripts/projects.php'; ?>

<?php
$userCreatedProject = False;
if (isset($_SESSION["projectid"])) {
    if (userCreatedCurrentProject()) {
        $userCreatedProject = True;
    }
}
?>
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
    <!-- Link to JQuery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/style.css">
    </link>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/script.js"></script>


</head>

<body>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Add User</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form action="scripts/projects.php" method="post">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="list-name" class="col-form-label">User Email:</label>
                            <input type="text" class="form-control user-email" id="user-email" name="user-email">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" name="addUserToProject">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- top navbar -->
    <header id="topNavbar" class="navbar navbar-dark sticky-top red d-flex flex-row p-0 shadow">
        <div>
            <a id="toggleSidebar" class="pl-3 d-none d-md-inline hide-menu" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars white icon-hover"></i>

                <!-- For Smaller screens the sidebar is hidden and burger menu is a dropdown -->
                <ul class="list-group dropdown d-sm-inline d-md-none hide-menu">
                    <a class="nav-link fa-solid fa-bars white " href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
                        <li class="nav-item">
                            <h5 class="text-center pt-3"><?php echo $_SESSION['projectname'] ?></h5>
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

                        <a href="/fyp/calendar.php" class="list-group-item list-group-item-action bg-light border-0">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                <span class="fa fa-calendar fa-fw mr-3"></span>
                                <span class="menu-collapsed">Calendar</span>
                            </div>
                        </a>
                        <a href="/fyp/files.php" class="list-group-item list-group-item-action bg-light border-0">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                <span class="fa fa-file fa-fw mr-3"></span>
                                <span class="menu-collapsed">Files</span>
                            </div>
                        </a>
                        <a href="/fyp/discussion.php" class="list-group-item list-group-item-action bg-light border-0">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                <span class="fa-solid fa-comment fa-fw mr-3"></span>
                                <span class="menu-collapsed">Discussion</span>
                            </div>
                        </a>
                        <div class="d-flex p-2 align-items-end">
                            <button type="submit" class="btn btn-success flex-grow-1" data-toggle="modal" data-target="#addUserModal" name="Add User">
                                <span class="fa-solid fa-plus"></span>
                                <span class="menu-collapsed">Add User</span>
                            </button>
                        </div>
                    </div>
                </ul>
                <!-- Smaller devices menu END -->
            </a>
            <a class="navbar-brand me-0 px-3 hide-projects d-sm-inline" href="/fyp/projects.php"><strong class="icon-hover "><i class="fa-solid fa-angle-left"></i> Back To Projects</strong></a>
        </div>

        <div class="text-secondary nav-item justify-content-end py-2">
            <?php
            // shows this if the user created the project
            if ($userCreatedProject) {
            ?>
                <a id="projectSettings" href="/fyp/projectsettings.php"><i class="px-3 fa-solid fa-gear white icon-hover" data-toggle="tooltip" title="Project Settings"></i></a>
            <?php
            }
            ?>
            <a href="/fyp/profile.php"><i class="px-3 fa-solid fa-user white icon-hover" data-toggle="tooltip" title="User Profile"></i></a>

            <a href="/fyp/scripts/logout.php"><i class="px-3 fa-solid fa-arrow-right-from-bracket white icon-hover" data-toggle="tooltip" title="Logout"></i></a>
        </div>

    </header>

    <?php

    //acronym creator of project name
    if (isset($_SESSION['projectname'])) {
        if (preg_match_all('/\b(\w)/', strtoupper($_SESSION['projectname']), $m)) {
            $acronym = implode('', $m[1]);
        }
    }

    ?>


    <?php
    // hides sidebar if on a projects page and profile page
    $url = $_SERVER["REQUEST_URI"];
    if ((strpos($url, "/fyp/projects.php") !== false)) {
    ?>
        <style>
            #sidebar-container,
            #toggleSidebar,
            #projectSettings,
            .hide-menu,
            .hide-projects {
                display: none !important;
            }
        </style>
    <?php } elseif (strpos($url, "/fyp/profile.php") !== false) {
    ?>
        <style>
            #sidebar-container,
            #toggleSidebar,
            #projectSettings,
            .hide-menu {
                display: none !important;
            }
        </style>
    <?php

    }  ?>

    <!-- sidebar -->
    <div class="row" id="body-row">
        <nav id="sidebar-container" class="sidebar-expanded d-none d-md-block bg-light">

            <ul class="list-group sticky-top sticky-offset">
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

                <a href="/fyp/calendar.php" class="list-group-item list-group-item-action bg-light border-0">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-calendar fa-fw mr-3"></span>
                        <span class="menu-collapsed">Calendar</span>
                    </div>
                </a>

                <a href="/fyp/files.php" class="list-group-item list-group-item-action bg-light border-0">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-file fa-fw mr-3"></span>
                        <span class="menu-collapsed">Files</span>
                    </div>
                </a>

                <a href="/fyp/discussion.php" class="list-group-item list-group-item-action bg-light border-0">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa-solid fa-comment fa-fw mr-3"></span>
                        <span class="menu-collapsed">Discussion</span>
                    </div>
                </a>
                <?php
                // shows this if the user created the project
                if ($userCreatedProject) {
                ?>
                    <div class="d-flex p-2 align-items-end">
                        <button type="submit" class="btn btn-success flex-grow-1" data-toggle="modal" data-target="#addUserModal" name="Add User">
                            <span class="fa-solid fa-plus"></span>
                            <span class="menu-collapsed">Add User</span>
                        </button>
                    </div>
                <?php
                }
                ?>
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