<?php
include "public/assets/components/connect.php";
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy thông tin sản phẩm
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "<h2>Không tìm thấy sản phẩm!</h2>";
    exit;
}

// Map category code to name
$category_names = [
    'ring' => 'Nhẫn',
    'bracelet' => 'Vòng tay',
    'necklace' => 'Vòng cổ',
    'chain' => 'Dây chuyền',
    'earring' => 'Khuyên tai',
    'watch' => 'Đồng hồ'
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> - Jewelry Shop</title>
    <link rel="stylesheet" href="public/assets/css/user_header.css">
    <link rel="stylesheet" href="public/assets/css/shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="public/assets/images/logoicon.png" type="image/x-icon">
    <style>
        .product-detail-container {
            max-width: 1100px;
            margin: 120px auto 40px auto;
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.06);
            display: flex;
            gap: 40px;
            padding: 40px 30px;
        }
        .product-detail-image {
            flex: 1.2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }
        .product-detail-image img {
            width: 100%;
            max-width: 350px;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            background: #f9f9f4;
            object-fit: contain;
        }
        .product-detail-info {
            flex: 2;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        .product-detail-info h1 {
            font-size: 2.2rem;
            color: #3A5F41;
            margin-bottom: 10px;
        }
        .product-detail-info .category {
            font-size: 1.1rem;
            color: #b8860b;
            margin-bottom: 10px;
        }
        .product-detail-info .price {
            font-size: 2rem;
            color: #e91e63;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .product-detail-info .stock {
            font-size: 1rem;
            color: #888;
            margin-bottom: 10px;
        }
        .product-detail-info .desc {
            font-size: 1.1rem;
            color: #444;
            margin-bottom: 18px;
            white-space: pre-line;
        }
        .product-detail-actions {
            display: flex;
            gap: 16px;
            margin-top: 10px;
        }
        .product-detail-actions form, .product-detail-actions button {
            flex: 1;
        }
        @media (max-width: 900px) {
            .product-detail-container {
                flex-direction: column;
                padding: 20px 10px;
            }
            .product-detail-image img {
                max-width: 90vw;
            }
        }
    </style>
</head>
<body>
<?php include "public/assets/components/user_header.php"; ?>
<div class="product-detail-container">
    <div class="product-detail-image">
        <img src="public/assets/uploaded_files/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
    </div>
    <div class="product-detail-info">
        <h1><?= htmlspecialchars($product['name']) ?></h1>
        <div class="category"><b>Loại:</b> <?= $category_names[$product['category']] ?? $product['category'] ?></div>
        <div class="price"><?= number_format($product['price']) ?>đ</div>
        <div class="stock"><b>Tồn kho:</b> <?= (int)$product['stock'] ?></div>
        <div class="desc"><?= nl2br(htmlspecialchars($product['description'])) ?></div>
        <div class="product-detail-actions">
            <form action="public/assets/components/add_to_cart.php" method="post">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" name="add_to_cart" class="action-btn cart-btn">
                    <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
                </button>
            </form>
            <form action="public/assets/components/add_to_wishlist.php" method="post">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button type="submit" name="add_to_wishlist" class="action-btn wishlist-btn">
                    <i class="fas fa-heart"></i> Yêu thích
                </button>
            </form>
        </div>
    </div>
</div>
<?php include "public/assets/components/user_footer.php"; ?>
</body>
</html>