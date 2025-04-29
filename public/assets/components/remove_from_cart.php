<?php
include 'connect.php';
session_start();

if (!isset($_COOKIE['user_id'])) {
    echo json_encode(['error' => 'Bạn chưa đăng nhập!']);
    exit();
}
$user_id = $_COOKIE['user_id'];

// Get product ID from POST request
$product_id = $_POST['product_id'] ?? '';

if (!$product_id) {
    echo json_encode(['error' => 'ID sản phẩm không hợp lệ!']);
    exit();
}

// Delete the item from cart
$delete = $conn->prepare("DELETE FROM `cart` WHERE user_id = ? AND product_id = ?");

if ($delete->execute([$user_id, $product_id])) {
    echo json_encode(['success' => true, 'message' => 'Đã xóa sản phẩm khỏi giỏ hàng!']);
} else {
    echo json_encode(['error' => 'Không thể xóa sản phẩm!']);
}
exit();
?>