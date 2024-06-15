<nav class="navbar navbar-expand fixed-top be-top-header">
    <div class="container-fluid">
        <div class="be-navbar-header">
            <a href="http://localhost/Medicare/index.php?controller=home&action=home_admin" class="ml-5">
                <img src="assets/img/Medicare.png" alt="logo" width="150">
            </a>
        </div>
        <div class="page-title"><span>Bảng điều khiển</span></div>
        <div class="be-right-navbar">
            <!--            tai khoan-->
            <ul class="nav navbar-nav float-right be-user-nav">
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                                                 role="button" aria-expanded="false"><img
                            src="<?php echo $_SESSION['admin_avt'] ?>" alt="Avatar"><span class="user-name">Túpac Amaru</span></a>
                    <div class="dropdown-menu" role="menu">
                        <div class="user-info">
                            <div class="user-name"><?php echo $_SESSION['admin_name'] ?></div>
                            <div class="user-position online">Hoạt động</div>
                        </div>
                        <a class="dropdown-item" href="pages-profile.html">
                            <span class="icon mdi mdi-face"></span>Tài khoản
                        </a>
                        <a class="dropdown-item" href="#">
                            <span class="icon mdi mdi-settings"></span>Cài đặt
                        </a>
                        <a class="dropdown-item" href="http://localhost/Medicare/index.php?controller=auth&action=logout">
                            <span class="icon mdi mdi-power"></span>Đăng xuất
                        </a>
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav float-right be-icons-nav">
                <li class="nav-item dropdown"><a class="nav-link be-toggle-right-sidebar" href="#" role="button"
                                                 aria-expanded="false"><span
                            class="icon mdi mdi-settings"></span></a></li>
                <!--              thong bao-->
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                                                 role="button" aria-expanded="false"><span
                            class="icon mdi mdi-notifications"></span><span class="indicator"></span></a>
                    <ul class="dropdown-menu be-notifications">
                        <li>
                            <div class="title">Notifications<span class="badge badge-pill">3</span></div>
                            <div class="list">
                                <div class="be-scroller-notifications">
                                    <div class="content">
                                        <ul>
                                            <li class="notification notification-unread"><a href="#">
                                                    <div class="image"><img src="http://localhost/Medicare/views/admin/assets\img\avatar2.png" alt="Avatar">
                                                    </div>
                                                    <div class="notification-info">
                                                        <div class="text"><span class="user-name">Jessica Caruso</span>
                                                            accepted your invitation to join the team.
                                                        </div>
                                                        <span class="date">2 min ago</span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="footer"><a href="#">View all notifications</a></div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>