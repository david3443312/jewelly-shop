<?php
include 'connect.php';

// Kiểm tra đăng nhập
session_start();
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:../../login.php');
    exit();
}

// Xử lý thêm vào giỏ hàng
if (isset($_POST['add_to_cart'])) {
    // Lọc dữ liệu đầu vào
    $product_id = htmlspecialchars($_POST['product_id'], ENT_QUOTES, 'UTF-8');
    $quantity = filter_var($_POST['quantity'] ?? 1, FILTER_VALIDATE_INT);

    if (!$quantity || $quantity <= 0) {
        $quantity = 1; // Đảm bảo số lượng tối thiểu là 1
    }

    // Kiểm tra kết nối
    if (!$conn) {
        $_SESSION['message'] = ['error' => 'Không thể kết nối cơ sở dữ liệu!'];
        header('location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
    $check_cart->execute([$user_id, $product_id]);

    if ($check_cart->rowCount() > 0) {
        // Cập nhật số lượng nếu sản phẩm đã có trong giỏ
        $update_qty = $conn->prepare("UPDATE `cart` SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
        $update_qty->execute([$quantity, $user_id, $product_id]);
        $message[] = 'Cập nhật số lượng sản phẩm trong giỏ hàng!';
    } else {
        // Thêm sản phẩm mới vào giỏ hàng
        $insert_cart = $conn->prepare("INSERT INTO `cart` (user_id, product_id, quantity) VALUES (?,?,?)");
        $insert_cart->execute([$user_id, $product_id, $quantity]);
        $message[] = 'Đã thêm sản phẩm vào giỏ hàng!';
    }
}

// Lưu thông báo vào session và chuyển hướng về trang trước đó
$_SESSION['message'] = $message ?? [];
header('location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>