<?php
    include "public/assets/components/connect.php";
    session_start();
    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
    } else {
        header('location: login.php');
        exit();
    }
    
    // Truy vấn thông tin người dùng
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ người dùng - Jewelry Shop</title>
    <link rel="stylesheet" href="public/assets/css/user_header.css">
    <link rel="stylesheet" href="public/assets/css/user_profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
</head>
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    <main>
        <div class="profile-container">
            <div class="sidebar">
                <ul>
                    <li onclick="showSection('notifications')">Thông báo</li>
                    <li onclick="showSection('personal-info')">Thông tin cá nhân</li>
                    <li onclick="showSection('orders')">Đơn mua</li>
                </ul>
            </div>
            <div class="content">
                <!-- Thông báo -->
                <div id="notifications" class="section">
                    <h2>Thông báo</h2>
                    <ul class="notification-list">
                        <li>Thông báo 1: Đơn hàng của bạn đã được giao.</li>
                        <li>Thông báo 2: Đơn hàng của bạn đang được xử lý.</li>
                        <li>Thông báo 3: Ưu đãi đặc biệt dành cho bạn!</li>
                    </ul>
                </div>
                
                <!-- Thông tin cá nhân -->
                <div id="personal-info" class="section hidden">
                    <h2>Thông tin cá nhân</h2>
                    <p><strong>Username:</strong> <?= $userInfo['username'] ?? 'N/A'; ?></p>
                    <p><strong>Họ tên:</strong> <?= $userInfo['name'] ?? 'N/A'; ?></p>
                    <p><strong>Email:</strong> <?= $userInfo['email'] ?? 'N/A'; ?></p>
                    <p><strong>Số điện thoại:</strong> <?= $userInfo['phone'] ?? 'N/A'; ?></p>
                    <!-- Có thể bổ sung các chức năng khác như sổ địa chỉ, đổi địa chỉ... -->
                </div>
                
                <!-- Đơn mua -->
                <!-- Replace the static order list in user_profile.php -->
                <div id="orders" class="section hidden">
                    <h2>Đơn mua</h2>
                    <?php
                    // Query to get user's orders
                    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
                    $stmt->execute([$user_id]);
                    
                    if ($stmt->rowCount() > 0) {
                    ?>
                    <ul class="order-list">
                        <?php while ($order = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <li class="order-item">
                            <div class="order-header">
                                <p><strong>Mã đơn hàng:</strong> #<?= $order['id']; ?></p>
                                <p><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($order['order_date'])); ?></p>
                                <p><strong>Trạng thái:</strong> <span class="order-status <?= $order['status']; ?>"><?= $order['status']; ?></span></p>
                                <p><strong>Tổng tiền:</strong> <?= number_format($order['total_price']); ?>đ</p>
                                <button class="toggle-details" onclick="toggleOrderDetails('order-<?= $order['id']; ?>')">Chi tiết</button>
                            </div>
                            
                            <div class="order-details" id="order-<?= $order['id']; ?>">
                                <h4>Thông tin giao hàng:</h4>
                                <p><strong>Người nhận:</strong> <?= $order['name']; ?></p>
                                <p><strong>Số điện thoại:</strong> <?= $order['phone']; ?></p>
                                <p><strong>Địa chỉ:</strong> <?= $order['address']; ?></p>
                                
                                <h4>Sản phẩm:</h4>
                                <table class="order-products">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Get order items
                                        $items_stmt = $conn->prepare("
                                            SELECT oi.*, p.name, p.image
                                            FROM order_items oi
                                            JOIN products p ON oi.product_id = p.id
                                            WHERE oi.order_id = ?
                                        ");
                                        $items_stmt->execute([$order['id']]);
                                        
                                        while ($item = $items_stmt->fetch(PDO::FETCH_ASSOC)):
                                            $item_total = $item['price'] * $item['quantity'];
                                        ?>
                                        <tr>
                                            <td>
                                                <img src="public/assets/uploaded_files/<?= $item['image']; ?>" alt="<?= $item['name']; ?>" class="product-thumbnail">
                                                <?= $item['name']; ?>
                                            </td>
                                            <td><?= number_format($item['price']); ?>đ</td>
                                            <td><?= $item['quantity']; ?></td>
                                            <td><?= number_format($item_total); ?>đ</td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">Phí vận chuyển:</td>
                                            <td><?= number_format($order['shipping_cost']); ?>đ</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><strong>Tổng cộng:</strong></td>
                                            <td><strong><?= number_format($order['total_price']); ?>đ</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php } else { ?>
                    <p class="no-orders">Bạn chưa có đơn hàng nào.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.section').forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(sectionId).classList.remove('hidden');
        }
    </script>
    <script>
        function toggleOrderDetails(orderId) {
            const detailsElement = document.getElementById(orderId);
            if (detailsElement.style.display === 'block') {
                detailsElement.style.display = 'none';
            } else {
                detailsElement.style.display = 'block';
            }
        }
    </script>
</body>
</html>