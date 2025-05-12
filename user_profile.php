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
    <style>
        .order-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .tab-button {
            padding: 10px 20px;
            border: none;
            background-color: #f0f0f0;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .tab-button:hover {
            background-color: #e0e0e0;
        }
        
        .tab-button.active {
            background-color: #4CAF50;
            color: white;
        }
        
        .order-section {
            display: none;
        }
        
        .order-section.active {
            display: block;
        }
    </style>
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
                    
                    <!-- Display information mode -->
                    <div id="info-display">
                        <p><strong>Username:</strong> <?= $userInfo['username'] ?? 'N/A'; ?></p>
                        <p><strong>Họ tên:</strong> <?= $userInfo['name'] ?? 'N/A'; ?></p>
                        <p><strong>Email:</strong> <?= $userInfo['email'] ?? 'N/A'; ?></p>
                        <p><strong>Số điện thoại:</strong> <?= $userInfo['phone'] ?? 'N/A'; ?></p>
                        
                        <button class="edit-button" onclick="toggleEditMode()">Chỉnh sửa thông tin</button>
                    </div>
                    
                    <!-- Edit information mode -->
                    <div id="info-edit" class="hidden">
                        <form id="edit-profile-form" method="post" action="public/assets/components/update_profile.php">
                            <div class="form-group">
                                <label for="name">Họ tên:</label>
                                <input type="text" id="name" name="name" value="<?= $userInfo['name'] ?? ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="<?= $userInfo['email'] ?? ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại:</label>
                                <input type="tel" id="phone" name="phone" value="<?= $userInfo['phone'] ?? ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="current_password">Mật khẩu hiện tại (để xác thực):</label>
                                <input type="password" id="current_password" name="current_password" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">Mật khẩu mới (để trống nếu không đổi):</label>
                                <input type="password" id="new_password" name="new_password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Xác nhận mật khẩu mới:</label>
                                <input type="password" id="confirm_password" name="confirm_password">
                            </div>
                            
                            <div class="button-group">
                                <button type="submit" class="save-button">Lưu thay đổi</button>
                                <button type="button" class="cancel-button" onclick="toggleEditMode()">Hủy</button>
                            </div>
                        </form>
                    </div>
                    
                    <?php if(isset($_SESSION['profile_message'])): ?>
                        <div class="message <?= isset($_SESSION['profile_error']) ? 'error' : 'success'; ?>">
                            <?= $_SESSION['profile_message']; ?>
                        </div>
                        <?php 
                            unset($_SESSION['profile_message']);
                            if(isset($_SESSION['profile_error'])) unset($_SESSION['profile_error']);
                        ?>
                    <?php endif; ?>
                </div>
                
                <!-- Đơn mua -->
                <div id="orders" class="section hidden">
                    <h2>Đơn mua</h2>
                    <div class="order-tabs">
                        <button class="tab-button active" onclick="showOrderTab('regular-orders')">Đơn hàng thường</button>
                        <button class="tab-button" onclick="showOrderTab('custom-designs')">Thiết kế riêng</button>
                        <button class="tab-button" onclick="showOrderTab('couple-designs')">Trang sức đôi</button>
                        <button class="tab-button" onclick="showOrderTab('group-designs')">Đặt theo nhóm</button>
                    </div>
                    <div class="order-filter">
                        <label for="status-filter">Lọc theo trạng thái:</label>
                        <select id="status-filter" onchange="filterOrders()">
                            <option value="all">Tất cả đơn hàng</option>
                            <option value="pending">Đang xử lý</option>
                            <option value="processing">Đang giao hàng</option>
                            <option value="delivered">Đã giao hàng</option>
                            <option value="cancelled">Đã hủy</option>
                        </select>
                    </div>
                    <?php if(isset($_SESSION['shipping_message'])): ?>
                        <div class="message <?= isset($_SESSION['shipping_error']) ? 'error' : 'success'; ?>">
                            <?= $_SESSION['shipping_message']; ?>
                        </div>
                        <?php 
                            unset($_SESSION['shipping_message']);
                            if(isset($_SESSION['shipping_error'])) unset($_SESSION['shipping_error']);
                            if(isset($_SESSION['shipping_success'])) unset($_SESSION['shipping_success']);
                        ?>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['cancel_message'])): ?>
                        <div class="message <?= isset($_SESSION['cancel_error']) ? 'error' : 'success'; ?>">
                            <?= $_SESSION['cancel_message']; ?>
                        </div>
                        <?php 
                            unset($_SESSION['cancel_message']);
                            if(isset($_SESSION['cancel_error'])) unset($_SESSION['cancel_error']);
                            if(isset($_SESSION['cancel_success'])) unset($_SESSION['cancel_success']);
                        ?>
                    <?php endif; ?>
                    <div id="regular-orders" class="order-section">
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
                                    <?php if($order['status'] == 'pending'): ?>
                                        <form action="public/assets/components/cancel_order.php" method="post" class="cancel-form" onsubmit="return confirmCancel()">
                                            <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                                            <button type="submit" class="cancel-order-btn">
                                                <i class="fas fa-times-circle"></i> Hủy đơn hàng
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    
                                    <button class="toggle-details" onclick="toggleOrderDetails('order-<?= $order['id']; ?>')">Chi tiết</button>
                                </div>
                                
                                <!-- Thêm vào phần thông tin giao hàng trong user_profile.php -->
                                <div class="order-details" id="order-<?= $order['id']; ?>">
                                    <h4>Thông tin giao hàng:
                                        <?php if($order['status'] == 'pending'): ?>
                                            <button class="edit-shipping-btn" onclick="showEditShippingForm('<?= $order['id']; ?>')">
                                                <i class="fas fa-edit"></i> Sửa
                                            </button>
                                        <?php endif; ?>
                                    </h4>
                                    <div id="shipping-info-<?= $order['id']; ?>">
                                        <p><strong>Người nhận:</strong> <?= $order['name']; ?></p>
                                        <p><strong>Số điện thoại:</strong> <?= $order['phone']; ?></p>
                                        <p><strong>Địa chỉ:</strong> <?= $order['address']; ?></p>
                                    </div>
                                    
                                    <!-- Form sửa thông tin giao hàng (ẩn mặc định) -->
                                    <div id="edit-shipping-form-<?= $order['id']; ?>" class="edit-shipping-form hidden">
                                        <form action="public/assets/components/update_shipping_info.php" method="post">
                                            <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                                            
                                            <!-- Hidden fields for text values -->
                                            <input type="hidden" id="edit_city_text_<?= $order['id']; ?>" name="city_text" value="">
                                            <input type="hidden" id="edit_district_text_<?= $order['id']; ?>" name="district_text" value="">
                                            <input type="hidden" id="edit_ward_text_<?= $order['id']; ?>" name="ward_text" value="">
                                            
                                            <div class="form-group">
                                                <label for="edit-name-<?= $order['id']; ?>">Người nhận:</label>
                                                <input type="text" id="edit-name-<?= $order['id']; ?>" name="name" value="<?= $order['name']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit-phone-<?= $order['id']; ?>">Số điện thoại:</label>
                                                <input type="tel" id="edit-phone-<?= $order['id']; ?>" name="phone" value="<?= $order['phone']; ?>" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="edit-city-<?= $order['id']; ?>">Tỉnh/Thành phố:</label>
                                                <select class="form-select edit-city" id="edit-city-<?= $order['id']; ?>" name="city" data-order-id="<?= $order['id']; ?>" required>
                                                    <option value="" selected>Chọn tỉnh thành</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit-district-<?= $order['id']; ?>">Quận/Huyện:</label>
                                                <select class="form-select edit-district" id="edit-district-<?= $order['id']; ?>" name="district" data-order-id="<?= $order['id']; ?>" required>
                                                    <option value="" selected>Chọn quận huyện</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit-ward-<?= $order['id']; ?>">Xã/Phường:</label>
                                                <select class="form-select edit-ward" id="edit-ward-<?= $order['id']; ?>" name="ward" data-order-id="<?= $order['id']; ?>" required>
                                                    <option value="" selected>Chọn phường xã</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit-specific-address-<?= $order['id']; ?>">Địa chỉ cụ thể:</label>
                                                <input type="text" id="edit-specific-address-<?= $order['id']; ?>" name="specific_address" placeholder="Số nhà, đường..." required>
                                            </div>
                                            
                                            <div class="button-group">
                                                <button type="submit" class="save-button">Lưu thay đổi</button>
                                                <button type="button" class="cancel-button" onclick="hideEditShippingForm('<?= $order['id']; ?>')">Hủy</button>
                                            </div>
                                        </form>
                                    </div>
        
                                    
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

                <!-- Thiết kế riêng -->
                <div id="custom-designs" class="order-section hidden">
                    <h3>Đơn thiết kế riêng</h3>
                    <?php
                    $custom_stmt = $conn->prepare("SELECT * FROM custom_designs WHERE user_id = ? ORDER BY created_at DESC");
                    $custom_stmt->execute([$user_id]);
                    
                    if ($custom_stmt->rowCount() > 0) {
                    ?>
                    <ul class="order-list">
                        <?php while ($design = $custom_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <li class="order-item">
                            <div class="order-header">
                                <p><strong>Mã đơn:</strong> #<?= $design['id']; ?></p>
                                <p><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($design['created_at'])); ?></p>
                                <p><strong>Trạng thái:</strong> <span class="order-status <?= $design['status']; ?>"><?= $design['status']; ?></span></p>
                                <p><strong>Loại thiết kế:</strong> <?= $design['design_type']; ?></p>
                                <?php if($design['status'] != 'cancelled' && $design['status'] != 'delivered'): ?>
                                    <form action="public/assets/components/cancel_design.php" method="post" class="cancel-form" onsubmit="return confirmCancel()">
                                        <input type="hidden" name="design_id" value="<?= $design['id']; ?>">
                                        <input type="hidden" name="design_type" value="custom">
                                        <button type="submit" class="cancel-order-btn">
                                            <i class="fas fa-times-circle"></i> Hủy đơn hàng
                                        </button>
                                    </form>
                                <?php endif; ?>
                                <button class="toggle-details" onclick="toggleOrderDetails('custom-<?= $design['id']; ?>')">Chi tiết</button>
                            </div>
                            <div class="order-details" id="custom-<?= $design['id']; ?>">
                                <h4>Thông tin thiết kế:</h4>
                                <p><strong>Mô tả:</strong> <?= $design['description']; ?></p>
                                <p><strong>Ngân sách:</strong> <?= number_format($design['budget']); ?>đ</p>
                                <p><strong>Hạn hoàn thành:</strong> <?= date('d/m/Y', strtotime($design['deadline'])); ?></p>
                            </div>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php } else { ?>
                    <p class="no-orders">Bạn chưa có đơn thiết kế riêng nào.</p>
                    <?php } ?>
                </div>

                <!-- Trang sức đôi -->
                <div id="couple-designs" class="order-section hidden">
                    <h3>Đơn trang sức đôi</h3>
                    <?php
                    $couple_stmt = $conn->prepare("SELECT * FROM couple_designs WHERE user_id = ? ORDER BY created_at DESC");
                    $couple_stmt->execute([$user_id]);
                    
                    if ($couple_stmt->rowCount() > 0) {
                    ?>
                    <ul class="order-list">
                        <?php while ($design = $couple_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <li class="order-item">
                            <div class="order-header">
                                <p><strong>Mã đơn:</strong> #<?= $design['id']; ?></p>
                                <p><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($design['created_at'])); ?></p>
                                <p><strong>Trạng thái:</strong> <span class="order-status <?= $design['status']; ?>"><?= $design['status']; ?></span></p>
                                <p><strong>Loại thiết kế:</strong> <?= $design['design_type']; ?></p>
                                <?php if($design['status'] != 'cancelled' && $design['status'] != 'delivered'): ?>
                                    <form action="public/assets/components/cancel_design.php" method="post" class="cancel-form" onsubmit="return confirmCancel()">
                                        <input type="hidden" name="design_id" value="<?= $design['id']; ?>">
                                        <input type="hidden" name="design_type" value="couple">
                                        <button type="submit" class="cancel-order-btn">
                                            <i class="fas fa-times-circle"></i> Hủy đơn hàng
                                        </button>
                                    </form>
                                <?php endif; ?>
                                <button class="toggle-details" onclick="toggleOrderDetails('couple-<?= $design['id']; ?>')">Chi tiết</button>
                            </div>
                            <div class="order-details" id="couple-<?= $design['id']; ?>">
                                <h4>Thông tin thiết kế:</h4>
                                <p><strong>Mô tả:</strong> <?= $design['description']; ?></p>
                                <p><strong>Ngân sách:</strong> <?= number_format($design['budget']); ?>đ</p>
                                <p><strong>Hạn hoàn thành:</strong> <?= date('d/m/Y', strtotime($design['deadline'])); ?></p>
                            </div>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php } else { ?>
                    <p class="no-orders">Bạn chưa có đơn trang sức đôi nào.</p>
                    <?php } ?>
                </div>

                <!-- Đặt theo nhóm -->
                <div id="group-designs" class="order-section hidden">
                    <h3>Đơn đặt theo nhóm</h3>
                    <?php
                    $group_stmt = $conn->prepare("SELECT * FROM group_designs WHERE user_id = ? ORDER BY created_at DESC");
                    $group_stmt->execute([$user_id]);
                    
                    if ($group_stmt->rowCount() > 0) {
                    ?>
                    <ul class="order-list">
                        <?php while ($design = $group_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <li class="order-item">
                            <div class="order-header">
                                <p><strong>Mã đơn:</strong> #<?= $design['id']; ?></p>
                                <p><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($design['created_at'])); ?></p>
                                <p><strong>Trạng thái:</strong> <span class="order-status <?= $design['status']; ?>"><?= $design['status']; ?></span></p>
                                <p><strong>Loại thiết kế:</strong> <?= $design['design_type']; ?></p>
                                <?php if($design['status'] != 'cancelled' && $design['status'] != 'delivered'): ?>
                                    <form action="public/assets/components/cancel_design.php" method="post" class="cancel-form" onsubmit="return confirmCancel()">
                                        <input type="hidden" name="design_id" value="<?= $design['id']; ?>">
                                        <input type="hidden" name="design_type" value="group">
                                        <button type="submit" class="cancel-order-btn">
                                            <i class="fas fa-times-circle"></i> Hủy đơn hàng
                                        </button>
                                    </form>
                                <?php endif; ?>
                                <button class="toggle-details" onclick="toggleOrderDetails('group-<?= $design['id']; ?>')">Chi tiết</button>
                            </div>
                            <div class="order-details" id="group-<?= $design['id']; ?>">
                                <h4>Thông tin thiết kế:</h4>
                                <p><strong>Mô tả:</strong> <?= $design['description']; ?></p>
                                <p><strong>Ngân sách:</strong> <?= number_format($design['budget']); ?>đ</p>
                                <p><strong>Hạn hoàn thành:</strong> <?= date('d/m/Y', strtotime($design['deadline'])); ?></p>
                            </div>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php } else { ?>
                    <p class="no-orders">Bạn chưa có đơn đặt theo nhóm nào.</p>
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
    <script>
        function toggleEditMode() {
            const displayDiv = document.getElementById('info-display');
            const editDiv = document.getElementById('info-edit');
            
            if (displayDiv.classList.contains('hidden')) {
                displayDiv.classList.remove('hidden');
                editDiv.classList.add('hidden');
            } else {
                displayDiv.classList.add('hidden');
                editDiv.classList.remove('hidden');
            }
        }
        
        // Form validation
        document.getElementById('edit-profile-form').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('Mật khẩu mới và xác nhận mật khẩu không khớp!');
            }
            
            if (newPassword.length > 0 && newPassword.length < 6) {
                e.preventDefault();
                alert('Mật khẩu mới phải có ít nhất 6 ký tự!');
            }
        });
        
        // Hide success message after 5 seconds
        const messageDiv = document.querySelector('.message');
        if (messageDiv) {
            setTimeout(function() {
                messageDiv.style.display = 'none';
            }, 5000);
        }
    </script>
    <script>
        // Hiển thị form sửa thông tin giao hàng
        function showEditShippingForm(orderId) {
            document.getElementById('shipping-info-' + orderId).style.display = 'none';
            document.getElementById('edit-shipping-form-' + orderId).style.display = 'block';
        }
        
        // Ẩn form sửa thông tin giao hàng
        function hideEditShippingForm(orderId) {
            document.getElementById('shipping-info-' + orderId).style.display = 'block';
            document.getElementById('edit-shipping-form-' + orderId).style.display = 'none';
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        // Hàm để xử lý việc chọn tỉnh/thành phố, quận/huyện, xã/phường khi chỉnh sửa địa chỉ
        function initializeAddressSelectors(orderId) {
            // Lấy các phần tử DOM
            const citySelect = document.getElementById('edit-city-' + orderId);
            const districtSelect = document.getElementById('edit-district-' + orderId);
            const wardSelect = document.getElementById('edit-ward-' + orderId);
            
            // Lấy các hidden field để lưu text
            const cityText = document.getElementById('edit_city_text_' + orderId);
            const districtText = document.getElementById('edit_district_text_' + orderId);
            const wardText = document.getElementById('edit_ward_text_' + orderId);
            
            // Lấy địa chỉ hiện tại và phân tích
            const currentAddress = document.getElementById('shipping-info-' + orderId).querySelector('p:nth-child(3)').textContent.replace('Địa chỉ: ', '');
            const addressParts = currentAddress.split(', ');
            
            // Số nhà và đường là phần tử đầu tiên
            const specificAddress = addressParts[0];
            document.getElementById('edit-specific-address-' + orderId).value = specificAddress;
            
            // Fetch the data from GitHub repository
            var Parameter = {
                url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json", 
                method: "GET", 
                responseType: "application/json", 
            };
            
            axios(Parameter)
                .then(function (result) {
                    renderCity(result.data);
                })
                .catch(function(error) {
                    console.error("Error loading administrative data:", error);
                });
            
            function renderCity(data) {
                // Thêm các tùy chọn tỉnh/thành phố
                for (const x of data) {
                    citySelect.options[citySelect.options.length] = new Option(x.Name, x.Id);
                }
                
                citySelect.onchange = function () {
                    districtSelect.length = 1;
                    wardSelect.length = 1;
                    
                    // Store city text value
                    if (cityText) {
                        cityText.value = this.options[this.selectedIndex].text;
                    }
                    
                    // Reset district and ward text values
                    if (districtText) districtText.value = "";
                    if (wardText) wardText.value = "";
                    
                    if(this.value != "") {
                        const result = data.filter(n => n.Id === this.value);
                        
                        for (const k of result[0].Districts) {
                            districtSelect.options[districtSelect.options.length] = new Option(k.Name, k.Id);
                        }
                    }
                };
                
                districtSelect.onchange = function () {
                    wardSelect.length = 1;
                    
                    // Store district text value
                    if (districtText) {
                        districtText.value = this.options[this.selectedIndex].text;
                    }
                    
                    // Reset ward text value
                    if (wardText) wardText.value = "";
                    
                    const dataCity = data.filter((n) => n.Id === citySelect.value);
                    if (this.value != "") {
                        const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;
                        
                        for (const w of dataWards) {
                            wardSelect.options[wardSelect.options.length] = new Option(w.Name, w.Id);
                        }
                    }
                };
                
                wardSelect.onchange = function() {
                    // Store ward text value
                    if (wardText) {
                        wardText.value = this.options[this.selectedIndex].text;
                    }
                };
            }
        }

        // Sửa hàm hiển thị form để khởi tạo selectors
        function showEditShippingForm(orderId) {
            document.getElementById('shipping-info-' + orderId).style.display = 'none';
            document.getElementById('edit-shipping-form-' + orderId).style.display = 'block';
            
            // Initialize address selectors
            initializeAddressSelectors(orderId);
        }
    </script>
    <script>
        // Hàm xác nhận hủy đơn hàng
        function confirmCancel() {
            return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không? Hành động này không thể hoàn tác.');
        }
    </script>
    <script>
        function filterOrders() {
            const selectedStatus = document.getElementById('status-filter').value;
            const orderItems = document.querySelectorAll('.order-item');
            
            orderItems.forEach(item => {
                const orderStatus = item.querySelector('.order-status').classList[1]; // Lấy class thứ hai là tên trạng thái
                
                if (selectedStatus === 'all' || orderStatus === selectedStatus) {
                    item.classList.remove('filtered');
                } else {
                    item.classList.add('filtered');
                }
            });
            
            // Hiển thị thông báo nếu không có đơn hàng nào khớp với bộ lọc
            const visibleOrders = document.querySelectorAll('.order-item:not(.filtered)');
            const orderList = document.querySelector('.order-list');
            const noOrdersMessage = document.querySelector('.no-filtered-orders');
            
            if (visibleOrders.length === 0 && orderList) {
                if (!noOrdersMessage) {
                    const message = document.createElement('p');
                    message.className = 'no-filtered-orders';
                    message.textContent = 'Không có đơn hàng nào khớp với bộ lọc';
                    orderList.insertAdjacentElement('afterend', message);
                }
            } else if (noOrdersMessage) {
                noOrdersMessage.remove();
            }
        }
        
        // Lưu trạng thái bộ lọc khi chuyển trang
        document.getElementById('status-filter').addEventListener('change', function() {
            localStorage.setItem('orderStatusFilter', this.value);
        });
        
        // Khôi phục trạng thái bộ lọc khi tải trang
        window.addEventListener('load', function() {
            const savedFilter = localStorage.getItem('orderStatusFilter');
            if (savedFilter) {
                document.getElementById('status-filter').value = savedFilter;
                filterOrders();
            }
        });
    </script>
    <script>
        // Hàm chuyển đổi giữa các tab đơn hàng
        function showOrderTab(tabId) {
            // Ẩn tất cả các section
            document.querySelectorAll('.order-section').forEach(section => {
                section.classList.remove('active');
                section.style.display = 'none';
            });
            
            // Bỏ active tất cả các tab button
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active');
            });
            
            // Hiển thị section được chọn
            const selectedSection = document.getElementById(tabId);
            selectedSection.classList.add('active');
            selectedSection.style.display = 'block';
            
            // Active tab button được chọn
            event.target.classList.add('active');

            // Reset status filter when switching tabs
            document.getElementById('status-filter').value = 'all';
            if (tabId === 'regular-orders') {
                filterOrders();
            }
        }
        
        // Hiển thị tab đơn hàng thường mặc định
        document.addEventListener('DOMContentLoaded', function() {
            // Ẩn tất cả các section trước
            document.querySelectorAll('.order-section').forEach(section => {
                section.style.display = 'none';
            });
            
            // Hiển thị section đơn hàng thường
            const regularOrders = document.getElementById('regular-orders');
            regularOrders.classList.add('active');
            regularOrders.style.display = 'block';
        });
    </script>
</body>
</html>