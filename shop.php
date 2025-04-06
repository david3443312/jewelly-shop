<?php
    include "public/assets/components/connect.php";

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
    <div class="container">
        <h1 class="page-title">Necklaces</h1>
        <div class="breadcrumb">
            <a href="#">Home</a> / <a href="#">Jewellery</a> / <a href="#">Necklaces</a>
        </div>
        
        <div class="filter-sort">
            <div>
                <button class="filter-button">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.5 10H3.5C3.22 10 3 10.22 3 10.5C3 10.78 3.22 11 3.5 11H6.5C6.78 11 7 10.78 7 10.5C7 10.22 6.78 10 6.5 10Z" fill="#333"/>
                        <path d="M12.5 5H9.5C9.22 5 9 5.22 9 5.5C9 5.78 9.22 6 9.5 6H12.5C12.78 6 13 5.78 13 5.5C13 5.22 12.78 5 12.5 5Z" fill="#333"/>
                        <path d="M14.5 10H9.5C9.22 10 9 10.22 9 10.5C9 10.78 9.22 11 9.5 11H14.5C14.78 11 15 10.78 15 10.5C15 10.22 14.78 10 14.5 10Z" fill="#333"/>
                        <path d="M6.5 5H1.5C1.22 5 1 5.22 1 5.5C1 5.78 1.22 6 1.5 6H6.5C6.78 6 7 5.78 7 5.5C7 5.22 6.78 5 6.5 5Z" fill="#333"/>
                    </svg>
                    Filter
                </button>
                <span class="results-count">Showing 1–20 of 151 results</span>
            </div>
            
            <div class="sort-container">
                <select class="sort-dropdown">
                    <option>Sắp xếp theo mới nhất</option>
                    <option>Sắp xếp theo giá: từ thấp đến cao</option>
                    <option>Sắp xếp theo giá: từ cao đến thấp</option>
                    <option>Sắp xếp theo độ phổ biến</option>
                </select>
                <div class="view-options">
                    <button class="grid-view active">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="1" y="1" width="6" height="6" stroke="#333"/>
                            <rect x="9" y="1" width="6" height="6" stroke="#333"/>
                            <rect x="1" y="9" width="6" height="6" stroke="#333"/>
                            <rect x="9" y="9" width="6" height="6" stroke="#333"/>
                        </svg>
                    </button>
                    <button class="list-view">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="1" y="1" width="14" height="3" stroke="#333"/>
                            <rect x="1" y="6" width="14" height="3" stroke="#333"/>
                            <rect x="1" y="11" width="14" height="3" stroke="#333"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="product-grid">
            <!-- Row 1 -->
            <?php
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE status = ?");
                $select_products->execute(['active']);

                if ($select_products->rowCount() > 0) {
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                    
            ?>
            <form action="public/assets/components/add_to_cart.php" method="post" class="product-item <?php if($fetch_products['stock'] == 0){echo "disable";} ?>">
                <!-- Thêm input ẩn để lưu product_id -->
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <input type="hidden" name="quantity" value="1">
                
                <div class="product-image">
                    <img src="../jewelry-shop//public//assets//uploaded_files/<?= $fetch_products['image']; ?>" alt="No image found">
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
                <div class="product-price"><?= $fetch_products['price']; ?></div>
            </form>
            <?php
            }
            }else {
                echo '<div class="empty">
                            <h1>No products available</h1>
                        </div>';
            }
        ?>
        </div>
        
        <div class="pagination">
            <span class="current">1</span>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <span>...</span>
            <a href="#">6</a>
            <a href="#">7</a>
            <a href="#">8</a>
            <a href="#">→</a>
        </div>
    </div>
    
    <?php include "public/assets/components/user_footer.php"; ?>
</body>
</html>