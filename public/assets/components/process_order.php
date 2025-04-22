<?php
include "connect.php";
session_start();

if (!isset($_COOKIE['user_id'])) {
    header('../../../login.php');
    exit();
}

$user_id = $_COOKIE['user_id'];

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get customer information
    $name = $_POST['full_name'] ?? '';
    $phone = $_POST['phone_number'] ?? '';
    $city = $_POST['city'] ?? '';
    $district = $_POST['district'] ?? '';
    $ward = $_POST['ward'] ?? '';
    $specific_address = $_POST['specific_address'] ?? '';
    $payment_method = $_POST['payment_method'] ?? 'COD';
    $shipping_cost = filter_var($_POST['shipping_cost'] ?? 0, FILTER_VALIDATE_FLOAT) ?? 0;
    
    // Generate address string
    $address = $specific_address . ', ' . $ward . ', ' . $district . ', ' . $city . ', Việt Nam';
    
    // Validate required fields
    if (empty($name) || empty($phone) || empty($city) || empty($district) || 
        empty($ward) || empty($specific_address)) {
        $_SESSION['message'] = 'Vui lòng điền đầy đủ thông tin giao hàng!';
        header('../../../cart.php');
        exit();
    }
    
    // Get user email
    $stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $email = $user['email'] ?? '';
    
    // Get cart items
    $cart_query = $conn->prepare("
        SELECT c.*, p.name, p.price, p.image 
        FROM `cart` c 
        JOIN `products` p ON c.product_id = p.id 
        WHERE c.user_id = ?
    ");
    $cart_query->execute([$user_id]);
    
    if ($cart_query->rowCount() > 0) {
        // Calculate total price
        $total_price = 0;
        $cart_items = [];
        
        while ($item = $cart_query->fetch(PDO::FETCH_ASSOC)) {
            $sub_total = $item['price'] * $item['quantity'];
            $total_price += $sub_total;
            $cart_items[] = $item;
        }
        
        // Add shipping cost to total
        $grand_total = $total_price + $shipping_cost;
        
        // Generate unique order ID (current timestamp + random number)
        $order_id = time() . rand(1000, 9999);
        
        // Begin transaction
        $conn->beginTransaction();
        
        try {
            // Create order
            $insert_order = $conn->prepare("
                INSERT INTO `orders` 
                (id, user_id, name, email, phone, address, total_price, shipping_cost, payment_method, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $insert_order->execute([
                $order_id, 
                $user_id, 
                $name, 
                $email, 
                $phone, 
                $address, 
                $grand_total,
                $shipping_cost,
                $payment_method, 
                'pending'
            ]);
            
            // Insert order items
            $insert_items = $conn->prepare("
                INSERT INTO `order_items` 
                (order_id, product_id, quantity, price) 
                VALUES (?, ?, ?, ?)
            ");
            
            foreach ($cart_items as $item) {
                $insert_items->execute([
                    $order_id,
                    $item['product_id'],
                    $item['quantity'],
                    $item['price']
                ]);
            }
            
            // Clear cart
            $clear_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $clear_cart->execute([$user_id]);
            
            // Commit transaction
            $conn->commit();
            
            $_SESSION['message'] = 'Đặt hàng thành công! Mã đơn hàng của bạn là #' . $order_id;
            header('location: ../../../user_profile.php');
            exit();
            
        } catch (Exception $e) {
            // Roll back transaction on error
            $conn->rollBack();
            $_SESSION['message'] = 'Đã xảy ra lỗi khi đặt hàng: ' . $e->getMessage();
            header('location: ../../../cart.php');
            exit();
        }
    } else {
        $_SESSION['message'] = 'Giỏ hàng của bạn trống!';
        header('location: ../../../cart.php');
        exit();
    }
} else {
    header('location: ../../../cart.php');
    exit();
}
?>