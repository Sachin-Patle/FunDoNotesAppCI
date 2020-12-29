<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>FunDooNotes</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?php echo base_url('/assets/vendors/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/vendors/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/vendors/themify-icons/css/themify-icons.css');?>" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="<?php echo base_url('/assets/vendors/DataTables/datatables.min.css');?>" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="<?php echo base_url('/assets/css/main.min.css');?>" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->

    <script src="<?php echo base_url('/assets/js/jquery-1.11.1.min.js');?>" type="text/javascript"></script>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="">
                    <span class="brand">FunDoo
                        <span class="brand-tip">Notes</span>
                    </span>
                    <span class="brand-mini">FN</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <img src="<?php echo base_url('/assets/img/admin-avatar.png');?>" />
                            <span></span><?php echo $_SESSION['user_name'];?><i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href=""><i class="fa fa-user"></i>Profile</a>
                            <li class="dropdown-divider"></li>
                            <a class="dropdown-item" href="<?= site_url('/logout') ?>"><i class="fa fa-power-off"></i>Logout</a>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <?php require_once "menu.php";?>