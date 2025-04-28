<?php
include 'connect.php';
session_start();

// Check if user is logged in
if (!isset($_COOKIE['user_id'])) {
    $_SESSION['message'] = 'Vui lòng đăng nhập để thêm sản phẩm vào danh sách yêu thích!';
    header('location: ../../../login.php');
    exit();
}

$user_id = $_COOKIE['user_id'];
$product_id = $_POST['product_id'] ?? '';

if (!$product_id) {
    $_SESSION['message'] = 'Không tìm thấy sản phẩm!';
    header('location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

// Check if product already exists in wishlist
$check_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?");
$check_wishlist->execute([$user_id, $product_id]);

if ($check_wishlist->rowCount() > 0) {
    $_SESSION['message'] = 'Sản phẩm đã có trong danh sách yêu thích!';
} else {
    // Add to wishlist
    $insert = $conn->prepare("INSERT INTO `wishlist` (user_id, product_id) VALUES (?, ?)");
    if($insert->execute([$user_id, $product_id])) {
        $_SESSION['message'] = 'Đã thêm vào danh sách yêu thích!';
    } else {
        $_SESSION['message'] = 'Không thể thêm vào danh sách yêu thích!';
    }
}

// Redirect back to the previous page
header('location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>