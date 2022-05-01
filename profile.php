<?php
include_once 'navbar.php';
// include_once 'scripts/projects.php';
?>
<?php
$userDetails = currentDetails();
foreach ($userDetails as $details) {
}
?>
<!-- Edit Names -->
<div class="modal fade" id="editNamesModal" tabindex="-1" role="dialog" aria-labelledby="editNamesModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Names</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/user.php" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name" class="col-form-label">First Name:</label>
                        <input type="text" class="form-control name" id="name" name="name" value="<?php echo $details["user_name"]; ?>">
                    </div>
                    <div class="form-group">
                        <label>Surname:</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $details["user_surname"]; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="editNames">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Email -->
<div class="modal fade" id="editEmailModal" tabindex="-1" role="dialog" aria-labelledby="editEmailModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit E-mail</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/user.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email" class="col-form-label">E-mail:</label>
                        <input type="text" class="form-control email" id="email" name="email" value="<?php echo $details["user_email"]; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="editEmail">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password -->
<div class="modal fade" id="editPasswordModal" tabindex="-1" role="dialog" aria-labelledby="editPasswordModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Change Password</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/user.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newPass" class="col-form-label">New Password:</label>
                        <input type="password" class="form-control newPass" id="newPass" name="newPass" value="">
                    </div>
                    <div class="form-group">
                        <label for="newPassConfirm" class="col-form-label">New Password Confirm:</label>
                        <input type="password" class="form-control newPassConfirm" id="newPassConfirm" name="newPassConfirm" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="editPassword">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- delete account modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Are you sure you want to delete your account?</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <form action="scripts/user.php" method="post">
                <div class="modal-body">
                    This will delete all data associated with your account. This includes projects you have created. You will also be removed from any projects and tasks you have been added to.
                </div>

                <div class="modal-footer d-flex justify-content-center align-items-center">

                    <button type="button" class="btn btn-success flex-grow-1" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger flex-grow-1" name="deleteAccount">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- user details -->
<div class="container mt-4">
    <div class="row gx-lg-5 align-items-center justify-content-center">
        <div class="col-8">


            <h4>Login & Security</h4>
            <div class="card">
                <div class="card-body">

                    <!-- Name Change (first and last) -->
                    <div class="mb-4 border-bottom d-flex justify-content-between">
                        <div>
                            <b>Name:</b>
                            <p><?php echo $details["user_name"] . " " . $details["user_surname"]; ?></p>
                        </div>
                        <div>
                            <button type="button" class="btn rounded-pill red new-project-btn white" data-toggle="modal" data-target="#editNamesModal">Edit</button>
                        </div>
                    </div>

                    <!-- Email Change -->
                    <div class="mb-4 border-bottom d-flex justify-content-between">
                        <div>
                            <b>E-mail:</b>
                            <p><?php echo $details["user_email"] ?></p>
                        </div>
                        <div>
                            <button class="btn rounded-pill red new-project-btn white " data-toggle="modal" data-target="#editEmailModal">Edit</button>
                        </div>
                    </div>

                    <!-- Password Change -->
                    <div class="d-flex justify-content-between">
                        <div>
                            <b>Password:</b>
                            <p>**********</p>
                        </div>
                        <div>
                            <button class="btn rounded-pill red new-project-btn white " data-toggle="modal" data-target="#editPasswordModal">Edit</button>
                        </div>
                    </div>

                </div>

            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <b>Delete Account</b>
                        </div>
                        <div>
                            <button class="btn rounded-pill red new-project-btn white" data-toggle="modal" data-target="#deleteAccountModal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- verify user -->
    <!-- if delete account, delete created projects and the user from projects added to -->
    <?php include_once 'footer.php' ?>