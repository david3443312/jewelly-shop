<?php
    include "public/assets/components/connect.php";
    session_start();
    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
    } else {
        header('location: login.php');
        exit();
    }
    
    // Truy vấn thông tin người dùng
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ người dùng - Jewelry Shop</title>
    <link rel="stylesheet" href="public/assets/css/user_header.css">
    <link rel="stylesheet" href="public/assets/css/user_profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
</head>
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    <main>
        <div class="profile-container">
            <div class="sidebar">
                <ul>
                    <li onclick="showSection('notifications')">Thông báo</li>
                    <li onclick="showSection('personal-info')">Thông tin cá nhân</li>
                    <li onclick="showSection('orders')">Đơn mua</li>
                </ul>
            </div>
            <div class="content">
                <!-- Thông báo -->
                <div id="notifications" class="section">
                    <h2>Thông báo</h2>
                    <ul class="notification-list">
                        <li>Thông báo 1: Đơn hàng của bạn đã được giao.</li>
                        <li>Thông báo 2: Đơn hàng của bạn đang được xử lý.</li>
                        <li>Thông báo 3: Ưu đãi đặc biệt dành cho bạn!</li>
                    </ul>
                </div>
                
                <!-- Thông tin cá nhân -->
                <div id="personal-info" class="section hidden">
                    <h2>Thông tin cá nhân</h2>
                    <p><strong>Username:</strong> <?= $userInfo['username'] ?? 'N/A'; ?></p>
                    <p><strong>Họ tên:</strong> <?= $userInfo['name'] ?? 'N/A'; ?></p>
                    <p><strong>Email:</strong> <?= $userInfo['email'] ?? 'N/A'; ?></p>
                    <p><strong>Số điện thoại:</strong> <?= $userInfo['phone'] ?? 'N/A'; ?></p>
                    <!-- Có thể bổ sung các chức năng khác như sổ địa chỉ, đổi địa chỉ... -->
                </div>
                
                <!-- Đơn mua -->
                <div id="orders" class="section hidden">
                    <h2>Đơn mua</h2>
                    <ul class="order-list">
                        <li>
                            <p><strong>Mã đơn hàng:</strong> #12345</p>
                            <p><strong>Sản phẩm:</strong> Nhẫn vàng 24k</p>
                            <p><strong>Trạng thái:</strong> Đã giao</p>
                        </li>
                        <li>
                            <p><strong>Mã đơn hàng:</strong> #67890</p>
                            <p><strong>Sản phẩm:</strong> Dây chuyền bạc</p>
                            <p><strong>Trạng thái:</strong> Đang xử lý</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.section').forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(sectionId).classList.remove('hidden');
        }
    </script>
</body>
</html>