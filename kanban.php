<?php
include_once 'scripts/tasks.php';
// redirects if project variable isnt set
if (!isset($_SESSION['projectid'])) {
    header('location: ../fyp/projects.php');
    exit();
}
?>
<?php
include_once 'navbar.php';

?>

<!-- error message -->
<?php
if (isset($_GET['error'])) {
?>
    <div class="alert alert-danger container my-4" role="alert">
        <?php echo "ERROR: " . $_GET['error']; ?>
    </div>
<?php
}
?>

<!-- Title -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kanban Board</h1>
</div>

<!-- Create Task Modal Popup-->
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add Task</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/tasks.php" method="post">
                <div class="modal-body">


                    <input type="text" class="form-control list-name" id="list" name="list" readonly hidden>

                    <div class="form-group">
                        <label>Task Name:</label>
                        <input type="text" class="form-control" id="task" name="task" placeholder="Task Title">
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Start Date:</label>
                            <input type="date" class="form-control" id="start" name="start" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                        <div class="col">
                            <label>End Date:</label>
                            <input type="date" class="form-control" id="end" name="end" value="<?php echo date('Y-m-d', strtotime('tomorrow')); ?>" required>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="saveTask">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit and Delete Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Task</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/tasks.php" method="post">
                <div class="modal-body">

                    <input type="text" class="form-control task-id" id="task-id" name="task-id" readonly hidden>

                    <div class="form-group">
                        <label>Task Name:</label>
                        <input type="text" class="form-control task-title" id="task-title" name="task-title" placeholder="Task Title">
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label>Start Date:</label>
                            <input type="date" class="form-control project-start" id="task-start" name="task-start" value="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <div class="col">
                            <label>End Date:</label>
                            <input type="date" class="form-control project-end" id="task-end" name="task-end" value="<?php echo date('Y-m-d'); ?>">
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="editTask">Save Edit</button>
                    <button type="submit" class="btn btn-danger" name="deleteTask">Delete Task</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Labels and Tasks Within -->
<div class="row">
    <?php
    $labels = getAllLabels();
    foreach ($labels as $labelRow) {
        $taskResult = getTasksByLabel($labelRow["id"]);
    ?>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-inline-block"><?php echo $labelRow["label_name"]; ?></h5>
                    <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#taskModal" data-list="<?php echo $labelRow["id"]; ?>" data-name="<?php echo $labelRow["label_name"]; ?>"><span class="bi bi-plus"></span></button>
                    <hr>
                    <p class="card-text">
                    <ul class="sortable ui-sortable" id="sort<?php echo $labelRow["id"]; ?>" data-label-id="<?php echo $labelRow["id"]; ?>">
                        <?php
                        if (!empty($taskResult)) {
                            foreach ($taskResult as $taskRow) {

                        ?>
                                <li class="ui-sortable-handle card mt-1" data-task-id="<?php echo $taskRow["id"]; ?>">
                                    <div class="card-body" id="taskCard"><?php echo $taskRow["title"] ?>
                                        <a class="bi bi-pencil-square float-right" id="showEdit" data-toggle="modal" data-target="#editModal" data-task="<?php echo $taskRow["id"]; ?>" data-title="<?php echo $taskRow["title"]; ?>" data-start="<?php echo $taskRow["task_start"]; ?>" data-end="<?php echo $taskRow["task_end"] ?>"> </a>
                                    </div>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                    </p>
                </div>
            </div>
        </div>

    <?php
    }
    ?>
</div>


<?php include_once 'footer.php' ?>