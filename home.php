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
        <link rel="stylesheet" href="public/assets/css/slider.css">
        <link rel="stylesheet" href="public/assets/css/shop.css">
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
    <div class="slider-container">
        <div class="slider">
            <div class="slide active">
                <div class="slide-image" style="background-image: url('../jewelry-shop/public/assets/images/homepage1.jpg');"></div>
                <div class="overlay"></div>
                <div class="slide-content">
                    <h2 class="slide-title">Innovative & Timeless Jewellery</h2>
                    <p class="slide-subtitle">Since 1990</p>
                </div>
            </div>
            <div class="slide">
                <div class="slide-image" style="background-image: url('../jewelry-shop/public/assets/images/2.webp');"></div>
                <div class="overlay"></div>
                <div class="slide-content">
                    <h2 class="slide-title">Exquisite Pearl Collections</h2>
                    <p class="slide-subtitle">Elegance in Every Detail</p>
                </div>
            </div>
            <div class="slide">
                <div class="slide-image" style="background-image: url('../jewelry-shop/public/assets/images/3.webp');"></div>
                <div class="overlay"></div>
                <div class="slide-content">
                    <h2 class="slide-title">Handcrafted Diamond Pieces</h2>
                    <p class="slide-subtitle">For Moments That Last Forever</p>
                </div>
            </div>
        </div>

        <div class="slider-controls">
            <div class="slider-dot active" data-index="0"></div>
            <div class="slider-dot" data-index="1"></div>
            <div class="slider-dot" data-index="2"></div>
        </div>

        <div class="slider-arrows">
            <div class="slider-arrow prev">
                <svg viewBox="0 0 24 24">
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"></path>
                </svg>
            </div>
            <div class="slider-arrow next">
                <svg viewBox="0 0 24 24">
                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
                </svg>
            </div>
        </div>
    </div>

  
        <div class="container">
            <div class = "quote">
                <h1 style="font-family: Great Vibes, cursive; font-size: 50px"> <b>"Wearing jewelry is the way to express who you are... without saying a word."</b></h1>
                <p>Đeo trang sức là cách thể hiện bạn mà không cần một lời nói nào.</p>
            </div>  
            <div class="header">
                <h1><b>Chúng tôi có những loại trang sức nào?</b></h1>
            </div>
            
            <div class="categories">
                <a href="/jewelry-shop/products.php?category=necklace" class="category">
                    <img src="../jewelry-shop//public//assets//images//gallery//vc.jpg" alt="Vòng cổ">
                    <h3>Vòng cổ</h3>
                </a>
                <a href="/jewelry-shop/products.php?category=chain" class="category">
                    <img src="../jewelry-shop//public//assets//images//gallery//hsj-pendant2.jpg" alt="Mặt dây chuyền">
                    <h3>Mặt dây chuyền</h3>
                </a>
                <a href="/jewelry-shop/products.php?category=earring" class="category">
                    <img src="../jewelry-shop//public//assets//images//gallery//hsj-earring.jpg" alt="Hoa tai">
                    <h3>Hoa tai</h3>
                </a>
                <a href="/jewelry-shop/products.php?category=ring" class="category">
                    <img src="../jewelry-shop//public//assets//images//gallery//hsj-ring2.jpg" alt="Nhẫn">
                    <h3>Nhẫn</h3>
                </a>
                <a href="/jewelry-shop/products.php?category=bracelet" class="category">
                    <img src="../jewelry-shop//public//assets//images//gallery//hsj-bracelet.jpg" alt="Vòng tay">
                    <h3>Vòng tay</h3>
                </a>
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
        
       ` <!-- Second featured section (reversed) -->
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
        <div class="new-arrivals-slider-container">
            <button class="slider-arrow prev" id="new-arrivals-prev">&#10094;</button>
            <div class="new-arrivals-slider" id="new-arrivals-slider">
                <?php
                    $new_arrivals = $conn->prepare("SELECT * FROM products WHERE status = 'active' ORDER BY stock DESC, id DESC LIMIT 12");
                    $new_arrivals->execute();
                    while ($product = $new_arrivals->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="product-item">
                    <div class="product-image">
                        <img src="public/assets/uploaded_files/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                        <div class="product-actions">
                            <form action="public/assets/components/add_to_cart.php" method="post" class="action-form">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" name="add_to_cart" value="1" class="action-btn cart-btn">
                                    <i class="fas fa-shopping-cart"></i>
                                    Thêm vào giỏ hàng
                                </button>
                            </form>
                            <form action="public/assets/components/add_to_wishlist.php" method="post" class="action-form">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <button type="submit" name="add_to_wishlist" class="action-btn wishlist-btn">
                                    <i class="fas fa-heart"></i>
                                    Yêu thích
                                </button>
                            </form>
                        </div>
                    </div>
                    <h3 class="product-title"><?= htmlspecialchars($product['name']) ?></h3>
                    <div class="product-price"><?= number_format($product['price']) ?>đ</div>
                </div>
                <?php } ?>
            </div>
            <button class="slider-arrow next" id="new-arrivals-next">&#10095;</button>
        </div>
        
        <!-- Customer Care Section -->
        <h2>Chăm sóc khách hàng</h2>
        <div class="care-items">
                <div class="care-item">
                    <a href="knowlwdge.php">
                        <img src="../jewelry-shop//public//assets//images//footer//tiffany-anthony-09bKHOZ29us-unsplash.jpg" alt="Kiến thức về ngọc trai">
                    </a>
                    <h3>Kiến thức</h3>
                </div>
            <div class="care-item">
                <a href="FAQ.php">
                    <img src="../jewelry-shop//public//assets//images//footer//cornelia-ng-2zHQhfEpisc-unsplash.jpg" alt="Câu hỏi thường gặp">
                </a>
                <h3>Câu hỏi thường gặp</h3>
            </div>
            <div class="care-item">
                <img src="../jewelry-shop//public//assets//images//footer//6fb530c3-ccea-4578-ae3e-2ec9175a9c32.jpg" alt="Chăm sóc sản phẩm">
                <h3>Chăm sóc sản phẩm</h3>
            </div>
        </div>
    </div>
    <?php include '../jewelry-shop/public/assets/components/user_footer.php'; ?>
    <?php include "public/assets/components/toast_message.php"; ?>
    </main>
    <script src="../jewelry-shop/public/assets/js/slider.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('new-arrivals-slider');
        const prevBtn = document.getElementById('new-arrivals-prev');
        const nextBtn = document.getElementById('new-arrivals-next');
        const scrollAmount = 280; // px, tùy chỉnh theo min-width sản phẩm
    
        prevBtn.addEventListener('click', () => {
            slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });
        nextBtn.addEventListener('click', () => {
            slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });

        // Xử lý toast cho form thêm giỏ hàng và yêu thích trong slider
        slider.querySelectorAll('form[action*="add_to_cart.php"]').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(form);
                formData.append('add_to_cart', '1'); // thêm dòng này!
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.text())
                .then(() => {
                    showToast('cart');
                });
            });
        });
        slider.querySelectorAll('form[action*="add_to_wishlist.php"]').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(form);
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.text())
                .then(() => {
                    showToast('wishlist');
                });
            });
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('new-arrivals-slider');
        const prevBtn = document.getElementById('new-arrivals-prev');
        const nextBtn = document.getElementById('new-arrivals-next');
        const scrollAmount = 280;

        prevBtn.addEventListener('click', () => {
            slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });
        nextBtn.addEventListener('click', () => {
            slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });

        // Kéo ngang bằng chuột hoặc cảm ứng
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 1.2; // tốc độ kéo
            slider.scrollLeft = scrollLeft - walk;
        });

        // Hỗ trợ cảm ứng trên mobile
        slider.addEventListener('touchstart', (e) => {
            isDown = true;
            startX = e.touches[0].pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('touchend', () => {
            isDown = false;
        });
        slider.addEventListener('touchmove', (e) => {
            if (!isDown) return;
            const x = e.touches[0].pageX - slider.offsetLeft;
            const walk = (x - startX) * 1.2;
            slider.scrollLeft = scrollLeft - walk;
        });
    });
    </script>
</body>
</html>
