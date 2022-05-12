<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!--load all Font Awesome styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" integrity="sha384-/frq1SRXYH/bSyou/HUp/hib7RVN1TawQYja658FEOodR/FQBKVqT9Ol+Oz3Olq5" crossorigin="anonymous">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/style.css">
    </link>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/form.js"></script>
</head>

<body>
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


    <div class="container mt-4">
        <div class="row gx-lg-5 align-items-center justify-content-center">
            <div class="col-8">
                <div class="card">
                    <!-- Pills navs -->
                    <ul class="nav nav-pills nav-justified mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="#login" data-toggle="pill" id="login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#register" data-toggle="pill" id="register">Register</a>
                        </li>
                    </ul>

                    <!-- login form -->
                    <div class="tab-content card-body">
                        <div class="tab-pane fade show active card-body" id="login-form">

                            <form id="loginForm" action="scripts/user.php" method="post">
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" id="loginEmail" name="loginEmail" class="form-control" />
                                    <label class="form-label" for="loginEmail">Email</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" id="loginPassword" name="loginPassword" class="form-control" />
                                    <label class="form-label" for="loginPassword">Password</label>
                                </div>

                                <!-- Submit button -->
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-danger flex-grow-1" name="login">Sign in</button>
                                </div>

                            </form>
                        </div>
                        <!-- register form -->
                        <div class="tab-pane fade card-body" id="register-form">
                            <form id="registerForm" action="scripts/user.php" method="post">

                                <!-- Name input -->
                                <div class="form-outline mb-4">
                                    <input type="text" id="registerName" name="registerName" class="form-control" />
                                    <label class="form-label" for="registerName">Name</label>
                                </div>

                                <!-- Surname input -->
                                <div class="form-outline mb-4">
                                    <input type="text" id="registerSurname" name="registerSurname" class="form-control" />
                                    <label class="form-label" for="registerSurname">Surname</label>
                                </div>

                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" id="registerEmail" name="registerEmail" class="form-control" />
                                    <label class="form-label" for="registerEmail">Email</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" id="registerPassword" name="registerPassword" class="form-control" />
                                    <label class="form-label" for="registerPassword">Password</label>
                                </div>

                                <!-- Repeat Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" id="registerConfirmPassword" name="registerConfirmPassword" class="form-control" />
                                    <label class="form-label" for="registerConfirmPassword">Confirm password</label>
                                </div>

                                <!-- Submit button -->
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-danger flex-grow-1" name="createAccount">Create Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Pills content -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>