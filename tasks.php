<?php
include_once 'navbar.php';
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tasks and Subtasks</h1>
    <button class="btn rounded-pill red new-project-btn" data-toggle="modal" data-target="#projectModal"><span class="bi bi-plus white">New Task</span></button>
</div>

<!-- Add or Change user modal -->
<div class="modal fade" id="changeUser" tabindex="-1" role="dialog" aria-labelledby="changeUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Change User on Task</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/tasks.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Task Id:</label>
                        <input type="text" class="form-control task-id" id="task-id" name="task-id" readonly>
                    </div>

                    <div class="form-group">
                        <label>Choose A User:</label>
                        <select id="user" name="user">
                            <option value="NULL"><i>No User</i></option>
                            <?php
                            $usersInProject = getAllUsersInProject();
                            foreach ($usersInProject as $user) {
                            ?>
                                <option value="<?php echo $user["id"]; ?>"><?php echo $user["user_name"] . " " . $user["user_surname"]; ?></option>
                            <?php
                            };
                            ?>

                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="changeUser">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create Subtasks Modal -->
<div class="modal fade" id="addSubtaskModal" tabindex="-1" role="dialog" aria-labelledby="addSubtaskModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add Subtask</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/tasks.php" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control task-id" id="task-id" name="task-id" readonly>
                    </div>
                    <div class="form-group">
                        <label>Subtask Name:</label>
                        <input type="text" class="form-control" id="subtaskname" name="subtaskname" placeholder="Subtask Name">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="createSubtask">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit/Delete Task Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Task</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/tasks.php" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="list-name" class="col-form-label">Task Id:</label>
                        <input type="text" class="form-control task-id" id="task-id" name="task-id" readonly>
                    </div>
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
<!-- Edit and Delete Subtasks Modal-->
<div class="modal fade" id="editSubtask" tabindex="-1" role="dialog" aria-labelledby="editSubtask" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Subtask</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/tasks.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <!-- <label for="list-name" class="col-form-label">Subtask Id:</label> -->
                        <input type="text" class="form-control task-id" id="task-id" name="task-id" readonly hidden>
                    </div>
                    <div class="form-group">
                        <label>Task Name:</label>
                        <input type="text" class="form-control task-title" id="task-title" name="task-title" placeholder="Task Title">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="editSubtask">Save Edit</button>
                    <button type="submit" class="btn btn-danger" name="deleteSubtask">Delete Task</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col">
    <?php
    $labels = getAllLabels();
    foreach ($labels as $labelRow) {
        $taskResult = getTasksByLabel($labelRow["id"]);
    ?>

        <?php
        if (!empty($taskResult)) {
            foreach ($taskResult as $taskRow) {
                $subtasks = getSubtasksByTaskId($taskRow["id"]);

        ?>
                <div class="row-6">

                    <div class="task-page-card card mt-1" data-toggle="taskExpand" data-task-id="<?php echo $taskRow["id"]; ?>">
                        <?php
                        // changes task card colour if the task is marked as done
                        if ($taskRow["label_id"] == 3) {

                        ?>
                            <div class="card-body doneTask" id="taskCard"><?php echo $taskRow["title"] ?>
                            <?php
                        } else {
                            ?>
                                <div class="card-body taskPage" id="taskCard"><?php echo $taskRow["title"] ?>
                                <?php
                            }
                                ?>
                                <!-- shows down arrow only if there are subtasks -->
                                <?php if (isset($subtasks)) { ?>
                                    <a id="arrowid<?php echo $taskRow["id"]; ?>" class="fa-solid fa-chevron-down float-right"></a>
                                <?php } ?>


                                <?php
                                foreach ($usersInProject as $user) {
                                    if ($taskRow["assigned_user_id"] == $user["id"]) {
                                ?>
                                        <div class="circle-around" data-toggle="tooltip" data-placement="bottom" title="<?php echo $user["user_name"]  . " " . $user["user_surname"] ?>"><?php echo $user["user_name"][0] . $user["user_surname"][0] ?></div>
                                <?php
                                    }
                                };
                                ?>

                                <i class="fa-solid fa-ellipsis-vertical float-right pr-3" role="button" id="showEdit" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#changeUser" data-task="<?php echo $taskRow["id"]; ?>">Add or Change User</a></li>
                                    <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#addSubtaskModal" data-task="<?php echo $taskRow["id"]; ?>">Add Subtask</a></li>
                                    <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#editTaskModal" data-task="<?php echo $taskRow["id"]; ?>" data-title=" <?php echo $taskRow["title"]; ?>" data-start="<?php echo $taskRow["task_start"]; ?>" data-end="<?php echo $taskRow["task_end"] ?>">Edit Task</a></li>
                                </ul>

                                </div>
                            </div>

                            <?php
                            if (!empty($subtasks)) {
                                foreach ($subtasks as $subtaskrow) {

                            ?>
                                    <div id="subtaskid<?php echo $subtaskrow["task_id"]; ?>" class="ui-sortable-handle card mt-1 ml-5 mr-5 d-none" data-subtask-task-id=<?php echo $subtaskrow["task_id"]; ?>>
                                        <div class="card-body subtask " id="taskCard">
                                            <div class="form-check form-check-inline">
                                                <form action="" method="post">
                                                    <input id="subtask_status" class="form-check-input" type="checkbox" data-subtask-id="<?php echo $subtaskrow["id"]; ?>" <?php if ($subtaskrow["sub_status"] == 1) echo 'checked="checked"'; ?>>
                                                    <label class="form-check-label"> <?php echo $subtaskrow["sub_name"]; ?></label>
                                                </form>
                                            </div>
                                            <i class="bi bi-pencil-square float-right" role="button" id="showEdit" data-toggle="modal" data-target="#editSubtask" data-task="<?php echo $subtaskrow["id"]; ?>" data-title="<?php echo $subtaskrow["sub_name"] ?>"></i>

                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                    </div>
            <?php
            }
        }
            ?>


        <?php
    }
        ?>
        <?php include_once 'footer.php' ?>