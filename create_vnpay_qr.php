<?php
include 'public/assets/components/connect.php';

$vnp_TmnCode = "YOUR_TMN_CODE"; // Thay bằng mã website của bạn tại VNPay
$vnp_HashSecret = "YOUR_HASH_SECRET"; // Thay bằng secret key của bạn
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // URL thanh toán VNPay sandbox (API tạo QR có thể khác, hãy kiểm tra tài liệu VNPay)
$vnp_ApiUrl = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // *Điều chỉnh URL API tạo QR nếu VNPay cung cấp riêng*
$vnp_Returnurl = "YOUR_RETURN_URL"; // URL trả về sau khi thanh toán (vẫn cần cấu hình)

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'create_vnpay_qr') {
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $shipping_address = $_POST['specific_address'] . ', ' . $_POST['ward_text'] . ', ' . $_POST['district_text'] . ', ' . $_POST['city_text'];
    $total_amount = $_POST['grand_total']; // Đảm bảo bạn truyền tổng tiền
    $order_id = 'QR_' . time(); // Tạo mã đơn hàng duy nhất cho QR

    $vnp_TxnRef = $order_id; // Mã đơn hàng
    $vnp_OrderInfo = "Thanh toan don hang QR " . $order_id;
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
        "vnp_ReturnUrl" => $vnp_Returnurl, // Vẫn cần để VNPay thông báo kết quả
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

    // *Chú ý: API tạo QR có thể khác với URL thanh toán, hãy kiểm tra tài liệu VNPay*
    // Giả sử API tạo QR là một endpoint khác, bạn có thể cần gửi POST request với các tham số
    // và nhận về URL của ảnh QR.
    $qr_api_url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // *SỬA ĐỔI URL NÀY*
    $params = $inputData;
    $params['vnp_SecureHash'] = $vnp_SecureHash;

    // Gửi POST request đến API tạo QR (ví dụ dùng curl)
    $ch = curl_init($qr_api_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Phân tích response để lấy URL mã QR (định dạng response tùy thuộc vào API VNPay)
    // *ĐÂY CHỈ LÀ GIẢ ĐỊNH, CẦN XEM DOCUMENTATION CỦA VNPay*
    $responseData = json_decode($response, true);

    if ($responseData && isset($responseData['qrCodeUrl'])) {
        $qrCodeUrl = $responseData['qrCodeUrl'];
        echo json_encode(['error' => false, 'qr_url' => $qrCodeUrl, 'order_id' => $order_id]);

        // Lưu thông tin đơn hàng (trạng thái chưa thanh toán) vào database với order_id
        $insert_order = $conn->prepare("INSERT INTO `orders` (user_id, order_id, name, phone, address, total_price, payment_method, order_date, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_order->execute([$user_id, $order_id, $full_name, $phone_number, $shipping_address, $total_amount, 'VNPAY_QR', date('Y-m-d H:i:s'), 0]);

    } else {
        echo json_encode(['error' => true, 'message' => 'Không thể tạo mã QR từ VNPay.', 'response' => $response]);
    }

} else {
    echo json_encode(['error' => true, 'message' => 'Yêu cầu không hợp lệ.']);
}
?>