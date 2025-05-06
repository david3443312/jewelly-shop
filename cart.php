<?php
    include 'public/assets/components/connect.php';
    $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;

    // Xử lý xóa sản phẩm khỏi giỏ hàng
    if(isset($_GET['remove']) && !empty($_GET['remove'])) {
        $product_id = $_GET['remove'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_NUMBER_INT);
        
        if($user_id && $product_id) {
            $delete_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ? AND product_id = ?");
            $delete_item->execute([$user_id, $product_id]);
            
            // Chuyển hướng về trang giỏ hàng sau khi xóa để làm mới trang
            header('Location: cart.php');
            exit();
        }
    }
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
                            ?>
                            <tr data-product-id="<?= $item['product_id']; ?>">
                                <td>
                                    <button type="button" class="remove-item" data-product-id="<?= $item['product_id']; ?>">×</button>
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
                                } // Đóng vòng lặp while ở đây
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
                            <td class="value product-total"><?= number_format($grand_total); ?>đ</td>
                        </tr>
                        <tr>
                            <td class="label"><b>Vận chuyển</b><br>Vui lòng điền thông tin vận chuyển của bạn:</td>
                        </tr>
                    </table>
                    <form action="public/assets/components/process_order.php" method="post" id="checkout-form">
                        <input type="hidden" name="shipping_cost" id="shipping-cost-input" value="0">
                        <input type="hidden" name="payment_method" value="COD">

                        <input type="hidden" id="city_text" name="city_text" value="">
                        <input type="hidden" id="district_text" name="district_text" value="">
                        <input type="hidden" id="ward_text" name="ward_text" value="">

                        <div class="shipping-info">
                            <div class="form-group">
                                <label for="full-name">Họ tên:</label>
                                <input type="text" id="full-name" name="full_name" placeholder="Nhập họ tên của bạn" required>
                            </div>
                            <div class="form-group">
                                <label for="phone-number">Số điện thoại:</label>
                                <input type="tel" id="phone-number" name="phone_number" placeholder="Nhập số điện thoại của bạn" required>
                            </div>
                            <div class="form-group">
                                <label for="city">Tỉnh/Thành phố:</label>
                                <select class="form-select" id="city" name="city" required>
                                    <option value="" selected>Chọn tỉnh thành</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="district">Quận/Huyện:</label>
                                <select class="form-select" id="district" name="district" required>
                                    <option value="" selected>Chọn quận huyện</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ward">Xã/Phường:</label>
                                <select class="form-select" id="ward" name="ward" required>
                                    <option value="" selected>Chọn phường xã</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="specific-address">Địa chỉ cụ thể (số nhà, toà nhà...):</label>
                                <input type="text" id="specific-address" name="specific_address" placeholder="Nhập địa chỉ cụ thể" required>
                            </div>
                            <div><button type="button" class="shipping-calculate">Tính phí vận chuyển</button></div>
                        </div>

                        <table class="totals-table">
                            <!-- <tr>
                                <td class="label">Khoảng cách vận chuyển</td>
                                <td class="value shipping-distance">Chưa tính</td>
                            </tr> -->
                            <tr>
                                <td class="label">Phí vận chuyển</td>
                                <td class="value shipping-cost">0đ</td>
                            </tr>
                            <tr class="grand-total-row">
                                <td class="label"><b>Tổng cộng</b></td>
                                <td class="value grand-total"><?= number_format($grand_total); ?>đ</td>
                            </tr>
                        </table>

                        <button type="submit" class="checkout-button">Đặt hàng</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="public/assets/js/cal_total_price.js"></script>
    <script src="public/assets/js/shipping_cal.js"></script>
    <script src="public/assets/js/remove_cart_items.js"></script>
    <script src="public/assets/js/vn_address_chooser.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDU6ZeC_LFIYbYc9YGtZOkgOc0TlEODdWw"></script>
</body>
</html>