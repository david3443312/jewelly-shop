<?php
session_start();
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $design_id = $_POST['design_id'];
    $design_type = $_POST['design_type'];
    
    // Xác định bảng dựa trên loại thiết kế
    $table = '';
    switch ($design_type) {
        case 'custom':
            $table = 'custom_designs';
            break;
        case 'couple':
            $table = 'couple_designs';
            break;
        case 'group':
            $table = 'group_designs';
            break;
        default:
            $_SESSION['cancel_message'] = "Loại đơn hàng không hợp lệ!";
            $_SESSION['cancel_error'] = true;
            header('location: /jewelry-shop/user_profile.php');
            exit();
    }
    
    try {
        // Kiểm tra trạng thái hiện tại của đơn hàng
        $check_stmt = $conn->prepare("SELECT status FROM $table WHERE id = ?");
        $check_stmt->execute([$design_id]);
        $current_status = $check_stmt->fetchColumn();
        
        if ($current_status === 'cancelled' || $current_status === 'delivered') {
            $_SESSION['cancel_message'] = "Không thể hủy đơn hàng đã hoàn thành hoặc đã hủy!";
            $_SESSION['cancel_error'] = true;
        } else {
            // Cập nhật trạng thái đơn hàng thành đã hủy
            $update_stmt = $conn->prepare("UPDATE $table SET status = 'cancelled' WHERE id = ?");
            $update_stmt->execute([$design_id]);
            
            $_SESSION['cancel_message'] = "Đơn hàng đã được hủy thành công!";
            $_SESSION['cancel_success'] = true;
        }
    } catch (PDOException $e) {
        $_SESSION['cancel_message'] = "Có lỗi xảy ra khi hủy đơn hàng!";
        $_SESSION['cancel_error'] = true;
    }
    
    header('location: /jewelry-shop/user_profile.php');
    exit();
}
?> 