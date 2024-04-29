<body>
    <!-- Page Content Start -->
    <!--================================-->
    <div class="page-content">
        <!--================================-->
        <!-- Page Header Start -->
        <!--================================-->
        <div class="page-header">
            <nav class="navbar navbar-default">
                <!--================================-->
                <!-- Brand and Logo Start -->
                <!--================================-->
                <div class="navbar-header">
                    <div class="navbar-brand">
                        <ul class="list-inline">
                            <!-- Mobile Toggle and Logo -->
                            <li class="list-inline-item"><a class="hidden-md hidden-lg" href="javascript:void(0)"
                                    id="sidebar-toggle-button"><i class="ion-navicon tx-20"></i></a></li>
                            <!-- PC Toggle and Logo -->
                            <li class="list-inline-item"><a class="text-muted hidden-xs hidden-sm"
                                    href="javascript:void(0)" id="collapsed-sidebar-toggle-button"><i
                                        class="ion-navicon tx-20"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!--/ Brand and Logo End -->
                <!--================================-->
                <!-- Header Right Start -->
                <!--================================-->
                <div class="header-right pull-right">
                    <ul class="list-inline justify-content-end">
                        <li class="list-inline-item dropdown">
                            <a class="text-muted" href="javascript:;" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="select-profile">Selamat Datang,
                                    <?php echo $_SESSION['nama_user'] ?>
                                </span>
                                <img src="../assets/images/avatar/avatar.png" class="mg-b-10 img-fluid wd-30" alt="">
                            </a>
                            <ul class="dropdown-menu profile-dropdown shadow-2">
                                <?php if ($_SESSION['id_level'] == 1) { ?>
                                    <li>
                                        <a href="?page=menu"> <i class="icon-layers"></i>Manajemen Menu</a>
                                    </li>
                                    <li>
                                        <a href="?page=mapping"><i class="icon-organization"></i><span>Manajemen
                                                Level</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="?page=user"><i class="icon-user"></i>User</a>
                                    </li>
                                    <li>
                                        <a href="?page=gantipassword"><i class="icon-key"></i>Ganti Password</a>
                                    </li>
                                    <li>
                                        <a href="?page=logout"><i class="icon-logout"></i>Log Out</a>
                                    </li>
                                <?php } else if ($_SESSION['id_level'] == 2) { ?>
                                        <li>
                                            <a href="?page=user"><i class="icon-user"></i>User</a>
                                        </li>
                                        <li>
                                            <a href="?page=gantipassword"><i class="icon-key"></i>Ganti Password</a>
                                        </li>
                                        <li>
                                            <a href="?page=logout"><i class="icon-logout"></i>Log Out</a>

                                        </li>
                                    <?php } else { ?>
                                        <li>
                                            <a href="?page=gantipassword"><i class="icon-key"></i>Ganti Password</a>
                                        </li>
                                        <li>
                                            <a href="?page=logout"><i class="icon-logout"></i>Log Out</a>
                                        </li>
                                    <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--/ Header Right End -->
            </nav>
        </div>
        <!--/ Page Header End -->
        <!--================================-->
        <!-- Main Wrapper Start -->
        <!--================================-->
        <div id="main-wrapper">
            <!--================================-->
            <!-- Breadcrumb Start -->
            <!--================================-->
            <div class="pageheader pd-y-25 pd-x-25">
                <div class="pd-t-5 pd-b-5">
                    <h1 class="pd-0 mg-0 tx-20 text-overflow">
                        <?php echo $title ?>
                    </h1>
                </div>
                <div class="breadcrumb pd-0 mg-0">
                    <a class="breadcrumb-item" href="?page=dashboard""><i class=" icon ion-ios-home-outline"></i>
                        Home</a>
                    <a class="breadcrumb-item" href="javascript:void(0)">
                        <?php echo $title ?>
                    </a>
                </div>
            </div>
            <!--/ Breadcrumb End -->
            <!--================================-->
        </div>
        <!--/ Main Wrapper End -->