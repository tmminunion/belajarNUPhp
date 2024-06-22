<body class="">
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand pt-0" href="<?= getBaseUrl(); ?>">
                <img src="<?= getBaseUrl(); ?>assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>

            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <?= App\Helper\SideMenu::render();?>
                <!-- Navigation -->

                <hr class="my-3">
                
               
                <h6 class="navbar-heading text-muted">Tabungan Tours</h6>
              
              <?= App\Helper\SideMenuTab::render();?>
              
              
                

            </div>
        </div>
    </nav>

    <div class="main-content" style="
    background: #7474BF; /* Fallback for old browsers */
    background: -webkit-linear-gradient(to right, #348AC7, #7474BF); /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #348AC7, #7474BF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
">

        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark bg-default" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="<?= getBaseUrl(); ?>">
                    <img src="<?= getBaseUrl(); ?>assets/img/logo.png" class="navbar-brand-img" height="50" alt="...">
                </a>
                <!-- Form -->

                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <?php if (isLogin()) { ?>
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <div class="media-body mr-3 d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold"><?= member_login()->nama; ?></span>
                                    </div>
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="data:image/png;base64,<?= member_login()->gambar;  ?>" height="35">
                                    </span>

                                </div>
                            </a>
                        <?php } ?>
                       <nu-card-profilmenu></nu-card-profilmenu>
                      
                       <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <a href="<?= getBaseUrl()?>profil" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>My profile</span>
                            </a>
                            <a href="./examples/profile.html" class="dropdown-item">
                                <i class="ni ni-settings-gear-65"></i>
                                <span>Settings</span>
                            </a>
                            <a href="./examples/profile.html" class="dropdown-item">
                                <i class="ni ni-calendar-grid-58"></i>
                                <span>Activity</span>
                            </a>
                            <a href="./examples/profile.html" class="dropdown-item">
                                <i class="ni ni-support-16"></i>
                                <span>Support</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= getBaseUrl()?>auth/logout" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>