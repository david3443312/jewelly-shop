<?php
    include 'public/assets/components/connect.php';
    $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;

    if(!$user_id) {
        header('Location: login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm yêu thích - Jewelry Shop</title>
    <link rel="stylesheet" href="public/assets/css/user_header.css">
    <link rel="stylesheet" href="public/assets/css/styleshomepage.css">
    <link rel="stylesheet" href="public/assets/css/shop.css">
    <link rel="stylesheet" href="public/assets/css/stylewishlist.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <link rel="icon" href="public/assets/images/logoicon.png" type="image/x-icon">
    <style>
    .remove-wishlist-btn:hover {
        background: #f44336 !important;
        color: #fff !important;
        border-color: #f44336 !important;
    }
    </style>
</head>
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    <main>
        <div class="container">
            <h1 class="page-title">Danh sách yêu thích</h1>
            <div class="product-grid">
                <?php
                    // Get wishlist items
                    $wishlist_query = $conn->prepare("
                        SELECT w.*, p.name, p.price, p.image 
                        FROM `wishlist` w
                        JOIN `products` p ON w.product_id = p.id
                        WHERE w.user_id = ?
                        ORDER BY w.id DESC
                    ");
                    $wishlist_query->execute([$user_id]);
                    
                    if ($wishlist_query->rowCount() > 0) {
                        while ($item = $wishlist_query->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="product-item" data-product-id="<?= $item['product_id']; ?>">
                    <div class="product-image">
                        <img src="public/assets/uploaded_files/<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['name']); ?>">
                        <div class="product-actions">
                            <form action="public/assets/components/add_to_cart.php" method="post" class="add-to-cart-form">
                                <input type="hidden" name="product_id" value="<?= $item['product_id']; ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" name="add_to_cart" class="action-btn cart-btn">
                                    <i class="fas fa-shopping-cart"></i>
                                    Thêm vào giỏ hàng
                                </button>
                            </form>
                            <button class="action-btn remove-wishlist-btn" data-product-id="<?= $item['product_id']; ?>">
                                <i class="fas fa-trash"></i>
                                Xóa khỏi yêu thích
                            </button>
                        </div>
                    </div>
                    <h3 class="product-title"><?= htmlspecialchars($item['name']); ?></h3>
                    <div class="product-price"><?= number_format($item['price']); ?>đ</div>
                </div>
                <?php
                        }
                    } else {
                        echo '<div class="empty-wishlist">
                            <p>Danh sách yêu thích của bạn đang trống</p>
                            <a href="category.php" class="btn">Khám phá sản phẩm</a>
                        </div>';
                    }
                ?>
            </div>
        </div>
    </main>
    <?php include "public/assets/components/user_footer.php"; ?>
    <?php include "public/assets/components/toast_message.php"; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle add to cart via AJAX + toast
            document.querySelectorAll('.add-to-cart-form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(form);
                    formData.append('add_to_cart', '1');
                    fetch('public/assets/components/add_to_cart.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        showToast('cart');
                    })
                    .catch(() => {
                        alert('Có lỗi xảy ra, hãy thử lại.');
                    });
                });
            });
            // Handle removing items from wishlist via AJAX + toast
            document.querySelectorAll('.remove-wishlist-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const productItem = this.closest('.product-item');
                    fetch('public/assets/components/update_wishlist.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `product_id=${productId}&action=remove`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            productItem.remove();
                            showToast('remove');
                            // If wishlist is empty after remove, show empty state
                            if(document.querySelectorAll('.product-item').length === 0) {
                                document.querySelector('.product-grid').innerHTML = '<div class="empty-wishlist"><p>Danh sách yêu thích của bạn đang trống</p><a href="category.php" class="btn">Khám phá sản phẩm</a></div>';
                            }
                        } else {
                            alert('Không thể xóa sản phẩm.');
                        }
                    })
                    .catch(() => {
                        alert('Có lỗi xảy ra, hãy thử lại.');
                    });
                });
            });
        });
    </script>
</body>
</html>