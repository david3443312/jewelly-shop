<?php
    include '../jewelry-shop/public/assets/components/connect.php';

    $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;

?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trang chủ - Jewelry Shop</title>
        <link rel="stylesheet" href="public/assets/css/user_header.css">
        <link rel="stylesheet" href="public/assets/css/styleshomepage.css">
        <link rel="stylesheet" href="public/assets/css/knowledge_1.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
        <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
        <link rel="icon" href="../jewelry-shop/public/assets/images/logoicon.png" type="image/x-icon">
    </head>
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    <main>
        <div class="kn_header">
            <h1>Kiến Thức</h1>
        </div>
        
        <div class="container">
            <div class="pearl-grid">
                <!-- Row 1 -->
                <div class="pearl-card">
                    <a href="knowledge_1.php">
                        <img src="../jewelry-shop/public/assets/images/knowledge/1.jpg" alt="Trang sức ngọc trai nước ngọt" class="pearl-image">
                    </a>
                    <div class="pearl-info">
                        <h2 class="pearl-title">Ngọc Trai Nước Ngọt</h2>
                        <p class="pearl-date">28 tháng 4, 2022</p>
                    </div>
                </div>
                
                <div class="pearl-card">
                    <a href="knowledge_2.php">
                        <img src="../jewelry-shop/public/assets/images/knowledge/2.jpg" alt="Trang sức ngọc trai Biển Nam" class="pearl-image">
                    </a>
                    <div class="pearl-info">
                        <h2 class="pearl-title">Ngọc Trai Biển Nam</h2>
                        <p class="pearl-date">27 tháng 4, 2022</p>
                    </div>
                </div>
                
                <div class="pearl-card">
                    <a href="knowledge_3.php">
                        <img src="../jewelry-shop/public/assets/images/knowledge/3.jpg" alt="Trang sức ngọc trai Tahiti" class="pearl-image">
                    </a>
                    <div class="pearl-info">
                        <h2 class="pearl-title">Ngọc Trai Tahiti</h2>
                        <p class="pearl-date">27 tháng 4, 2022</p>
                    </div>
                </div>
                
                <!-- Row 2 -->
                <div class="pearl-card">
                    <a href="knowledge_4.php">
                        <img src="../jewelry-shop/public/assets/images/knowledge/4.jpg" alt="Ý nghĩa của ngọc trai" class="pearl-image">
                    </a>
                    <div class="pearl-info">
                        <h2 class="pearl-title">Ngọc Trai – Thuần Khiết, Rộng Lượng & Chính Trực</h2>
                        <p class="pearl-date">25 tháng 5, 2020</p>
                    </div>
                </div>
                
                <div class="pearl-card">
                    <a href="knowledge_5.php">
                        <img src="../jewelry-shop/public/assets/images/knowledge/5.jpg" alt="Trang sức ngọc trai bạc và vàng" class="pearl-image">
                    </a>
                    <div class="pearl-info">
                        <h2 class="pearl-title">Lựa Chọn Ngọc Trai, Bạc & Vàng</h2>
                        <p class="pearl-date">20 tháng 11, 2016</p>
                    </div>
                </div>
            </div>
        </div>
    <?php include '../jewelry-shop/public/assets/components/user_footer.php'; ?>
    </main>
    <script src = "../jewelry-shop//public/assets/js/slider.js"></script>
</body>
</html>
