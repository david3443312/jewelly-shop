<?php 
    include '../components/connect.php';
    if (isset($_COOKIE['vendor_id'])) {
        $vendor_id = $_COOKIE['vendor_id'];
    } else {
        $vendor_id = '';
        header('location: login.php');
    }

    // Update order from database
    if (isset($_POST['update_order'])) {
        $order_id = $_POST['order_id'];
        $order_id = filter_var($order_id, FILTER_SANITIZE_SPECIAL_CHARS);

        $update_payment = $_POST['update_payment'];
        $update_payment = filter_var($update_payment, FILTER_SANITIZE_SPECIAL_CHARS);

        $update_status = $_POST['update_status'];
        $update_status = filter_var($update_status, FILTER_SANITIZE_SPECIAL_CHARS);

        $update_order = $conn->prepare("UPDATE `orders` SET payment_status = ?, status = ? WHERE id = ?");
        $update_order->execute([$update_payment, $update_status, $order_id]);
        $success_msg[] = "Order updated successfully!";
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
            </div>
            <div class="box-container">
                <?php
                    $select_order = $conn->prepare("SELECT * FROM `orders`");
                    $select_order->execute();
                    
                    if ($select_order->rowCount() > 0) {
                        while ($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="box">
                    <div class="status" style="color: <?php if($fetch_order['status']=='in progress') {
                        echo "limegreen";}else{echo "red";}?>"><?= $fetch_order['status']; ?></div>
                    <div class="details">
                        <p>User name : <span><?= $fetch_order['name'] ?></span></p>
                        <p>User id : <span><?= $fetch_order['user_id'] ?></span></p>
                        <p>Placed on : <span><?= $fetch_order['order_date'] ?></span></p>
                        <p>User number : <span><?= $fetch_order['phone'] ?></span></p>
                        <p>User email : <span><?= $fetch_order['email'] ?></span></p>
                        <p>Total price : <span><?= $fetch_order['total_price'] ?></span></p>
                        <p>Payment method : <span><?= $fetch_order['payment_method'] ?></span></p>
                        <p>User address : <span><?= $fetch_order['address'] ?></span></p>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?= $fetch_order['id'] ?>">
                        <div class="select-container">
                            <label>Payment Status:</label>
                            <select name="update_payment" class="box" style="width: 90%;">
                                <option value="<?= $fetch_order['payment_status']; ?>" selected><?= $fetch_order['payment_status']; ?></option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="select-container">
                            <label>Order Status:</label>
                            <select name="update_status" class="box" style="width: 90%;">
                                <option value="<?= $fetch_order['status']; ?>" selected><?= $fetch_order['status']; ?></option>
                                <option value="pending">Pending</option>
                                <option value="in progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="flex-btn">
                            <input type="submit" name="update_order" value="update order" class="btn">
                            <input type="submit" name="delete_order" value="delete order" class="btn" 
                            onclick="return confirm('Are you sure you want to delete this order?')">
                        </div>
                    </form>
                </div>
                <?php
                        }
                    } else {
                        echo '<div class="empty">
                        <p>No order placed yet!</p></div>';
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
