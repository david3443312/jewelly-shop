<?php 
    include '../components/connect.php';
    if (isset($_COOKIE['vendor_id'])) {
        $vendor_id = $_COOKIE['vendor_id'];
    } else {
        $vendor_id = '';
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry - shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../css//admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <link rel="icon" href="../images/logoicon.png" type="image/x-icon">
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'?>
    </div>
    
    <div class="db-container">
        <div class="right db-right">
            <div class="heading">
                <h1>Dashboard</h1>
            </div>
            <div class="box-container">
                <div class="db-box">
                    <?php
                        $select_message = $conn->prepare("SELECT * FROM `message`");
                        $select_message->execute();
                        $number_of_msg = $select_message->rowCount();
                    ?>
                    <h4><?= $number_of_msg; ?></h4>
                    <p>Unread message</p>
                    <a href="admin_message.php" class="btn">See message</a>
                </div>
                <div class="db-box">
                    <?php
                        $select_products = $conn->prepare("SELECT * FROM `products` WHERE vendor_id = ?");
                        $select_products->execute([$vendor_id]);
                        $number_of_products = $select_products->rowCount();
                    ?>
                    <h4><?= $number_of_products; ?></h4>
                    <p>Products added</p>
                    <a href="add_products.php" class="btn">Add product</a>
                </div>
                <div class="db-box">
                    <?php
                        $select_active_products = $conn->prepare("SELECT * FROM `products` WHERE vendor_id = ? AND status = ?");
                        $select_active_products->execute([$vendor_id, 'active']);
                        $number_of_active_products = $select_active_products->rowCount();
                    ?>
                    <h4><?= $number_of_active_products; ?></h4>
                    <p>Total active products</p>
                    <a href="view_product.php" class="btn">Active product</a>
                </div>
                <div class="db-box">
                    <?php
                        $select_deactive_products = $conn->prepare("SELECT * FROM `products` WHERE vendor_id = ? AND status = ?");
                        $select_deactive_products->execute([$vendor_id, 'deactive']);
                        $number_of_deactive_products = $select_deactive_products->rowCount();
                    ?>
                    <h4><?= $number_of_deactive_products; ?></h4>
                    <p>Total deactive products</p>
                    <a href="view_product.php" class="btn">Deactive product</a>
                </div>
                <div class="db-box">
                    <?php
                        $select_users = $conn->prepare("SELECT * FROM `users`");
                        $select_users->execute();
                        $number_of_users = $select_users->rowCount();
                    ?>
                    <h4><?= $number_of_users; ?></h4>
                    <p>Users account</p>
                    <a href="user_accounts.php" class="btn">See users</a>
                </div>
                <div class="db-box">
                    <?php
                        $select_vendors = $conn->prepare("SELECT * FROM `vendors`");
                        $select_vendors->execute();
                        $number_of_vendors = $select_vendors->rowCount();
                    ?>
                    <h4><?= $number_of_vendors; ?></h4>
                    <p>Vendors account</p>
                    <a href="user_accounts.php" class="btn">See vendors</a>
                </div>
                <div class="db-box">
                    <?php
                        try {
                            $select_orders = $conn->prepare("SELECT * FROM `orders`");
                            $select_orders->execute();
                            $number_of_orders = $select_orders->rowCount();
                        } catch(PDOException $e) {
                            $number_of_orders = 0;
                            error_log("Database error: " . $e->getMessage());
                        }
                    ?>
                    <h4><?= $number_of_orders; ?></h4>
                    <p>Total orders placed</p>
                    <a href="admin_order.php" class="btn">Total orders</a>
                </div>
                <div class="db-box">
                    <?php
                        try {
                            $select_confirm_orders = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
                            $select_confirm_orders->execute(['in progress']);
                            $number_of_confirm_orders = $select_confirm_orders->rowCount();
                        } catch(PDOException $e) {
                            $number_of_confirm_orders = 0;
                            error_log("Database error: " . $e->getMessage());
                        }
                    ?>
                    <h4><?= $number_of_confirm_orders; ?></h4>
                    <p>Total confirm orders</p>
                    <a href="admin_order.php" class="btn">Confirm orders</a>
                </div>
                <div class="db-box">
                    <?php
                        try {
                            $select_canceled_orders = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
                            $select_canceled_orders->execute(['cancelled']);
                            $number_of_canceled_orders = $select_canceled_orders->rowCount();
                        } catch(PDOException $e) {
                            $number_of_canceled_orders = 0;
                            error_log("Database error: " . $e->getMessage());
                        }
                    ?>
                    <h4><?= $number_of_canceled_orders; ?></h4>
                    <p>Total canceled orders</p>
                    <a href="admin_order.php" class="btn">canceled orders</a>
                </div>
                <div class="db-box">
                    <?php
                        try {
                            $select_custom_designs = $conn->prepare("SELECT * FROM `custom_designs`");
                            $select_custom_designs->execute();
                            $number_of_custom_designs = $select_custom_designs->rowCount();
                        } catch(PDOException $e) {
                            $number_of_custom_designs = 0;
                            error_log("Database error: " . $e->getMessage());
                        }
                    ?>
                    <h4><?= $number_of_custom_designs; ?></h4>
                    <p>Custom jewelry requests</p>
                    <a href="custom_designs.php" class="btn">View requests</a>
                </div>
                <div class="db-box">
                    <?php
                        try {
                            $select_couple_designs = $conn->prepare("SELECT * FROM `couple_designs`");
                            $select_couple_designs->execute();
                            $number_of_couple_designs = $select_couple_designs->rowCount();
                        } catch(PDOException $e) {
                            $number_of_couple_designs = 0;
                            error_log("Database error: " . $e->getMessage());
                        }
                    ?>
                    <h4><?= $number_of_couple_designs; ?></h4>
                    <p>Couple jewelry requests</p>
                    <a href="couple_designs.php" class="btn">View requests</a>
                </div>
                <div class="db-box">
                    <?php
                        try {
                            $select_group_designs = $conn->prepare("SELECT * FROM `group_designs`");
                            $select_group_designs->execute();
                            $number_of_group_designs = $select_group_designs->rowCount();
                        } catch(PDOException $e) {
                            $number_of_group_designs = 0;
                            error_log("Database error: " . $e->getMessage());
                        }
                    ?>
                    <h4><?= $number_of_group_designs; ?></h4>
                    <p>Group jewelry requests</p>
                    <a href="group_designs.php" class="btn">View requests</a>
                </div>
            </div>
        </div>
    </div>
    <!-- sweetalert cdn link -->
     <script src = "https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
         <?php include '../components/alert.php'; ?>
         <script src="../js//admin_script.js"></script>
</body>
</html>
