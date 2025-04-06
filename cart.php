<?php
    include 'public/assets/components/connect.php';
    $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;

?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng - Jewelry Shop</title>
    <link rel="stylesheet" href="public/assets/css/user_header.css">
    <link rel="stylesheet" href="public/assets/css/stylescart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <link rel="icon" href="public/assets/images/logoicon.png" type="image/x-icon">
</head>
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    <main>
        <div class = "container"> 
            <h1 class = "cart-header">Giỏ hàng của bạn</h1>
            <div class = "cart-content">
                <div class = "cart-summary">
                    <h2 class="section-title">Giỏ hàng</h2>
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Khởi tạo biến tổng
                            $grand_total = 0;
                            // Lấy giỏ hàng của user hiện tại
                            $cart_query = $conn->prepare("
                                SELECT c.*, p.name, p.price, p.image 
                                FROM `cart` c 
                                JOIN `products` p ON c.product_id = p.id 
                                WHERE c.user_id = ?
                            ");
                            $cart_query->execute([$user_id]);

                            // Kiểm tra xem có sản phẩm trong giỏ hàng không
                            if ($cart_query->rowCount() > 0) {
                                // Hiển thị từng sản phẩm trong giỏ hàng
                                while ($item = $cart_query->fetch(PDO::FETCH_ASSOC)) {
                                    $sub_total = $item['price'] * $item['quantity'];
                                    $grand_total += $sub_total;
                                }
                            ?>
                            <tr data-product-id = "<?= $item['product_id']; ?>">
                                <td>
                                    <a href="cart.php?remove=<?= $item['product_id']; ?>" class="remove-item" onclick="return confirm('Xóa sản phẩm này?');">×</a>
                                </td>
                                <td>
                                    <img src="public/assets/uploaded_files/<?= $item['image']; ?>" alt="<?= $item['name']; ?>" class="product-image">
                                    <span class="product-name"><?= $item['name']; ?></span>
                                </td>
                                <td class="product-price"><?= number_format($item['price']); ?>đ</td>
                                <td class="product-quantity">
                                    <button class="quantity-button btn-decrement">-</button>
                                    <input type="text" value="<?= $item['quantity']; ?>" class="quantity-input" readonly>
                                    <button class="quantity-button btn-increment">+</button>
                                </td>
                                <td class="product-subtotal"><?= number_format($sub_total); ?>đ</td>
                            </tr>
                            <?php
                                }
                                if ($cart_query->rowCount() > 0) {
                            ?>
                            <tr class="cart-total-row">
                                <td colspan="4" style="text-align: right; font-weight: bold;">Tổng cộng:</td>
                                <td class="product-subtotal"><?= number_format($grand_total); ?>đ</td>
                            </tr>
                            <?php
                            } else {
                                echo '<tr><td colspan="5" class="cart-empty">Giỏ hàng của bạn đang trống</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="cart-buttons">
                        <div class="coupon-section">
                            <input type="text" placeholder="Nhập mã giảm giá" class="coupon-input">
                            <button class="coupon-button">Xác nhận</button>
                        </div>
                    </div>
                </div>
                <div class="cart-totals">
                    <h2 class="section-title">Tổng cộng:</h2>
                    <table class="totals-table">
                        <tr>
                            <td class="label">Tổng tiền sản phẩm</td>
                            <td class="value">123456đ</td>
                        </tr>
                        <tr>
                            <td class="label"><b>Vận chuyển</b><br>Vui lòng điền thông tin vận chuyển của bạn:</td>
                        </tr>
                    </table>
                    <div class="shipping-info">
                        <form class="shipping-form">
                            <div class="form-group">
                                <label for="full-name">Họ tên:</label>
                                <input type="text" id="full-name" name="full-name" placeholder="Nhập họ tên của bạn" required>
                            </div>
                            <div class="form-group">
                                <label for="phone-number">Số điện thoại:</label>
                                <input type="tel" id="phone-number" name="phone-number" placeholder="Nhập số điện thoại của bạn" required>
                            </div>
                            <div class="form-group">
                                <label for="city">Thành phố, tỉnh:</label>
                                <input type="text" id="city" name="city" placeholder="Nhập thành phố hoặc tỉnh" required>
                            </div>
                            <div class="form-group">
                                <label for="district">Quận, huyện:</label>
                                <input type="text" id="district" name="district" placeholder="Nhập quận hoặc huyện" required>
                            </div>
                            <div class="form-group">
                                <label for="ward">Xã, phường:</label>
                                <input type="text" id="ward" name="ward" placeholder="Nhập xã hoặc phường" required>
                            </div>
                            <div class="form-group">
                                <label for="specific-address">Địa chỉ cụ thể (số nhà, toà nhà...):</label>
                                <input type="text" id="specific-address" name="specific-address" placeholder="Nhập địa chỉ cụ thể" required>
                            </div>
                            <div><button href="#" class="shipping-calculate">Tính phí vận chuyển</button></div>
                        </form>
                    </div>
    
                    <table class="totals-table">
                        <tr>
                            <td class="label">Tổng cộng</td>
                            <td class="value">123456đ</td>
                        </tr>
                    </table>
    
                    <button class="checkout-button">Kiểm tra đơn hàng</button>
                </div>
            </div>
        </div>
    </main>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Lắng nghe sự kiện cho các nút tăng và giảm số lượng
        document.querySelectorAll('.btn-increment, .btn-decrement').forEach(button => {
            button.addEventListener('click', function() {
                // Lấy thẻ <tr> chứa nút này
                const tr = this.closest('tr');
                const productId = tr.dataset.productId;
                const quantityInput = tr.querySelector('.quantity-input');
                let currentQty = parseInt(quantityInput.value);

                // Nếu nút tăng
                if(this.classList.contains('btn-increment')) {
                    currentQty++;
                }
                // Nếu nút giảm
                else if (this.classList.contains('btn-decrement') && currentQty > 1) {
                    currentQty--;
                }

                // Cập nhật số lượng trên giao diện
                quantityInput.value = currentQty;

                // Gọi AJAX để cập nhật số lượng trong CSDL
                fetch('public/assets/components/update_cart_quantity.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'product_id=' + encodeURIComponent(productId) + '&new_quantity=' + encodeURIComponent(currentQty)
                })
                .then(response => response.json())
                .then(data => {
                    if(data.error) {
                        alert(data.error);
                    } else {
                        // Nếu cần, cập nhật lại tổng tiền của sản phẩm trong hàng
                        // hoặc gọi một hàm updateTotals();
                        console.log('Số lượng đã được cập nhật.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Có lỗi xảy ra, hãy thử lại.');
                });
            });
        });
    });
    </script>
</body>
</html>