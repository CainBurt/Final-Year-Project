<?php
include_once 'navbar.php';
include_once 'scripts/projects.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Added Users</h1>
</div>

<!-- delete user from project modal -->
<div class="modal fade" id="removeUserModal" tabindex="-1" role="dialog" aria-labelledby="removeUserModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Are you sure you want to remove this user from this project?</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/projects.php" method="post">
                <div class="modal-body">
                    <input type="text" class="form-control userId" id="userId" name="userId" readonly hidden>
                </div>

                <div class="modal-footer d-flex justify-content-center align-items-center">

                    <button type="button" class="btn btn-success flex-grow-1" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger flex-grow-1" name="removeUser">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>






<?php
$users = getAllUsersInProject();
// TODO IF EMPTY ECHO NO OTHER USERS ADDED
foreach ($users as $user) {
    // debug_to_console($user);
?>

    <!-- exisiting projects cards -->
    <div class="row-6">
        <div class="col-sm-4 mt-4">
            <div class="card user-card">
                <a class="">
                    <div id="userCard" class="user-card card-body d-flex justify-content-left align-items-center">
                        <p class="card-text">
                        <h4 class="text-center"><?php echo $user["user_name"] . " " . $user["user_surname"]; ?></h4>
                        <a id="showDelUser" class="bi bi-trash ml-auto" data-toggle="modal" data-target="#removeUserModal" data-user="<?php echo $user["user_id"]; ?>"></a>
                        </p>

                    </div>


                </a>

            </div>
        </div>
    </div>

<?php } ?>

<?php include_once 'footer.php' ?>