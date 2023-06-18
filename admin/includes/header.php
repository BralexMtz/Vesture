<?php session_start();
if (empty($_SESSION['id'])) {
    header('Location: ./');
} ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HS</title>

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <!-- <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link href="../assets/css/style_header_admin.css" rel="stylesheet">
    <link href="../assets/css/style_modal_admin.css" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <nav class="menu" tabindex="0">
            <div class="smartphone-menu-trigger"></div>
            <header class="avatar">
                <h1 class="">Vesture <span> Admin</span></h1>
                <img src="../assets/img/luke-jones-Aw04fFn9ev8-unsplash.jpg" width="100%" />
                <h2><?php echo $_SESSION['nombre']; ?></h2>
            </header>
            <ul>
                <li tabindex="0" class="">
                    <a class="" href="categorias.php">
                        <i class="fas fa-tag"></i>
                        <span>Categorias</span>
                    </a>
                </li>
                <li tabindex="0" class="">
                    <a class="" href="productos.php">
                        <i class="fas fa-list"></i>
                        <span>Productos</span>
                    </a>
                </li>
                <!-- <li tabindex="0" class="icon-users"><span>Users</span></li>
                <li tabindex="0" class="icon-settings"><span>Settings</span></li> -->
            </ul>
            <hr>
            <a class="sign-out" href="../salir.php">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Salir
            </a>
        </nav>
        
        <!-- Sidebar -->
       
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!--
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button> -->

                    <!-- Topbar Navbar -->
                   <?php
                    // <ul class="navbar-nav ml-auto">

                    //     <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    //     <li class="nav-item dropdown no-arrow d-sm-none">
                    //         <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    //             <i class="fas fa-search fa-fw"></i>
                    //         </a>
                    //         <!-- Dropdown - Messages -->
                    //         <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                    //             <form class="form-inline mr-auto w-100 navbar-search">
                    //                 <div class="input-group">
                    //                     <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    //                     <div class="input-group-append">
                    //                         <button class="btn btn-primary" type="button">
                    //                             <i class="fas fa-search fa-sm"></i>
                    //                         </button>
                    //                     </div>
                    //                 </div>
                    //             </form>
                    //         </div>
                    //     </li>
                    //     <!-- Nav Item - User Information -->
                    //     <li class="nav-item dropdown no-arrow">
                    //         <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    //             <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nombre'];</span>
                    //             <img class="img-profile rounded-circle" src="../assets/img/luke-jones-Aw04fFn9ev8-unsplash.jpg">
                    //         </a>
                    //         <!-- Dropdown - User Information -->
                    //         <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    //             <div class="dropdown-divider"></div>
                    //             <a class="dropdown-item" href="../salir.php">
                    //                 <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    //                 Salir
                    //             </a>
                    //         </div>
                    //     </li>

                    // </ul>
                    ?>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    