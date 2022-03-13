<?php include_once 'navbar.php' ?>


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
                <form action="scripts/createtask.php" method="post">
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
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline-block">To Do</h5>
                <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#taskModal" data-list="To Do"><span class="bi bi-plus"></span></button>
                <hr>
                <p class="card-text"></p>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline-block">Doing</h5>
                <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#taskModal" data-list="Doing"><span class="bi bi-plus"></span></button>
                <hr>
                <p class="card-text"></p>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline-block">Done</h5>
                <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#taskModal" data-list="Done"><span class="bi bi-plus"></span></button>
                <hr>
                <p class="card-text"></p>

            </div>
        </div>
    </div>
</div>


<?php include_once 'footer.php' ?>