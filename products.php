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
            <form action="public/assets/components/add_to_cart.php" method="post" class="product-item">
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <input type="hidden" name="quantity" value="1">
                
                <div class="product-image">
                    <img src="public/assets/uploaded_files/<?= $fetch_products['image']; ?>" alt="<?= $fetch_products['name']; ?>">
                    <div class="product-actions">
                        <button type="submit" name="add_to_cart" class="action-btn cart-btn">
                            <i class="fas fa-shopping-cart"></i>
                            Thêm vào giỏ hàng
                        </button>
                        <button type="submit" name="add_to_wishlist" class="action-btn wishlist-btn">
                            <i class="fas fa-heart"></i>
                            Yêu thích
                        </button>
                    </div>
                </div>
                <h3 class="product-title"><?= $fetch_products['name']; ?></h3>
                <div class="product-price"><?= number_format($fetch_products['price']); ?>đ</div>
            </form>
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
</body>
</html>