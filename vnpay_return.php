<?php
include 'public/assets/components/connect.php';

$vnp_HashSecret = "YOUR_HASH_SECRET"; // Chèn secret key của bạn vào đây
$vnp_SecureHash = $_GET['vnp_SecureHash'];
$inputData = array();

// Lấy toàn bộ dữ liệu trả về từ VNPay
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

$vnp_TxnRef = $_GET['vnp_TxnRef']; // Mã đơn hàng bạn đã gửi
$vnp_TransactionStatus = $_GET['vnp_TransactionStatus']; // Trạng thái giao dịch
$vnp_Amount = $_GET['vnp_Amount'] / 100; // Số tiền giao dịch
$vnp_OrderInfo = $_GET['vnp_OrderInfo']; // Thông tin đơn hàng
$vnp_PayDate = $_GET['vnp_PayDate']; // Thời gian thanh toán
// ... Các thông tin khác bạn có thể cần

$order_status = 0; // Trạng thái mặc định: Đơn hàng mới

if ($secureHash == $vnp_SecureHash) {
    // Chữ ký hợp lệ
    if ($vnp_TransactionStatus == '00') {
        // Giao dịch thành công
        $order_status = 1; // Cập nhật trạng thái đơn hàng thành đã thanh toán
        $message = "Giao dịch thành công.";
    } else {
        // Giao dịch thất bại
        $order_status = 2; // Cập nhật trạng thái đơn hàng thành thất bại
        $message = "Giao dịch thất bại. Mã lỗi: " . $_GET['vnp_ResponseCode'];
    }

    // Cập nhật trạng thái đơn hàng trong database của bạn
    if (isset($vnp_TxnRef)) {
        $update_order = $conn->prepare("UPDATE `orders` SET payment_status = ?, vnp_transaction_id = ?, vnp_pay_date = ? WHERE order_id = ?");
        $update_order->execute([$order_status, $_GET['vnp_TransactionId'], date('Y-m-d H:i:s', strtotime($vnp_PayDate)), $vnp_TxnRef]);

        if ($update_order->rowCount() > 0) {
            // Cập nhật thành công
        } else {
            // Lỗi khi cập nhật đơn hàng
            $message .= " Lỗi khi cập nhật trạng thái đơn hàng.";
        }
    } else {
        $message .= " Không tìm thấy mã đơn hàng.";
    }

} else {
    // Chữ ký không hợp lệ
    $message = "Chữ ký không hợp lệ.";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả thanh toán - Jewelry Shop</title>
    <link rel="stylesheet" href="public/assets/css/user_header.css">
    <link rel="stylesheet" href="public/assets/css/pay.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <link rel="icon" href="public/assets/images/logoicon.png" type="image/x-icon">
</head>
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    <main>
        <div class="container">
            <h1 class="pay-header">Kết quả thanh toán</h1>
            <div class="pay-content">
                <p class="payment-status">
                    <?php echo $message; ?>
                    <?php if ($order_status == 1): ?>
                        <br>Mã đơn hàng: <?php echo $vnp_TxnRef; ?>
                        <br>Thời gian thanh toán: <?php echo date('H:i:s d/m/Y', strtotime($vnp_PayDate)); ?>
                    <?php endif; ?>
                </p>
                <p><a href="home.php">Tiếp tục mua sắm</a></p>
            </div>
        </div>
    </main>
</body>
</html>