<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo $title . ' - ' . APP_NAME ?></title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url ( '/assets/css/app.min.css' ); ?>">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url ( '/assets/css/style.css' ); ?>">
    <link rel="stylesheet" href="<?php echo base_url ( '/assets/css/components.css' ); ?>">
    <link rel="stylesheet" href="<?php echo base_url ( '/assets/bundles/datatables/datatables.min.css' ); ?>">
    <link rel="stylesheet"
          href="<?php echo base_url ( '/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css' ); ?>">
    <link rel="stylesheet"
          href="<?php echo base_url ( '/assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css' ); ?>">
    <link rel="stylesheet" href="<?php echo base_url ( '/assets/bundles/select2/dist/css/select2.min.css' ); ?>">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="<?php echo base_url ( '/assets/css/custom.css?ver=' . rand () ); ?>">
    <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url ( '/assets/img/favicon.ico' ); ?>"/>
</head>

<body>
<div class="loader"></div>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar sticky">
            <div class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li>
                        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                            <i data-feather="align-justify"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="<?php echo base_url ( '/assets/img/user.png' ); ?>"
                             class="user-img-radious-style">
                        <span class="d-sm-none d-lg-inline-block"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pullDown">
                        <div class="dropdown-title">Hello Sarah Smith</div>
                        <a href="<?php echo base_url ( '/profile' ) ?>" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo base_url ( '/logout' ) ?>" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
<?php require_once 'sidebar.php'; ?>