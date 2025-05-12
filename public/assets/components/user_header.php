<?php
// Bắt đầu session nếu chưa được bắt đầu
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Make sure we have database connection
if (!isset($conn) || $conn === null) {
    include_once __DIR__ . '/../components/connect.php';
}

// Kiểm tra đăng nhập bằng cả cookie và session để đảm bảo chính xác
$user_id = null;
if (isset($_COOKIE['user_id']) && !empty($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} elseif (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

// Nới lỏng việc kiểm tra để đảm bảo $user_id hoạt động đúng
$user_id = ($user_id !== null && $user_id !== '') ? $user_id : null;
?>

<!-- Rest of the header remains the same -->
<header class="header-area">
    <nav>
        <a href="/jewelry-shop/home.php">
            <img src="public/assets/images/logoicon.png" alt="Brand logo" class="logo" style="width: 50px; height: 50px;">
        </a>
        <ul class="menu">
            <li><a href="/jewelry-shop/home.php">Trang chủ</a></li>
            <li class="dropdown-category">
                <a href="category.php">Trang sức</a>
                <div class="submenu">
                    <div>
                        <h3>Chủng loại</h3>
                        <ul>
                            <li><a href="/jewelry-shop/products.php?category=ring">Nhẫn</a></li>
                            <li><a href="/jewelry-shop/products.php?category=bracelet">Vòng tay</a></li>
                            <li><a href="/jewelry-shop/products.php?category=necklace">Vòng cổ</a></li>
                            <li><a href="/jewelry-shop/products.php?category=chain">Dây chuyền</a></li>
                            <li><a href="/jewelry-shop/products.php?category=earring">Khuyên tai</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3>Chất liệu</h3>
                        <ul>
                            <li><a href="#">Vàng</a></li>
                            <li><a href="#">Bạc</a></li>
                            <li><a href="#">Kim cương</a></li>
                            <li><a href="#">Ngọc trai</a></li>
                            <li><a href="#">Platinum</a></li>
                            <li><a href="#">Titanium</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3>Trang sức dịp đặc biệt</h3>
                        <ul>
                            <li><a href="#">Trang sức cưới, cầu hôn</a></li>
                            <li><a href="#">Trang sức may mắn</a></li>
                            <li><a href="#">Trang sức kỷ niệm</a></li>
                            <li><a href="#">Trang sức phong thủy</a></li>
                            <li><a href="#">Trang sức Sắc Xuân</a></li>
                            <li><a href="#">Trang sức ngày vía thần tài</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3>Thiết kế riêng</h3>
                        <ul>
                            <li><a href="/jewelry-shop/couple_design.php">Đặt trang sức đôi</a></li>
                            <li><a href="/jewelry-shop/group_design.php">Đặt trang sức theo nhóm</a></li>
                            <li><a href="/jewelry-shop/custom_design.php">Đặt trang sức thiết kế theo yêu cầu</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="dropdown-category"><a>Bộ sưu tập</a>
                <div class="submenu submenu2">
                    <div>
                        <ul>
                            <li><a href="knowledge_1.php">Ngọc Trai Nước Ngọt</a></li>
                            <li><a href="knowledge_2.php">Ngọc Trai Biển Nam</a></li>
                            <li><a href="knowledge_3.php">Ngọc Trai Tahiti</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li><a href="about_us.php">Về chúng tôi</a></li>
            <li class="dropdown-category"><a>Bài viết</a>
                <div class="submenu submenu1">
                    <div>
                        <ul>
                            <li><a href="knowlwdge.php">Kiến thức</a></li>
                            <li><a href="FAQ.php">Câu hỏi thường gặp</a></li>
                            <li><a href="#">Chăm sóc sản phẩm</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li><a href="contact.php">Liên hệ</a></li>
        </ul>
        <div class="icons">
            <a href="/jewelry-shop/wishlist.php" class="wishlist-link">
                <span class="iconify" data-icon="ph:heart" style="height: 150%; width: 150%; color: #7D6E5D;"></span>
            </a>
            <a href="/jewelry-shop/cart.php" class="cart-link">
                <span class="iconify" data-icon="fluent:cart-20-regular" style="height: 150%; width: 150%;"></span>
                <?php
                // Đếm số sản phẩm trong giỏ hàng
                if ($user_id) {
                    try {
                        $cart_count_query = $conn->prepare("SELECT SUM(quantity) as cart_count FROM `cart` WHERE user_id = ?");
                        $cart_count_query->execute([$user_id]);
                        $cart_count = $cart_count_query->fetch(PDO::FETCH_ASSOC)['cart_count'] ?? 0;
                        
                        // Hiển thị số sản phẩm nếu có ít nhất 1 sản phẩm trong giỏ
                        if ($cart_count > 0) {
                            echo '<span class="cart-count">' . $cart_count . '</span>';
                        }
                    } catch(Exception $e) {
                        // Xử lý lỗi nếu cần
                    }
                }
                ?>
            </a>            <div class="search">
                <input type="text" placeholder="Tìm kiếm...">
                <button><span class="iconify" data-icon="ph:magnifying-glass"></span></button>
            </div>
            <div class="account-container">
                <div class="account-icon">
                    <?php if ($user_id): ?>
                        <a href="/jewelry-shop/user_profile.php"><span class="iconify" data-icon="codicon:account" style="height: 95%; width: 95%;"></span></a>
                    <?php else: ?>
                        <a href="/jewelry-shop/signup.php"><span class="iconify" data-icon="codicon:account" style="height: 95%; width: 95%;"></span></a>
                    <?php endif; ?>
                </div>
                <div class="dropdown-menu">                    <?php
                    if ($user_id) { // Người dùng đã đăng nhập
                    ?>
                        <li><a href="/jewelry-shop/user_profile.php"><i class="fi fi-rs-sign-in mr-10"></i>Hồ sơ</a></li>
                        <li><a href="/jewelry-shop/user_logout.php" onclick="return confirm('Chúng tôi sẽ rất nhớ bạn!');"><i class="fi fi-rs-sign-out mr-10"></i>Đăng xuất</a></li>
                    <?php
                    } else { // Người dùng chưa đăng nhập
                    ?>
                        <li><a href="login.php"><i class="fi fi-rs-sign-in mr-10"></i>Đăng nhập</a></li>
                        <li><a href="signup.php"><i class="fi fi-rs-user-add mr-10"></i>Đăng ký</a></li>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
</header>