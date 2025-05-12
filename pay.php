<?php
include 'public/assets/components/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu đơn hàng từ form ở cart.php
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $shipping_address = $_POST['specific_address'] . ', ' . $_POST['ward_text'] . ', ' . $_POST['district_text'] . ', ' . $_POST['city_text'];
    $total_amount = $_POST['grand_total']; // Đảm bảo bạn truyền tổng tiền từ cart.php
    $order_id = 'ORDER_' . time(); // Tạo mã đơn hàng duy nhất

    // --- Bắt đầu xử lý tạo yêu cầu thanh toán VNPay ---
    $vnp_TmnCode = "YOUR_TMN_CODE"; // Thay bằng mã website của bạn tại VNPay
    $vnp_HashSecret = "YOUR_HASH_SECRET"; // Thay bằng secret key của bạn
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // URL thanh toán VNPay sandbox
    $vnp_Returnurl = "YOUR_RETURN_URL"; // URL trả về sau khi thanh toán

    $vnp_TxnRef = $order_id; // Mã đơn hàng
    $vnp_OrderInfo = "Thanh toan don hang " . $order_id;
    $vnp_OrderType = 'billpayment';
    $vnp_Amount = $total_amount * 100; // VNPay tính bằng đồng * 100
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
        "vnp_CreateDate" => date('YmdHis'),
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

    // Chuyển hướng người dùng đến trang thanh toán của VNPay
    header('Location: ' . $vnp_Url);
    exit();
    // --- Kết thúc xử lý tạo yêu cầu thanh toán VNPay ---
} else {
    // Xử lý trường hợp truy cập trực tiếp vào pay.php (nếu cần)
    echo "Không có dữ liệu đơn hàng.";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán - Jewelry Shop</title>
    <link rel="stylesheet" href="public/assets/css/user_header.css">
    <link rel="stylesheet" href="public/assets/css/pay.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <link rel="icon" href="public/assets/images/logoicon.png" type="image/x-icon">
</head>
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    <main>
        <div class="container">
            <h1 class="pay-header">Tiến hành thanh toán</h1>
            <div class="pay-content">
                <p>Bạn đang được chuyển hướng đến cổng thanh toán VNPay...</p>
            </div>
        </div>
    </main>
</body>
</html>