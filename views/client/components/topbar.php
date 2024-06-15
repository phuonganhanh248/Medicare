
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
        <div class="align-items-center d-none d-md-flex">
            <i class="bi bi-clock"></i> Thứ Hai - Thứ Sáu, 8AM - 6PM
        </div>
        <div class="d-flex align-items-center">
            <i class="bi bi-phone"></i> Liên hệ ngay! 090 7676 195
        </div>
        <div>
            <?php
            if (!isset($_SESSION['user_phone'])) {
                echo
                '<a href="http://localhost/Medicare/index.php?controller=home&action=login" class="navbar order-last order-lg-0" style="color:white;">
                  <i style="color: white;" class="fa fa-sign-in" aria-hidden="true"></i>
                  Đăng nhập
                </a>';
            }
            ?>
        </div>
    </div>
</div>