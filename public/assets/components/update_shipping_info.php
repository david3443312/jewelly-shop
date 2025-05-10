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
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    
    // Lấy các giá trị text từ hidden fields
    $city_text = $_POST['city_text'] ?? '';
    $district_text = $_POST['district_text'] ?? '';  
    $ward_text = $_POST['ward_text'] ?? '';
    $specific_address = $_POST['specific_address'] ?? '';
    
    // Tạo địa chỉ đầy đủ
    $address = $specific_address . ', ' . $ward_text . ', ' . $district_text . ', ' . $city_text . ', Việt Nam';
    
    // Validate inputs
    if (empty($order_id) || empty($name) || empty($phone) || empty($specific_address) || 
        empty($city_text) || empty($district_text) || empty($ward_text)) {
        $_SESSION['shipping_message'] = 'Vui lòng điền đầy đủ thông tin!';
        $_SESSION['shipping_error'] = true;
        header('location: ../../../user_profile.php');
        exit();
    }
    
    // Verify the order belongs to this user and is in pending status
    $check_order = $conn->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
    $check_order->execute([$order_id, $user_id]);
    $order = $check_order->fetch(PDO::FETCH_ASSOC);
    
    if (!$order) {
        $_SESSION['shipping_message'] = 'Không tìm thấy đơn hàng hoặc bạn không có quyền sửa đơn hàng này!';
        $_SESSION['shipping_error'] = true;
        header('location: ../../../user_profile.php');
        exit();
    }
    
    if ($order['status'] !== 'pending') {
        $_SESSION['shipping_message'] = 'Chỉ có thể sửa thông tin đơn hàng ở trạng thái chờ xử lý!';
        $_SESSION['shipping_error'] = true;
        header('location: ../../../user_profile.php');
        exit();
    }
    
    // Update the order information
    $update_order = $conn->prepare("UPDATE orders SET name = ?, phone = ?, address = ? WHERE id = ? AND user_id = ?");
    if ($update_order->execute([$name, $phone, $address, $order_id, $user_id])) {
        $_SESSION['shipping_message'] = 'Cập nhật thông tin giao hàng thành công!';
        $_SESSION['shipping_success'] = true;
    } else {
        $_SESSION['shipping_message'] = 'Đã xảy ra lỗi khi cập nhật thông tin!';
        $_SESSION['shipping_error'] = true;
    }
    
    header('location: ../../../user_profile.php');
    exit();
}

// Redirect if accessed directly
header('location: ../../../user_profile.php');
exit();