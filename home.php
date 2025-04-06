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
        <div class = "banner">
            <div class = "slides">
                <img src="../jewelry-shop/public/assets/images/homepage1.jpg" alt="banner">
                <img src="../jewelry-shop/public/assets/images/homepage2.jpg" alt="banner">
                <img src="../jewelry-shop/public/assets/images/homepage3.jpg" alt="banner">
            </div>
            <a class = "prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class = "next" onclick="plusSlides(1)">&#10095;</a>
        </div>
    <div class="container">
        <div class="header">
            <h1>Trang sức bạc ngọc trai tại Hà Nội</h1>
        </div>
        
        <div class="categories">
            <div class="category">
                <img src="../jewelry-shop//public//assets//images//gallery//vc.jpg" alt="Vòng cổ">
                <h3>Vòng cổ</h3>
            </div>
            <div class="category">
                <img src="../jewelry-shop//public//assets//images//gallery//hsj-pendant2.jpg" alt="Mặt dây chuyền">
                <h3>Mặt dây chuyền</h3>
            </div>
            <div class="category">
                <img src="../jewelry-shop//public//assets//images//gallery//hsj-earring.jpg" alt="Hoa tai">
                <h3>Hoa tai</h3>
            </div>
            <div class="category">
                <img src="../jewelry-shop//public//assets//images//gallery//hsj-ring2.jpg" alt="Nhẫn">
                <h3>Nhẫn</h3>
            </div>
            <div class="category">
                <img src="../jewelry-shop//public//assets//images//gallery//hsj-bracelet.jpg" alt="Vòng tay">
                <h3>Vòng tay</h3>
            </div>
            <div class="category">
                <img src="../jewelry-shop//public//assets//images//gallery//hsj-gold-jewelry.jpg" alt="Trang sức vàng">
                <h3>Trang sức vàng</h3>
            </div>
        </div>
        
        <!-- First featured section -->
        <div class="featured">
            <div class="featured-image">
                <img src="../jewelry-shop//public//assets//images//gallery//hsj_featured_02.jpg" alt="Nhẫn ngọc trai Tahiti">
            </div>
            <div class="featured-content">
                <h2>Kỳ diệu của thiên nhiên</h2>
                <p>Vẻ đẹp được săn đón của ngọc trai Tahiti trong trang sức hoa tinh xảo</p>
                <button class="btn">KHÁM PHÁ</button>
            </div>
        </div>
        
        <!-- Second featured section (reversed) -->
        <div class="featured featured-reversed">
            <div class="featured-image">
                <img src="../jewelry-shop//public//assets//images//gallery//hsj_featured_03.jpg" alt="Mặt dây chuyền ngọc trai Biển Nam">
            </div>
            <div class="featured-content">
                <h2>Sự tinh tế của ngọc trai Biển Nam Cổ điển</h2>
                <p>Thiết kế thủ công độc đáo tôn lên vẻ rạng rỡ tuyệt vời</p>
                <button class="btn">KHÁM PHÁ</button>
            </div>
        </div>
        
        <!-- New Arrivals Section -->
        <h2>Hàng Mới Về</h2>
        <div class="products">
            <div class="product">
                <div class="product-image">
                    <img src="../jewelry-shop//public//assets//images//gallery//2023-10-06-13-54-33-281x281.jpg" alt="Mặt dây chuyền nho bạc sterling Tourmaline">
                    <div class="product-actions">
                        <button type="submit" name="add_to_cart" class="action-btn">
                            <i class="fas fa-shopping-cart"></i>
                            Thêm vào giỏ hàng
                        </button>
                        <button type="submit" name="add_to_wishlist" class="action-btn">
                            <i class="fas fa-heart"></i>
                            Yêu thích
                        </button>
                    </div>
                </div>
                <h3>Mặt dây chuyền nho bạc sterling Tourmaline</h3>
                <div class="price">$60.00</div>
            </div>
        </div>
        
        <!-- Customer Care Section -->
        <h2>Chăm sóc khách hàng</h2>
        <div class="care-items">
            <div class="care-item">
                <img src="../jewelry-shop//public//assets//images//footer//tiffany-anthony-09bKHOZ29us-unsplash.jpg" alt="Kiến thức về ngọc trai">
                <h3>Kiến thức</h3>
            </div>
            <div class="care-item">
                <img src="../jewelry-shop//public//assets//images//footer//cornelia-ng-2zHQhfEpisc-unsplash.jpg" alt="Câu hỏi thường gặp">
                <h3>Câu hỏi thường gặp</h3>
            </div>
            <div class="care-item">
                <img src="../jewelry-shop//public//assets//images//footer//6fb530c3-ccea-4578-ae3e-2ec9175a9c32.jpg" alt="Chăm sóc sản phẩm">
                <h3>Chăm sóc sản phẩm</h3>
            </div>
        </div>
    </div>
    <?php include '../jewelry-shop/public/assets/components/user_footer.php'; ?>
    </main>
    <script src = "../jewelry-shop//public/assets/js/slider.js"></script>
</body>
</html>
