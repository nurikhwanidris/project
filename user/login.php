<!-- Page Title -->
<?php $title = "Login" ?>

<!-- Header -->
<?php include('../templates/elements/admin/dashboard/header.php') ?>

<!-- Check for existing session -->
<?php
if (isset($_SESSION['id'])) {
    header('Location:/project/templates/travel/dashboard/index.php');
}
?>

<!-- Get DB conn -->
<?php include('../src/model/dbconn.php') ?>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-8 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-4">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col-lg-8 mx-auto">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST" action="login-check.php">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user" id="username" aria-describedby="usernameHelp" placeholder="Enter username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter password...">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (isset($_GET['msg'])) : ?>
                    <div class="alert alert-<?= $_GET['alert']; ?> alert-dismissible fade show mt-4" role="alert">
                        <?= $_GET['msg']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php if (isset($_GET['session_expired']) == 1) : ?>
                    <div class="alert alert-secondary alert-dismissible fade show mt-4" role="alert">
                        <strong>Session Expires. </strong> Please login again.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>

        </div>

    </div>