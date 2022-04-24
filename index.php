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

                            <form>
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" id="loginName" class="form-control" />
                                    <label class="form-label" for="loginName">Email</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" id="loginPassword" class="form-control" />
                                    <label class="form-label" for="loginPassword">Password</label>
                                </div>

                                <!-- 2 column grid layout -->
                                <div class="">
                                    <!-- Checkbox -->
                                    <div class="form-check mb-3 mb-md-0">
                                        <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                                        <label class="form-check-label" for="loginCheck"> Remember me </label>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-danger flex-grow-1">Sign in</button>
                                </div>

                            </form>
                        </div>
                        <!-- register form -->
                        <div class="tab-pane fade card-body" id="register-form">
                            <form>

                                <!-- Name input -->
                                <div class="form-outline mb-4">
                                    <input type="text" id="registerName" class="form-control" />
                                    <label class="form-label" for="registerName">Name</label>
                                </div>

                                <!-- Username input -->
                                <div class="form-outline mb-4">
                                    <input type="text" id="registerUsername" class="form-control" />
                                    <label class="form-label" for="registerUsername">Surname</label>
                                </div>

                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" id="registerEmail" class="form-control" />
                                    <label class="form-label" for="registerEmail">Email</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" id="registerPassword" class="form-control" />
                                    <label class="form-label" for="registerPassword">Password</label>
                                </div>

                                <!-- Repeat Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" id="registerRepeatPassword" class="form-control" />
                                    <label class="form-label" for="registerRepeatPassword">Confirm password</label>
                                </div>

                                <!-- Submit button -->
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-danger flex-grow-1">Create Account</button>
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