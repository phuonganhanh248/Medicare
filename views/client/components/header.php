<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center gap-2">
      <a href="http://localhost/Medicare/index.php?controller=home&action=home#hero" class="logo me-auto">
        <img   src="assets/img/Medicare.png" alt="">
      </a>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="http://localhost/Medicare/index.php?controller=home&action=home#hero">Trang chủ</a></li>
          <li><a class="nav-link scrollto" href="http://localhost/Medicare/index.php?controller=home&action=home#about">Giới thiệu</a></li>
          <li><a class="nav-link scrollto" href="http://localhost/Medicare/index.php?controller=home&action=home#services">Chuyên khoa</a></li>
          <li><a class="nav-link scrollto" href="http://localhost/Medicare/index.php?controller=home&action=home#doctors">Bác sĩ</a></li>
            <li><a class="nav-link scrollto" href="http://localhost/Medicare/index.php?controller=home&action=home#contact">Liên hệ</a></li>
            <li><a class="nav-link scrollto" href="http://localhost/Medicare/index.php?controller=home&action=search_client">Tra cứu</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

      <a href="http://localhost/Medicare/index.php?controller=home&action=appointment"
         class="appointment-btn scrollto" style="text-decoration: none"><span class="d-none d-md-inline">ĐẶT LỊCH KHÁM</span></a>

        <?php
        if (isset($_SESSION['user_phone'])) {
            // Lấy số điện thoại người dùng từ session
            $username =  $_SESSION['user_name'];

            // Hiển thị số điện thoại người dùng
            echo '<div class="user-dropdown">
                    <div class="dropdown">
                      <a class="dropdown-toggle appointment-btn m-0"
                            style="background-color: #3FBBC0FF !important; border-color: #3FBBC0FF; color: whitesmoke"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Xin chào: ' . htmlspecialchars($username) . '
                      </a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="http://localhost/Medicare/index.php?controller=patient&action=profile">
                            <i class="fa-solid fa-user"></i>&nbsp;&nbsp;Thông tin cá nhân
                        </a></li>
                        <li><a class="dropdown-item" href="http://localhost/Medicare/index.php?controller=patient&action=history">
                            <i class="fa-solid fa-clock-rotate-left"></i>&nbsp;&nbsp;Lịch sử khám
                        </a></li>
                        <li>
                            <a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Đăng xuất
                            </a>
                        </li>
                      </ul>
                    </div>
                  </div>';
        }
        ?>
    </div>

  </header>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn đăng xuất không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger" onclick="logout()" >Đăng xuất</button>
            </div>
        </div>
    </div>
</div>
<script>
    function logout() {
        window.location.href = "http://localhost/Medicare/index.php?controller=home&action=logout";
    }
</script>
