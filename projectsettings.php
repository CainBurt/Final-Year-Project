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
include_once 'scripts/projects.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Users in Project</h1>
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

<?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
    <div class="success-message" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success_message']; ?></div>
<?php unset($_SESSION['success_message']);
} ?>

<div class="row">
    <?php
    $users = getAllUsersInProject();
    if ($users !== NULL) {
        foreach ($users as $user) {
            // debug_to_console($user);
    ?>

            <!-- exisiting projects cards -->
            <div class="col-lg-2 mt-4">
                <div class="user-card card shadow" id="addedUser">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="circle-around-settings"><?php echo $user["user_name"][0] . $user["user_surname"][0] ?></div>

                        <div class="card-text">
                            <h4 class="text-center pt-5"><?php echo $user["user_name"] . " " . $user["user_surname"]; ?></h4>
                            <p class="text-center"><?php echo $user["user_email"] ?></p>
                        </div>

                    </div>
                    <div class="card-footer bg-transparent border-top-0 ">
                        <div class="footer-content">
                            <a id="showDelUserIcon" class="bi bi-trash ml-auto d-flex flex-column align-items-center" data-toggle="modal" data-target="#removeUserModal" data-user="<?php echo $user["user_id"]; ?>"></a>
                        </div>
                    </div>
                </div>
            </div>

    <?php
        }
    } else {
        echo "<p>No other users in this project</p>";
    }

    ?>
</div>
<?php include_once 'footer.php' ?>