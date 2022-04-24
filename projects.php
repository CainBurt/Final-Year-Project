<?php
include_once 'navbar.php';
include_once 'scripts/projects.php';
?>
<!-- New Project Modal -->
<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">New Project</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/projects.php" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Project Name:</label>
                        <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Project Name" required>
                    </div>
                    <div class="form-group">
                        <label>Project Description:</label>
                        <textarea type="textarea" class="form-control" id="projectDesc" name="projectDesc" placeholder="Project Description" required></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Start Date:</label>
                            <input type="date" class="form-control" id="projectStart" name="projectStart" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                        <div class="col">
                            <label>End Date:</label>
                            <input type="date" class="form-control" id="projectEnd" name="projectEnd" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center align-items-center">
                    <button type="button" class="btn btn-danger flex-grow-1" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success flex-grow-1" name="saveProject">Create Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- delete project modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Are you sure you want to delete this project?</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/projects.php" method="post">
                <div class="modal-body">
                    This will delete all data associated with this project.
                    <input type="text" class="form-control project" id="delProjectId" name="delProjectId" readonly hidden>
                </div>

                <div class="modal-footer d-flex justify-content-center align-items-center">

                    <button type="button" class="btn btn-success flex-grow-1" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger flex-grow-1" name="deleteProject">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit project modal -->
<div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="editProjectModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Project</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/projects.php" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Project Id:</label>
                        <input type="text" class="form-control project-id" id="projectId" name="projectId" placeholder="Project Id" readonly>
                    </div>
                    <div class="form-group">
                        <label>Project Name:</label>
                        <input type="text" class="form-control project-name" id="projectName" name="projectName" placeholder="Project Name">
                    </div>
                    <div class="form-group">
                        <label>Project Description:</label>
                        <textarea type="textarea" class="form-control project-desc" id="projectDesc" name="projectDesc" placeholder="Project Description"></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Start Date:</label>
                            <input type="date" class="form-control project-start" id="projectStart" name="projectStart" value="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <div class="col">
                            <label>End Date:</label>
                            <input type="date" class="form-control project-end" id="projectEnd" name="projectEnd" value="<?php echo date('Y-m-d'); ?>">
                        </div>

                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center align-items-center">
                    <button type="button" class="btn btn-danger flex-grow-1" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success flex-grow-1" name="saveEditProject">Save Edits</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <button class="btn rounded-pill red new-project-btn" data-toggle="modal" data-target="#projectModal"><span class="bi bi-plus white">New Project</span></button>
</div> -->

<div class="row">
    <!-- New project card -->
    <div class="col-sm-3 mt-4">
        <div class="new-project card shadow " data-toggle="modal" data-target="#projectModal">
            <div class="project-body card-body d-flex justify-content-center align-items-center">
                <p class="card-text">
                <h2 class="text-center"><span class="bi bi-plus">New Project</span></h2>
                </p>
            </div>
        </div>
    </div>



    <?php
    $projects = getAllProjects();
    foreach ($projects as $project) {
        $projectId = $project["id"];
        $projectName = $project["project_name"];
        $projectDesc = $project["project_description"];
        $projectStart = $project["project_start"];
        $projectEnd = $project["project_end"];
    ?>

        <!-- exisiting projects cards -->
        <div class="col-sm-3 mt-4">
            <div class="project-card card shadow">
                <a class="projectClickable" href="scripts/projects.php?projectid=<?php echo $projectId ?>&projectname=<?php echo $projectName ?>">
                    <div class="project-body card-body d-flex justify-content-center align-items-center">
                        <p class="card-text">
                        <h2 class="text-center"><?php echo $projectName ?></h2>
                        </p>

                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <div class="footer-content">
                            <a class="bi bi-trash float-left" id="deleteProject" data-toggle="modal" data-target="#deleteModal" data-project="<?php echo $projectId ?>"></a>
                            <a class="bi bi-pencil-square float-right" id="editProject" data-toggle="modal" data-target="#editProjectModal" data-id="<?php echo $projectId ?>" data-title="<?php echo $projectName ?>" data-desc="<?php echo $projectDesc ?>" data-start="<?php echo $projectStart ?>" data-end="<?php echo $projectEnd ?>"></a>
                        </div>
                    </div>

                </a>

            </div>
        </div>

    <?php } ?>

</div>

<?php include_once 'footer.php' ?>