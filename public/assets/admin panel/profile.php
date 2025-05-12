<?php
    include '../components/connect.php';
    if (isset($_COOKIE['vendor_id'])) {
        $vendor_id = $_COOKIE['vendor_id'];
    } else {
        header('location: login.php');
        exit;
    }

    $select_profile = $conn->prepare("SELECT * FROM `vendors` WHERE id = ?");
    $select_profile->execute([$vendor_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    
    if (!$fetch_profile) {
        header('location: login.php');
        exit;
    }

    $select_products = $conn->prepare("SELECT * FROM `products` WHERE vendor_id = ?");
    $select_products->execute([$vendor_id]);
    $total_products = $select_products->rowCount();

    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE vendor_id = ?");
    $select_orders->execute([$vendor_id]);
    $total_orders = $select_orders->rowCount();

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
        <section class="dashboard">
            <div class="heading p-heading">
                <h1>Profile detail</h1>
            </div>
            <div class="details">
                <div class="vendor">
                    <div class="p-head">
                        <?php if(!empty($fetch_profile['image'])): ?>
                        <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" style="width:200px; height:200px; object-fit:cover; border-radius:50%;" >
                        <?php else: ?>
                        <img src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg" style="width:200px; height:200px; object-fit:cover; border-radius:50%;" alt="">
                        <?php endif; ?>
                        <h3 class="name"><?= $fetch_profile['name']; ?></h3>
                        <a href="update.php" class="btn">Update profile</a>
                    </div>
                </div>
                <div class="flex">
                    <div class="box">
                        <span><?= $total_products; ?></span>
                        <p>Total products</p>
                        <a href="view_product.php" class="btn">View products</a>
                    </div>
                    <div class="box">
                        <span><?= $total_orders; ?></span>
                        <p>Total orders placed</p>
                        <a href="admin_order.php" class="s-btn">View orders</a>
                </div>
            </div>
        </section>
    </div>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- sweetalert cdn link -->
    <?php include '../components/alert.php'; ?>
    <script src="../js//admin_script.js"></script>
<script></script>
</body>
</html>
