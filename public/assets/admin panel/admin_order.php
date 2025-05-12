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
    <style>
        .order-box .box {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .order-box .box1 {
            width: 90% !important;
        }

        .order-box .status {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
        }
        .order-box .form-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }
        .order-box .select-container {
            margin-bottom: 15px;
            width: 100%;
        }
        .order-box .select-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }
        .order-box .select-container input,
        .order-box .select-container select,
        .order-box .select-container textarea {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        .order-box .select-container input:focus,
        .order-box .select-container select:focus,
        .order-box .select-container textarea:focus {
            border-color: #4CAF50;
            outline: none;
        }
        
        .order-box .select-container {
            margin-bottom: -20px !important;
        }

        .order-box .select-container textarea {
            height: 80px;
            resize: vertical;
        }
        .order-box .flex-btn {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .order-box .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        .order-box .btn[value="update order"] {
            background: #4CAF50;
            color: white;
        }
        .order-box .btn[value="delete order"] {
            background: #f44336;
            color: white;
        }
        .order-box .btn:hover {
            opacity: 0.9;
        }
    </style>
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
                    <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?= $fetch_order['id'] ?>">
                        <div class="form-container">
                            <div class="select-container">
                                <label>Customer Name:</label>
                                <input type="text" name="update_name" class="box box1" value="<?= $fetch_order['name'] ?>" required>
                            </div>
                            <div class="select-container">
                                <label>Email:</label>
                                <input type="email" name="update_email" class="box box1" value="<?= $fetch_order['email'] ?>" required>
                            </div>
                            <div class="select-container">
                                <label>Phone:</label>
                                <input type="text" name="update_phone" class="box box1" value="<?= $fetch_order['phone'] ?>" required>
                            </div>
                            <div class="select-container">
                                <label>Total Price (VND):</label>
                                <input type="number" name="update_total_price" class="box box1" value="<?= $fetch_order['total_price'] ?>" min="1000" step="1000" required>
                            </div>
                            <div class="select-container">
                                <label>Shipping Cost (VND):</label>
                                <input type="number" name="update_shipping_cost" class="box box1" value="<?= $fetch_order['shipping_cost'] ?>" min="0" step="1000" required>
                            </div>
                            <div class="select-container">
                                <label>Payment Method:</label>
                                <select name="update_payment_method" class="box box1">
                                    <option value="<?= $fetch_order['payment_method']; ?>" selected><?= $fetch_order['payment_method']; ?></option>
                                    <option value="COD">COD</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="PayPal">PayPal</option>
                                </select>
                            </div>
                            <div class="select-container">
                                <label>Payment Status:</label>
                                <select name="update_payment" class="box box1">
                                    <option value="<?= $fetch_order['payment_status']; ?>" selected><?= $fetch_order['payment_status']; ?></option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                            <div class="select-container">
                                <label>Order Status:</label>
                                <select name="update_status" class="box box1">
                                    <option value="<?= $fetch_order['status']; ?>" selected><?= $fetch_order['status']; ?></option>
                                    <option value="pending">Pending</option>
                                    <option value="in progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="select-container" style="grid-column: 1 / -1;">
                                <label>Address:</label>
                                <textarea name="update_address" class="box box1" required><?= $fetch_order['address'] ?></textarea>
                            </div>
                            <div class="flex-btn">
                                <input type="submit" name="update_order" value="update order" class="btn">
                                <input type="submit" name="delete_order" value="delete order" class="btn" 
                                onclick="return confirm('Are you sure you want to delete this order?')">
                            </div>
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
