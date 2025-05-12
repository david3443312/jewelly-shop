<?php
// Lấy số tiền từ query string hoặc mặc định 10000
$amount = isset($_GET['amount']) ? intval($_GET['amount']) : 10000;
$orderType = 'billpayment';
$orderDescription = 'Thanh toán đơn hàng Jewelry Shop';
$bankCode = '';
$language = 'vn';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chuyển hướng VNPAY</title>
</head>
<body>
    <form id="vnpayForm" action="http://sandbox.vnpayment.vn/tryitnow/Home/CreateOrder" method="post">
        <input type="hidden" name="amount" value="<?= $amount ?>">
        <input type="hidden" name="orderType" value="<?= $orderType ?>">
        <input type="hidden" name="orderDescription" value="<?= $orderDescription ?>">
        <input type="hidden" name="bankCode" value="<?= $bankCode ?>">
        <input type="hidden" name="language" value="<?= $language ?>">
    </form>
    <script>
        document.getElementById('vnpayForm').submit();
    </script>
</body>
</html>
