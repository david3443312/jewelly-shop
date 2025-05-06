<?php
include 'connect.php';
session_start();

if (!isset($_COOKIE['user_id'])) {
    header('location: ../../../login.php');
    exit();
}

$user_id = $_COOKIE['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validate inputs
    if (empty($name) || empty($email) || empty($phone) || empty($current_password)) {
        $_SESSION['profile_message'] = 'Vui lòng điền đầy đủ thông tin!';
        $_SESSION['profile_error'] = true;
        header('location: ../../../user_profile.php');
        exit();
    }
    
    // Verify current password
    $verify_query = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $verify_query->execute([$user_id]);
    $user_data = $verify_query->fetch(PDO::FETCH_ASSOC);
    
    if (!$user_data || sha1($current_password) !== $user_data['password']) {
        $_SESSION['profile_message'] = 'Mật khẩu hiện tại không đúng!';
        $_SESSION['profile_error'] = true;
        header('location: ../../../user_profile.php');
        exit();
    }
    
    // Begin transaction to ensure data consistency
    $conn->beginTransaction();
    
    try {
        // Check if email is already in use by another user
        $email_check = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $email_check->execute([$email, $user_id]);
        
        if ($email_check->rowCount() > 0) {
            $_SESSION['profile_message'] = 'Email đã được sử dụng bởi tài khoản khác!';
            $_SESSION['profile_error'] = true;
            header('location: ../../../user_profile.php');
            exit();
        }
        
        // Update user information
        $update_query = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?");
        $update_query->execute([$name, $email, $phone, $user_id]);
        
        // Update password if provided
        if (!empty($new_password)) {
            if (strlen($new_password) < 6) {
                $_SESSION['profile_message'] = 'Mật khẩu mới phải có ít nhất 6 ký tự!';
                $_SESSION['profile_error'] = true;
                $conn->rollBack();
                header('location: ../../../user_profile.php');
                exit();
            }
            
            if ($new_password !== $confirm_password) {
                $_SESSION['profile_message'] = 'Mật khẩu mới và xác nhận mật khẩu không khớp!';
                $_SESSION['profile_error'] = true;
                $conn->rollBack();
                header('location: ../../../user_profile.php');
                exit();
            }
            
            $hashed_password = sha1($new_password);
            $update_password = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $update_password->execute([$hashed_password, $user_id]);
        }
        
        // Commit changes
        $conn->commit();
        
        $_SESSION['profile_message'] = 'Cập nhật thông tin thành công!';
        header('location: ../../../user_profile.php');
        exit();
        
    } catch (Exception $e) {
        // Rollback on error
        $conn->rollBack();
        
        $_SESSION['profile_message'] = 'Đã xảy ra lỗi: ' . $e->getMessage();
        $_SESSION['profile_error'] = true;
        header('location: ../../../user_profile.php');
        exit();
    }
}

// If not POST request, redirect to profile page
header('location: ../../../user_profile.php');
exit();