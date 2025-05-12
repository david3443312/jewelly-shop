<?php
    include "public/assets/components/connect.php";
    $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;
    
    // Lấy tham số category từ URL
    $category = isset($_GET['category']) ? $_GET['category'] : '';
    
    // Chuyển đổi category thành tên hiển thị
    $category_names = [
        'ring' => 'Nhẫn',
        'bracelet' => 'Vòng tay',
        'necklace' => 'Vòng cổ',
        'chain' => 'Dây chuyền',
        'earring' => 'Khuyên tai',
        'watch' => 'Đồng hồ'
    ];
    
    $title = isset($category_names[$category]) ? $category_names[$category] : 'Tất cả sản phẩm';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Jewelry Shop</title>
    <link rel="stylesheet" href="public/assets/css/user_header.css">
    <link rel="stylesheet" href="public/assets/css/styleshomepage.css">
    <link rel="stylesheet" href="public/assets/css/shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <link rel="icon" href="public/assets/images/logoicon.png" type="image/x-icon">
</head>
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    
    <div class="container">
        <h1 class="page-title"><?= $title ?></h1>
        <div class="breadcrumb">
            <a href="home.php">Trang chủ</a> / <a href="shop.php">Trang sức</a> / <a href="#"><?= $title ?></a>
        </div>
        <div class="filter-sort" style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
            <label for="sort-select" style="margin-right: 10px; font-weight: bold;">Sắp xếp:</label>
            <select id="sort-select" style="padding: 6px 12px; border-radius: 5px; border: 1px solid #ccc;">
                <option value="az">Tên (A-Z)</option>
                <option value="za">Tên (Z-A)</option>
                <option value="price-asc">Giá thấp đến cao</option>
                <option value="price-desc">Giá cao xuống thấp</option>
            </select>
        </div>
        <div class="product-grid">
            <?php
                // Truy vấn sản phẩm theo category nếu có
                if ($category) {
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE status = ? AND category = ?");
                    $select_products->execute(['active', $category]);
                } else {
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE status = ?");
                    $select_products->execute(['active']);
                }

                if ($select_products->rowCount() > 0) {
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="product-item">
                <input type="hidden" id="product-id-<?= $fetch_products['id']; ?>" value="<?= $fetch_products['id']; ?>">
                <div class="product-image">
                    <img src="public/assets/uploaded_files/<?= $fetch_products['image']; ?>" alt="<?= $fetch_products['name']; ?>">
                    <div class="product-actions">
                        <form action="public/assets/components/add_to_cart.php" method="post" class="action-form">
                            <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" name="add_to_cart" value="1" class="action-btn cart-btn">
                                <i class="fas fa-shopping-cart"></i>
                                Thêm vào giỏ hàng
                            </button>
                        </form>
                        <form action="public/assets/components/add_to_wishlist.php" method="post" class="action-form">
                            <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                            <button type="submit" name="add_to_wishlist" class="action-btn wishlist-btn">
                                <i class="fas fa-heart"></i>
                                Yêu thích
                            </button>
                        </form>
                    </div>
                </div>
                <h3 class="product-title"><?= $fetch_products['name']; ?></h3>
                <div class="product-price" style="font-size: 25px;"><?= number_format($fetch_products['price']); ?>đ</div>
            </div>
            <?php
                    }
                } else {
                    echo '<div class="empty">
                            <h1>Không có sản phẩm thuộc loại này!</h1>
                        </div>';
                }
            ?>
        </div>
    </div>
    <?php include "public/assets/components/user_footer.php"; ?>
    <?php include "public/assets/components/toast_message.php"; ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('form[action*="add_to_cart.php"]').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(form);
                // Always append add_to_cart=1 to ensure backend receives it
                formData.append('add_to_cart', '1');
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.text())
                .then(() => {
                    var toast = document.getElementById('toast-message');
                    var progress = document.getElementById('toast-progress');
                    toast.style.display = 'block';
                    setTimeout(() => {
                        toast.style.opacity = '1';
                        toast.style.transform = 'translateY(0)';
                        progress.style.width = '100%';
                        // Reset progress bar
                        progress.style.transition = 'none';
                        progress.offsetWidth; // force reflow
                        progress.style.transition = 'width 2.5s linear';
                        progress.style.width = '0%';
                    }, 10);

                    setTimeout(() => {
                        toast.style.opacity = '0';
                        toast.style.transform = 'translateY(40px)';
                        setTimeout(() => { toast.style.display = 'none'; }, 400);
                    }, 2500);
                });
            });
        });

        // Handle sorting products
        const sortSelect = document.getElementById('sort-select');
        const productGrid = document.querySelector('.product-grid');

        sortSelect.addEventListener('change', function() {
            const items = Array.from(productGrid.querySelectorAll('.product-item'));
            let sortedItems = [];

            switch (this.value) {
                case 'az':
                    sortedItems = items.sort((a, b) => 
                        a.querySelector('.product-title').textContent.localeCompare(
                            b.querySelector('.product-title').textContent, 'vi', {sensitivity: 'base'}
                        )
                    );
                    break;
                case 'za':
                    sortedItems = items.sort((a, b) => 
                        b.querySelector('.product-title').textContent.localeCompare(
                            a.querySelector('.product-title').textContent, 'vi', {sensitivity: 'base'}
                        )
                    );
                    break;
                case 'price-asc':
                    sortedItems = items.sort((a, b) => 
                        parseInt(a.querySelector('.product-price').textContent.replace(/[^\d]/g, '')) -
                        parseInt(b.querySelector('.product-price').textContent.replace(/[^\d]/g, ''))
                    );
                    break;
                case 'price-desc':
                    sortedItems = items.sort((a, b) => 
                        parseInt(b.querySelector('.product-price').textContent.replace(/[^\d]/g, '')) -
                        parseInt(a.querySelector('.product-price').textContent.replace(/[^\d]/g, ''))
                    );
                    break;
            }

            // Xóa và thêm lại các sản phẩm đã sắp xếp
            sortedItems.forEach(item => productGrid.appendChild(item));
        });

    });
    document.querySelectorAll('form[action*="add_to_wishlist.php"]').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(() => {
                var toast = document.getElementById('toast-wishlist');
                var progress = document.getElementById('toast-wishlist-progress');
                toast.style.display = 'block';
                setTimeout(() => {
                    toast.style.opacity = '1';
                    toast.style.transform = 'translateY(0)';
                    progress.style.width = '100%';
                    // Reset progress bar
                    progress.style.transition = 'none';
                    progress.offsetWidth; // force reflow
                    progress.style.transition = 'width 2.5s linear';
                    progress.style.width = '0%';
                }, 10);

                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(40px)';
                    setTimeout(() => { toast.style.display = 'none'; }, 400);
                }, 2500);
            });
        });
    });
    </script>
</body>
</html>