<?php
include_once 'navbar.php';
// include_once 'scripts/projects.php';
?>

<div class="container mt-4">

    <div class="row gx-lg-5 align-items-center justify-content-center">

        <div class="col-8">
            <?php
            $userDetails = currentDetails();
            foreach ($userDetails as $details) {
            }
            ?>

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
                            <button class="btn rounded-pill red new-project-btn white " data-toggle="modal" data-target="">Edit</button>
                        </div>
                    </div>

                    <!-- Email Change -->
                    <div class="mb-4 border-bottom d-flex justify-content-between">
                        <div>
                            <b>E-mail:</b>
                            <p><?php echo $details["user_email"] ?></p>
                        </div>
                        <div>
                            <button class="btn rounded-pill red new-project-btn white " data-toggle="modal" data-target="">Edit</button>
                        </div>
                    </div>

                    <!-- Password Change -->
                    <div class="d-flex justify-content-between">
                        <div>
                            <b>Password:</b>
                            <p>**********</p>
                        </div>
                        <div>
                            <button class="btn rounded-pill red new-project-btn white " data-toggle="modal" data-target="">Edit</button>
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
                            <button class="btn rounded-pill red new-project-btn white" data-toggle="modal" data-target="">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- verify user -->
    <!-- if delete account, delete created projects and the user from projects added to -->
    <?php include_once 'footer.php' ?>