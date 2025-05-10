<?php
include 'connect.php';
session_start();

if (!isset($_COOKIE['user_id'])) {
    header('location: ../../../login.php');
    exit();
}

$user_id = $_COOKIE['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'] ?? '';
    
    if (empty($order_id)) {
        $_SESSION['cancel_message'] = 'Không tìm thấy thông tin đơn hàng!';
        $_SESSION['cancel_error'] = true;
        header('location: ../../../user_profile.php');
        exit();
    }
    
    // Verify the order belongs to this user and is in pending status
    $check_order = $conn->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
    $check_order->execute([$order_id, $user_id]);
    $order = $check_order->fetch(PDO::FETCH_ASSOC);
    
    if (!$order) {
        $_SESSION['cancel_message'] = 'Không tìm thấy đơn hàng hoặc bạn không có quyền hủy đơn hàng này!';
        $_SESSION['cancel_error'] = true;
        header('location: ../../../user_profile.php');
        exit();
    }
    
    if ($order['status'] !== 'pending') {
        $_SESSION['cancel_message'] = 'Chỉ có thể hủy đơn hàng ở trạng thái chờ xử lý!';
        $_SESSION['cancel_error'] = true;
        header('location: ../../../user_profile.php');
        exit();
    }
    
    // Update order status to cancelled
    $update_order = $conn->prepare("UPDATE orders SET status = 'cancelled' WHERE id = ? AND user_id = ?");
    if ($update_order->execute([$order_id, $user_id])) {
        $_SESSION['cancel_message'] = 'Đơn hàng đã được hủy thành công!';
        $_SESSION['cancel_success'] = true;
    } else {
        $_SESSION['cancel_message'] = 'Đã xảy ra lỗi khi hủy đơn hàng!';
        $_SESSION['cancel_error'] = true;
    }
    
    header('location: ../../../user_profile.php');
    exit();
}

// Redirect if accessed directly
header('location: ../../../user_profile.php');
exit();