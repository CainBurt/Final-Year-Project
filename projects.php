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
            <div class="modal-body">
                <form action="scripts/projects.php" method="post">
                    <div class="form-group">
                        <label>Project Name:</label>
                        <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Project Name">
                    </div>
                    <div class="form-group">
                        <label>Project Description:</label>
                        <textarea type="textarea" class="form-control" id="projectDesc" name="projectDesc" placeholder="Project Description"></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Start Date:</label>
                            <input type="date" class="form-control" id="projectStart" name="projectStart" value="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <div class="col">
                            <label>End Date:</label>
                            <input type="date" class="form-control" id="projectEnd" name="projectEnd" value="<?php echo date('Y-m-d'); ?>">
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" name="saveProject">Create Project</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Projects</h1>
</div>

<div class="col-sm-3">
    <div class="new-project card" data-toggle="modal" data-target="#projectModal">
        <div class="card-body">
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
?>

    <div class="col-sm-3">
        <div class="card">
            <a href="scripts/projects.php?projectid=<?php echo $projectId ?>&projectname=<?php echo $projectName ?>">
                <div class="card-body">
                    <p class="card-text">
                    <h2 class="text-center"><?php echo $projectName ?></h2>
                    </p>

                </div>
            </a>
        </div>
    </div>

<?php } ?>


<?php include_once 'footer.php' ?>