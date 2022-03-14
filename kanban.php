<?php
include_once 'navbar.php';
include_once 'scripts/tasks.php';
$labels = getAllLabels()
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tasks</h1>
</div>

<!-- Task Modal Popup-->
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add Task</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <form action="scripts/tasks.php" method="post">
                    <div class="form-group">
                        <label for="list-name" class="col-form-label">List:</label>
                        <input type="text" class="form-control list-name" id="list" name="list" readonly>
                    </div>
                    <div class="form-group">
                        <label>Task Name:</label>
                        <input type="text" class="form-control" id="task" name="task" placeholder="Task Title">
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

<div class="row">
    <?php

    foreach ($labels as $labelRow) {
        $taskResult = getTasksByLabel($labelRow["id"]);
    ?>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-inline-block"><?php echo $labelRow["label_name"]; ?></h5>
                    <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#taskModal" data-list="<?php echo $labelRow["id"]; ?>"><span class="bi bi-plus"></span></button>
                    <hr>
                    <p class="card-text">
                    <ul class="sortable ui-sortable" id="sort<?php echo $labelRow["id"]; ?>" data-label-id="<?php echo $labelRow["id"]; ?>">
                        <?php
                        if (!empty($taskResult)) {
                            foreach ($taskResult as $taskRow) {

                        ?>
                                <li class="cui-sortable-handle card" data-task-id="<?php echo $taskRow["id"]; ?>">
                                    <div class="card-body"><?php echo $taskRow["title"] ?></div>
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