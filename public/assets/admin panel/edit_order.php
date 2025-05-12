<?php
include '../components/connect.php';
if (isset($_COOKIE['vendor_id'])) {
    $vendor_id = $_COOKIE['vendor_id'];
} else {
    $vendor_id = '';
    header('location: login.php');
    exit();
}

// Lấy id đơn hàng từ URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('location: admin_order.php');
    exit();
}
$order_id = intval($_GET['id']);

// Xử lý cập nhật đơn hàng
if (isset($_POST['update_order'])) {
    $update_name = filter_var($_POST['update_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $update_email = filter_var($_POST['update_email'], FILTER_SANITIZE_SPECIAL_CHARS);
    $update_phone = filter_var($_POST['update_phone'], FILTER_SANITIZE_SPECIAL_CHARS);
    $update_address = filter_var($_POST['update_address'], FILTER_SANITIZE_SPECIAL_CHARS);
    $update_total_price = filter_var($_POST['update_total_price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $update_shipping_cost = filter_var($_POST['update_shipping_cost'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $update_payment_method = filter_var($_POST['update_payment_method'], FILTER_SANITIZE_SPECIAL_CHARS);
    $update_payment = filter_var($_POST['update_payment'], FILTER_SANITIZE_SPECIAL_CHARS);
    $update_status = filter_var($_POST['update_status'], FILTER_SANITIZE_SPECIAL_CHARS);

    $update_order = $conn->prepare("UPDATE `orders` SET name = ?, email = ?, phone = ?, address = ?, total_price = ?, shipping_cost = ?, payment_method = ?, payment_status = ?, status = ? WHERE id = ?");
    $update_order->execute([
        $update_name, $update_email, $update_phone, $update_address, $update_total_price, $update_shipping_cost, $update_payment_method, $update_payment, $update_status, $order_id
    ]);
    $success_msg = 'Cập nhật đơn hàng thành công!';
}

// Lấy thông tin đơn hàng
$select_order = $conn->prepare("SELECT * FROM `orders` WHERE id = ? LIMIT 1");
$select_order->execute([$order_id]);
if ($select_order->rowCount() == 0) {
    header('location: admin_order.php');
    exit();
}
$order = $select_order->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa đơn hàng</title>
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/styleshomepage.css">
    <link rel="icon" href="../images/logoicon.png" type="image/x-icon">
    <style>
        .edit-order-box { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 10px; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .edit-order-box h2 { margin-bottom: 25px; }
        .edit-order-box .form-group { margin-bottom: 18px; }
        .edit-order-box label { display: block; margin-bottom: 6px; font-weight: 500; }
        .edit-order-box input, .edit-order-box select, .edit-order-box textarea { width: 100%; padding: 8px 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 15px; }
        .edit-order-box textarea { height: 70px; resize: vertical; }
        .edit-order-box .btn { background: #4CAF50; color: #fff; border: none; padding: 10px 22px; border-radius: 5px; font-weight: 500; cursor: pointer; }
        .edit-order-box .btn-cancel { background: #f44336; margin-left: 10px; }
        .success-msg { color: #388e3c; margin-bottom: 15px; font-weight: 500; }
    </style>
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
    </div>
    <div class="edit-order-box">
        <h2>Chỉnh sửa đơn hàng #<?= $order['id'] ?></h2>
        <?php if (!empty($success_msg)): ?>
            <div class="success-msg"><?= $success_msg ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label>Họ tên khách hàng:</label>
                <input type="text" name="update_name" value="<?= htmlspecialchars($order['name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="update_email" value="<?= htmlspecialchars($order['email']) ?>" required>
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <input type="text" name="update_phone" value="<?= htmlspecialchars($order['phone']) ?>" required>
            </div>
            <div class="form-group">
                <label>Tổng tiền (VND):</label>
                <input type="number" name="update_total_price" value="<?= $order['total_price'] ?>" min="1000" step="1000" required>
            </div>
            <div class="form-group">
                <label>Phí vận chuyển (VND):</label>
                <input type="number" name="update_shipping_cost" value="<?= $order['shipping_cost'] ?>" min="0" step="1000" required>
            </div>
            <div class="form-group">
                <label>Phương thức thanh toán:</label>
                <select name="update_payment_method">
                    <option value="COD" <?= $order['payment_method']=='COD'?'selected':'' ?>>COD</option>
                    <option value="Credit Card" <?= $order['payment_method']=='Credit Card'?'selected':'' ?>>Credit Card</option>
                    <option value="PayPal" <?= $order['payment_method']=='PayPal'?'selected':'' ?>>PayPal</option>
                </select>
            </div>
            <div class="form-group">
                <label>Trạng thái thanh toán:</label>
                <select name="update_payment">
                    <option value="pending" <?= $order['payment_status']=='pending'?'selected':'' ?>>Pending</option>
                    <option value="completed" <?= $order['payment_status']=='completed'?'selected':'' ?>>Completed</option>
                </select>
            </div>
            <div class="form-group">
                <label>Trạng thái đơn hàng:</label>
                <select name="update_status">
                    <option value="pending" <?= $order['status']=='pending'?'selected':'' ?>>Pending</option>
                    <option value="in progress" <?= $order['status']=='in progress'?'selected':'' ?>>In Progress</option>
                    <option value="completed" <?= $order['status']=='completed'?'selected':'' ?>>Completed</option>
                    <option value="cancelled" <?= $order['status']=='cancelled'?'selected':'' ?>>Cancelled</option>
                </select>
            </div>
            <div class="form-group">
                <label>Địa chỉ:</label>
                <textarea name="update_address" required><?= htmlspecialchars($order['address']) ?></textarea>
            </div>
            <button type="submit" name="update_order" class="btn">Update</button>
            <a href="admin_order.php" class="btn btn-cancel">Go back</a>
        </form>
    </div>
</body>
</html>
