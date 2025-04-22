<?php
include 'connect.php';
session_start();

if (!isset($_COOKIE['user_id'])) {
    echo json_encode(['error' => 'Bạn chưa đăng nhập!']);
    exit();
}
$user_id = $_COOKIE['user_id'];

$product_id = $_POST['product_id'] ?? '';
$new_quantity = filter_var($_POST['new_quantity'], FILTER_VALIDATE_INT);

if (!$product_id || !$new_quantity || $new_quantity < 1) {
    echo json_encode(['error' => 'Dữ liệu không hợp lệ!']);
    exit();
}

$update = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE user_id = ? AND product_id = ?");
if($update->execute([$new_quantity, $user_id, $product_id])){
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Cập nhật thất bại!']);
}
exit();
?>