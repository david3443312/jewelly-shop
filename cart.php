<?php
    include 'public/assets/components/connect.php';
    $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;

    // Thông tin cấu hình VNPay Sandbox
    $vnp_TmnCode = "VNPAYDEMO"; // Mã website demo của VNPAY
    $vnp_HashSecret = "MIKE01234567890"; // Secret key demo của VNPAY
    $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://localhost/jewelry-shop/cart.php?vnpay_return=1"; // Đường dẫn trả về sau khi thanh toán
    $vnp_apiUrl = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // API thanh toán của VNPay

    // Xử lý xóa sản phẩm khỏi giỏ hàng (giữ nguyên)
    if(isset($_GET['remove']) && !empty($_GET['remove'])) {
        $product_id = $_GET['remove'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_NUMBER_INT);

        if($user_id && $product_id) {
            $delete_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ? AND product_id = ?");
            $delete_item->execute([$user_id, $product_id]);

            header('Location: cart.php');
            exit();
        }
    }

    // Xử lý tạo yêu cầu thanh toán VNPay
    if (isset($_POST['create_vnpay_payment'])) {
        // Lấy thông tin đơn hàng (tổng tiền)
        $grand_total = 0;
        $cart_query = $conn->prepare("SELECT c.*, p.price FROM `cart` c JOIN `products` p ON c.product_id = p.id WHERE c.user_id = ?");
        $cart_query->execute([$user_id]);
        while ($item = $cart_query->fetch(PDO::FETCH_ASSOC)) {
            $sub_total = $item['price'] * $item['quantity'];
            $grand_total += $sub_total;
        }

        // Tạo thông tin thanh toán VNPay
        $vnp_TxnRef = date('YmdHis') . rand(000, 999); // Mã đơn hàng duy nhất
        $vnp_OrderInfo = "Thanh toan don hang #" . $vnp_TxnRef;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $grand_total * 100; // VNPay tính bằng đồng * 100
        $vnp_CurrCode = 'VND';
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_CurrCode" => $vnp_CurrCode,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_Locale" => $vnp_Locale,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_CreateDate" => date('YmdHis')
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= "?" . $query . "vnp_SecureHash=" . $vnp_SecureHash;

        // Chuyển hướng người dùng sang trang thanh toán VNPay
        // echo "<pre>";
        // print_r($vnp_Url);
        // echo "</pre>";
        // exit();
        header('Location: ' . $vnp_Url);
        exit();
    }

    // Xử lý kết quả trả về từ VNPay (nếu có)
    if (isset($_GET['vnpay_return'])) {
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                echo "<p style='color:green'>Giao dịch thanh toán thành công!</p>";
                // Thực hiện các hành động sau khi thanh toán thành công (ví dụ: cập nhật đơn hàng, xóa giỏ hàng)
                // Lưu ý: Bạn cần có logic xử lý đơn hàng ở đây.
            } else {
                echo "<p style='color:red'>Giao dịch thanh toán thất bại. Mã lỗi: " . $_GET['vnp_ResponseCode'] . "</p>";
                // Xử lý khi thanh toán thất bại
            }
        } else {
            echo "<p style='color:red'>Chữ ký không hợp lệ!</p>";
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
    <style>
        #vnpay-qr-display {
            margin-top: 20px;
        }
        #vnpay-qr-image {
            max-width: 200px;
            height: auto;
            display: block;
            margin: 10px auto;
        }
        .payment-options label {
            display: block;
            margin-bottom: 10px;
        }
    </style>
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
                            $grand_total = 0;
                            $cart_query = $conn->prepare("
                                SELECT c.*, p.name, p.price, p.image
                                FROM `cart` c
                                JOIN `products` p ON c.product_id = p.id
                                WHERE c.user_id = ?
                            ");
                            $cart_query->execute([$user_id]);

                            if ($cart_query->rowCount() > 0) {
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
                                }
                                ?>
                                <tr class="cart-total-row">
                                    <td colspan="4" style="text-align: right; font-weight: bold;">Tổng cộng:</td>
                                    <td class="product-subtotal"><?= number_format($grand_total); ?>đ</td>
                                </tr>
                                <?php
                            ?>
                            <tr data-product-id="<?= $item['product_id']; ?>">
                                <td>
                                    <button type="button" class="remove-item" data-product-id="<?= $item['product_id']; ?>">×</button>
                                </td>
                                <td style="min-width:220px;">
                                    <div class="cart-product-info">
                                        <img src="public/assets/uploaded_files/<?= $item['image']; ?>" alt="<?= $item['name']; ?>" class="product-image cart-preview-img">
                                        <span class="product-name"><?= $item['name']; ?></span>
                                    </div>
                                </td>
                                <td class="product-price"><?= number_format($item['price']); ?>đ</td>
                                <td>
                                    <div class="quantity-control">
                                        <button class="btn-decrement">-</button>
                                        <input type="text" class="quantity-input" value="1">
                                        <button class="btn-increment">+</button>
                                    </div>
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
                    <form method="post" id="checkout-form">
                        <input type="hidden" name="shipping_cost" id="shipping-cost-input" value="0">
                        <input type="hidden" name="payment_method" id="payment-method-input" value="COD">

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
                            <tr>
                                <td class="label">Phí vận chuyển</td>
                                <td class="value shipping-cost">0đ</td>
                            </tr>
                            <tr class="grand-total-row">
                                <td class="label"><b>Tổng cộng</b></td>
                                <td class="value grand-total"><?= number_format($grand_total); ?>đ</td>
                            </tr>
                        </table>
                        <div class="payment-options">
                            <h2>Chọn phương thức thanh toán</h2>
                            <label>
                                <input type="radio" name="payment_method_choice" value="COD" checked onchange="document.getElementById('payment-method-input').value='COD'; document.getElementById('vnpay-qr-display').style.display='none'; document.querySelector('.checkout-button').style.display='block';"> Thanh toán khi nhận hàng (COD)
                            </label>
                            <label>
                                <input type="radio" name="payment_method_choice" value="VNPAY_QR" onchange="document.getElementById('payment-method-input').value='VNPAY_QR'; document.getElementById('vnpay-qr-display').style.display='block'; document.querySelector('.checkout-button').style.display='none';"> Thanh toán bằng mã QR VNPay
                            </label>
                            <div id="vnpay-qr-display" style="display:none;">
                                <form method="post">
                                    <input type="<button type="submit" class="checkout-button" name="create_vnpay_payment">Tạo mã QR VNPay</button>
                                </form>
                                <div id="vnpay-qr-result">
                                    </div>
                            </div>
                            <button type="submit" class="checkout-button">Đặt hàng</button>
                        </div>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const vnpayRadio = document.querySelector('input[value="VNPAY_QR"]');
            const vnpayDisplay = document.getElementById('vnpay-qr-display');
            const codRadio = document.querySelector('input[value="COD"]');
            const checkoutButton = document.querySelector('.checkout-button');
            const checkoutForm = document.getElementById('checkout-form');

            if (vnpayRadio && vnpayDisplay && codRadio && checkoutButton && checkoutForm) {
                vnpayRadio.addEventListener('change', function() {
                    if (this.checked) {
                        vnpayDisplay.style.display = 'block';
                        checkoutButton.style.display = 'none';
                    }
                });

                codRadio.addEventListener('change', function() {
                    if (this.checked) {
                        vnpayDisplay.style.display = 'none';
                        checkoutButton.style.display = 'block';
                        // Đặt action của form về trang xử lý đặt hàng COD (nếu khác)
                        checkoutForm.action = ""; // Thay bằng URL xử lý COD của bạn
                    }
                });

                // Ngăn chặn submit form mặc định khi chọn VNPay QR (vì chúng ta submit form con để tạo QR)
                const createVnPayButton = vnpayDisplay.querySelector('button[name="create_vnpay_payment"]');
                if (createVnPayButton) {
                    createVnPayButton.addEventListener('click', function(event) {
                        event.preventDefault(); // Ngăn chặn submit form cha
                        const form = this.closest('form');
                        if (form) {
                            form.submit(); // Submit form con để tạo thanh toán VNPay
                        }
                    });
                }

                // Nếu có tham số vnpay_return trên URL, hiển thị thông báo kết quả thanh toán
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('vnpay_return')) {
                    // Thông báo kết quả đã được hiển thị trực tiếp từ PHP
                    // Bạn có thể thêm logic JavaScript để ẩn thông báo sau một khoảng thời gian
                }
            }
        });
    </script>
</body>
</html>