<?php

	//Config infos
	$info  =  $this->view->info;

    // echo "<pre>";
    // var_dump($info);

	$header = $info ["header"];
	
	$website = $info ["website"];
	$website_info = $website["info"];
    $user = $website["user"];

	$footer = $info ["footer"];


    // echo "<pre>";
	// 				print_r($header['previous']);
	// 				echo "</pre>";
					
	
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= $header["title_page"] ?> - <?= $header["subtitle_page"] ?></title>
        <meta name="description" content="<?= $header["description"] ?>">
        <meta name="author" content="<?= $header["author"] ?>">
        <link rel="icon" type="img/x-icon" href="<?= $header['previous'] ? '../' : ''?>/img/icon_barbearia.png">

        <!-- Custom fonts for this template-->
        <link href="<?= $header['previous'] ? '../' : ''?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="<?= $header['previous'] ? '../' : ''?>css/admin/sb-admin-2.min.css" rel="stylesheet">
    </head>

    <body id="page-top">
        
        <!-- Page Wrapper -->
        <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <img src="<?= $header['previous'] ? '../' : ''?>/img/barberpole.png" width="30%">
            </a>

            <!-- MENU -->
            <!-- Nav Item - Admin -->
            <li class="nav-item active">
                <a class="nav-link" href="/admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <?php if($info['website']['menu']['level'] == 1) { ?>
                
                <li class="nav-item">
                    <a class="nav-link" href="/admin/scheduling">
                        <i class="fa fa-clock" aria-hidden="true"></i>
                        <span>Agedamento</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/holiday">
                        <!-- <i class="fa fa-calendar" aria-hidden="true"></i> -->
                        <i class="fas fa-fw fa-glass-cheers"></i>
                        <span>Feriados</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/service">
                        <i class="fa fa-wrench" aria-hidden="true"></i>
                        <span>Serviços</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/dayactive">
                        <i class="fa fa-calendar-plus" aria-hidden="true"></i>
                        <!-- <i class="fa fa-calendar-plus-o" aria-hidden="true"></i> -->
                        <span>Dias ativos</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/timeactive">
                        <i class="fa fa-hourglass" aria-hidden="true"></i>
                        <span>Horários ativos</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/clients">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span>Clientes</span></a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="/admin/config">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <span>Configurações</span></a>
                </li>
            <?php } else if($info['website']['menu']['level'] == 2) {?>
                <!-- Nav Item - Funcionário -->
            <?php } else if($info['website']['menu']['level'] == 3) { ?>
                <!-- Nav Item - Cliente -->
                <li class="nav-item">
                    <a class="nav-link" href="/admin/myschedules">
                        <i class="fa fa-clock"></i>
                        <span>Meus horários</span></a>
                </li>
                
            <?php } ?>
            
            <li class="nav-item">
                <a class="nav-link" href="/admin/myprofile">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>Meu perfil</span></a>
            </li>


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- <?= $info['website']['menu']['level'] ?> -->

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>                     

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?= $user['name'] . " " .$user['surname'] ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= $header['previous'] ? '../' : ''?>img/admin/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php $this->content(); ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?= $footer['year'] ?> Admin <a href="/"><?= $footer['name'] ?></a> - <?= $footer['rights'] ?></span>
                        <!-- <p>&copy; <?= $footer['year'] ?> <a href="/"><?= $footer['name'] ?></a> - <?= $footer['rights'] ?></p> -->
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?= $header['previous'] ? '../' : ''?>vendor/jquery/jquery.min.js"></script>
        <script src="<?= $header['previous'] ? '../' : ''?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= $header['previous'] ? '../' : ''?>vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= $header['previous'] ? '../' : ''?>js/admin/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="<?= $header['previous'] ? '../' : ''?>vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="<?= $header['previous'] ? '../' : ''?>js/admin/demo/chart-area-demo.js"></script>
        <script src="<?= $header['previous'] ? '../' : ''?>js/admin/demo/chart-pie-demo.js"></script>

    </body>

</html>