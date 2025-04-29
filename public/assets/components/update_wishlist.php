<?php
include 'connect.php';
session_start();

if (!isset($_COOKIE['user_id'])) {
    echo json_encode(['error' => 'Bạn chưa đăng nhập!', 'redirect' => '/jewelry-shop/login.php']);
    exit();
}
$user_id = $_COOKIE['user_id'];

$product_id = $_POST['product_id'] ?? '';
$action = $_POST['action'] ?? 'add'; // 'add' or 'remove'

if (!$product_id) {
    echo json_encode(['error' => 'Dữ liệu không hợp lệ!']);
    exit();
}

if ($action == 'add') {
    // Check if item already exists in wishlist
    $check_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?");
    $check_wishlist->execute([$user_id, $product_id]);
    
    if ($check_wishlist->rowCount() > 0) {
        echo json_encode(['info' => 'Sản phẩm đã có trong danh sách yêu thích!']);
        exit();
    }
    
    // Add to wishlist
    $insert = $conn->prepare("INSERT INTO `wishlist` (user_id, product_id) VALUES (?, ?)");
    if($insert->execute([$user_id, $product_id])){
        echo json_encode(['success' => true, 'message' => 'Đã thêm vào danh sách yêu thích!']);
    } else {
        echo json_encode(['error' => 'Không thể thêm vào danh sách yêu thích!']);
    }
} else {
    // Remove from wishlist
    $delete = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ? AND product_id = ?");
    if($delete->execute([$user_id, $product_id])){
        echo json_encode(['success' => true, 'message' => 'Đã xóa khỏi danh sách yêu thích!']);
    } else {
        echo json_encode(['error' => 'Không thể xóa khỏi danh sách yêu thích!']);
    }
}
exit();
?>