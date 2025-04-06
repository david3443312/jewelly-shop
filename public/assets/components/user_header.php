<header class="header-area">
    <nav>
        <img src="public/assets/images/logoicon.png" alt="Brand logo" class="logo" style = "width: 50px; height: 50px;">
        <ul class="menu">
            <li><a href="home.php">Trang chủ</a></li>
            <li><a href="shop.php">Trang sức</a></li>
            <li><a href="#">Bộ sưu tập</a></li>
            <li><a href="#">Về chúng tôi</a></li>
            <li><a href="#">Danh sách cửa hàng</a></li>
            <li><a href="#">Liên hệ</a></li>
        </ul>
        <div class="icons">
            <a href="/jewelry-shop/cart.php"><span class="iconify" data-icon="fluent:cart-20-regular" style="height: 150%; width: 150%;"></span></a>
            <div class="search">
                <input type="text" placeholder="Tìm kiếm...">
                <button><span class="iconify" data-icon="ph:magnifying-glass"></span></button>
            </div>
            <div class="account-container">
                <div class="account-icon">
                <!-- <img src="path-to-your-account-icon.svg" alt="Account"> -->
                <a href="signup.html"><span class="iconify" data-icon="codicon:account" style="height: 95%; width: 95%;"></span></a>
                </div>
                <div class="dropdown-menu">
                <li><a href="profile.php"><i class="fi fi-rs-sign-in mr-10"></i>Hồ sơ</a></li>
                <?php
                    if ($user_id) { // Chỉ thực hiện truy vấn nếu $user_id tồn tại
                        $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                        $select_profile->execute([$user_id]);
                        if ($select_profile->rowCount() > 0) {
                            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                <li><a href="../components/user_logout.php" onclick="return confirm('Logout from this website?');"><i class="fi fi-rs-sign-out mr-10"></i>Đăng xuất</a></li>
                <?php
                    } else {
                ?>
                <li><a href="login.php"><i class="fi fi-rs-sign-in mr-10"></i>Đăng nhập</a></li>
                <?php
                    }
                } else {
                ?>
                <li><a href="login.php"><i class="fi fi-rs-sign-in mr-10"></i>Đăng nhập</a></li>
                <?php
                    }
                ?>
                </div>
            </div>
            <!-- <a href="signup.html"><span class="iconify" data-icon="codicon:account" style="height: 95%; width: 95%;"></span></a> -->
        </div>
    </nav>
 </header>
 