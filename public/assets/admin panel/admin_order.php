<?php 
    include '../components/connect.php';
    if (isset($_COOKIE['vendor_id'])) {
        $vendor_id = $_COOKIE['vendor_id'];
    } else {
        $vendor_id = '';
        header('location: login.php');
    }

    // Xử lý tìm kiếm đơn hàng
    $search_query = '';
    if (isset($_GET['search_order'])) {
        $search_query = trim($_GET['search_order']);
    }

    // Update order from database
    if (isset($_POST['update_order'])) {
        $order_id = $_POST['order_id'];
        $order_id = filter_var($order_id, FILTER_SANITIZE_SPECIAL_CHARS);

        $update_name = $_POST['update_name'];
        $update_name = filter_var($update_name, FILTER_SANITIZE_SPECIAL_CHARS);

        $update_email = $_POST['update_email'];
        $update_email = filter_var($update_email, FILTER_SANITIZE_SPECIAL_CHARS);

        $update_phone = $_POST['update_phone'];
        $update_phone = filter_var($update_phone, FILTER_SANITIZE_SPECIAL_CHARS);

        $update_address = $_POST['update_address'];
        $update_address = filter_var($update_address, FILTER_SANITIZE_SPECIAL_CHARS);

        $update_total_price = $_POST['update_total_price'];
        $update_total_price = filter_var($update_total_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        $update_shipping_cost = $_POST['update_shipping_cost'];
        $update_shipping_cost = filter_var($update_shipping_cost, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        $update_payment_method = $_POST['update_payment_method'];
        $update_payment_method = filter_var($update_payment_method, FILTER_SANITIZE_SPECIAL_CHARS);

        $update_payment = $_POST['update_payment'];
        $update_payment = filter_var($update_payment, FILTER_SANITIZE_SPECIAL_CHARS);

        $update_status = $_POST['update_status'];
        $update_status = filter_var($update_status, FILTER_SANITIZE_SPECIAL_CHARS);

        $update_order = $conn->prepare("UPDATE `orders` SET name = ?, email = ?, phone = ?, address = ?, total_price = ?, shipping_cost = ?, payment_method = ?, payment_status = ?, status = ? WHERE id = ?");
        $update_order->execute([$update_name, $update_email, $update_phone, $update_address, $update_total_price, $update_shipping_cost, $update_payment_method, $update_payment, $update_status, $order_id]);
        $success_msg[] = "Order updated successfully!";
    }

    // Xử lý xóa đơn hàng
    if (isset($_POST['delete_order_id'])) {
        $delete_order_id = $_POST['delete_order_id'];
        $delete_order_id = filter_var($delete_order_id, FILTER_SANITIZE_NUMBER_INT);
        $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
        $delete_order->execute([$delete_order_id]);
        $success_msg[] = "Đã xóa đơn hàng thành công!";
    }
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm - Jewelry Shop</title>
    <link rel="stylesheet" href="../css//stylessignup.css">
    <link rel="stylesheet" href="../css//admin_style.css">
    <link rel="stylesheet" href="../css//styleshomepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <link rel="icon" href="../images/logoicon.png" type="image/x-icon">
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'?>
    </div>
    
    <section class="order-box">
        <div class="order">
            <div class="heading">
                <h1>Total orders placed</h1>
                <!-- Form tìm kiếm -->
                <form method="get" class="order-search-form">
                    <input type="text" name="search_order" placeholder="Tìm kiếm theo tên, email, SĐT hoặc mã đơn" value="<?= htmlspecialchars($search_query) ?>">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
            <div class="box-container">
                <?php
                    // Xử lý truy vấn tìm kiếm
                    if (!empty($search_query)) {
                        $sql = "SELECT * FROM `orders` WHERE id LIKE ? OR name LIKE ? OR email LIKE ? OR phone LIKE ? ORDER BY id DESC";
                        $param = "%$search_query%";
                        $select_order = $conn->prepare($sql);
                        $select_order->execute([$param, $param, $param, $param]);
                    } else {
                        $select_order = $conn->prepare("SELECT * FROM `orders` ORDER BY id DESC");
                        $select_order->execute();
                    }
                    
                    if ($select_order->rowCount() > 0) {
                        while ($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="box">
                    <div class="status" style="color: <?php if($fetch_order['status']=='in progress') {
                        echo "limegreen";}else{echo "red";}?>"><?= $fetch_order['status']; ?></div>
                    <div class="form-container">
                        <div class="select-container"><label style="display:inline;font-weight:500;">Customer Name:</label> <span style="background:none; padding:0; border:none;"> <?= htmlspecialchars($fetch_order['name']) ?> </span></div>
                        <div class="select-container"><label style="display:inline;font-weight:500;">Email:</label> <span style="background:none; padding:0; border:none;"> <?= htmlspecialchars($fetch_order['email']) ?> </span></div>
                        <div class="select-container"><label style="display:inline;font-weight:500;">Phone:</label> <span style="background:none; padding:0; border:none;"> <?= htmlspecialchars($fetch_order['phone']) ?> </span></div>
                        <div class="select-container"><label style="display:inline;font-weight:500;">Total Price (VND):</label> <span style="background:none; padding:0; border:none;"> <?= number_format($fetch_order['total_price']) ?> </span></div>
                        <div class="select-container"><label style="display:inline;font-weight:500;">Shipping Cost (VND):</label> <span style="background:none; padding:0; border:none;"> <?= number_format($fetch_order['shipping_cost']) ?> </span></div>
                        <div class="select-container"><label style="display:inline;font-weight:500;">Payment Method:</label> <span style="background:none; padding:0; border:none;"> <?= htmlspecialchars($fetch_order['payment_method']) ?> </span></div>
                        <div class="select-container"><label style="display:inline;font-weight:500;">Payment Status:</label> <span style="background:none; padding:0; border:none;"> <?= htmlspecialchars($fetch_order['payment_status']) ?> </span></div>
                        <div class="select-container"><label style="display:inline;font-weight:500;">Order Status:</label> <span style="background:none; padding:0; border:none;"> <?= htmlspecialchars($fetch_order['status']) ?> </span></div>
                        <div class="select-container" style="grid-column: 1 / -1;"><label style="display:inline;font-weight:500;">Address:</label> <span style="background:none; padding:0; border:none; white-space:pre-line;"> <?= nl2br(htmlspecialchars($fetch_order['address'])) ?> </span></div>
                        <div class="flex-btn">
                            <a href="edit_order.php?id=<?= $fetch_order['id'] ?>" class="btn" style="background:#4CAF50; color:white;">Edit</a>
                            <form method="post" action="" style="display:inline;">
                                <input type="hidden" name="delete_order_id" value="<?= $fetch_order['id'] ?>">
                                <button type="submit" class="btn delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');" style="background:#ff4444; color:white; margin-left:8px;">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    } else {
                        echo '<div class="empty"><p>No order placed yet!</p></div>';
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- sweetalert cdn link -->
     <script src = "https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- sweetalert cdn link -->
    <?php include '../components/alert.php'; ?>
    <script src="../js//admin_script.js"></script>
</body>
</html>
