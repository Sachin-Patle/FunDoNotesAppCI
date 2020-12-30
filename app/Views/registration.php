<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>FunDooNotes | Register</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?php echo base_url('/assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/vendors/themify-icons/css/themify-icons.css'); ?>" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="<?php echo base_url('/assets/css/main.css'); ?>" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="<?php echo base_url('/assets/css/pages/auth-light.css'); ?>" rel="stylesheet" />
</head>

<body class="bg-silver-300">
    <div class="content">
        <div class="brand">
            <a class="link">FunDooNotes</a>
        </div>
        <form id="register-form" action="<?= site_url('/registration') ?>" method="post">
            <h2 class="login-title">Registration</h2>
            <?php
            if (isset($_SESSION['success'])) {
            ?>
                <div class="alert alert-success alert-dismissable fade show">
                    <button class="close" data-dismiss="alert" aria-label="Close">×</button><strong>Success!</strong> <?php echo $_SESSION['success']; ?>
                </div>
            <?php
                unset($_SESSION['success']);
            }
            ?>
            <?php
            if (isset($_SESSION['error'])) {
            ?>
                <div class="alert alert-danger alert-dismissable fade show">
                    <button class="close" data-dismiss="alert" aria-label="Close">×</button><strong>Oops!</strong> <?php echo $_SESSION['error']; ?>
                </div>
            <?php
                unset($_SESSION['error']);
            }
            ?>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input class="form-control" type="text" name="first_name" placeholder="First Name">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input class="form-control" type="text" name="last_name" placeholder="Last Name">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control" id="password" type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
            </div>

            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Register</button>
            </div>
            <div class="social-auth-hr">
                <span>Or</span>
            </div>
            <div class="text-center">Already a member?
                <a class="color-blue" href="<?= site_url('/login') ?>">Login here</a>
            </div>
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="<?php echo base_url('/assets/vendors/jquery/dist/jquery.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/vendors/popper.js/dist/umd/popper.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('/assets/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="<?php echo base_url('/assets/vendors/jquery-validation/dist/jquery.validate.min.js'); ?>" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="<?php echo base_url('/assets/js/app.js'); ?>" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#register-form').validate({
                errorClass: "help-block",
                rules: {
                    first_name: {
                        required: true,
                        minlength: 2
                    },
                    last_name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        confirmed: true
                    },
                    password_confirmation: {
                        equalTo: password
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
</body>

</html>