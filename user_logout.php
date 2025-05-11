<?php
    // Khởi động session nếu chưa được khởi động
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Lưu trữ thông báo trước khi xóa session
    $message = "Bạn đã đăng xuất thành công!";
    
    // Xóa tất cả dữ liệu session
    $_SESSION = array();
    
    // Xóa cookie session
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Xóa user_id cookie
    setcookie('user_id', '', time() - 3600, '/');
    
    // Xóa tất cả các cookie liên quan đến người dùng
    if (isset($_COOKIE['user_id'])) {
        unset($_COOKIE['user_id']);
    }
    
    // Hủy session
    session_destroy();
    
    // Khởi động session mới để lưu thông báo
    session_start();
    $_SESSION['logout_message'] = $message;
    
    // Chuyển hướng về trang đăng nhập với đường dẫn tuyệt đối
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/jewelry-shop/login.php');
    exit();
?>