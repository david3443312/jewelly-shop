<?php 
    include '../components/connect.php';
    if (isset($_COOKIE['vendor_id'])) {
        $vendor_id = $_COOKIE['vendor_id'];
    } else {
        $vendor_id = '';
        header('location: login.php');
    }

    $get_id = $_GET['post_id'];

     // Delete product
     if (isset($_POST['delete'])) {
        $product_id = $_POST['product_id'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND vendor_id = ?");
        $delete_image->execute([$product_id, $vendor_id]);

        $fetch_delete_img = $delete_image->fetch(PDO::FETCH_ASSOC);
        if ($fetch_delete_img['image'] != '') {
            unlink('../uploaded_files/'.$fetch_delete_img['image']);
        }
        $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ? AND vendor_id = ?");
        $delete_product->execute([$product_id, $vendor_id]);
        header('location: view_product.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem sản phẩm - Jewelry Shop</title>
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
    
    <div class="box-container rp-container">
            <div class="rp-heading">
                <h1>Product detail</h1>
            </div>
        <section class="read-post">
            <div class="container">
                <?php 
                    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND vendor_id = ?");
                    $select_product->execute([$get_id, $vendor_id]);
                    if ($select_product->rowCount() > 0) {
                        while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <form action="" method="post" class="box">
                    <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
                    <div class="status" style="color: <?php if($fetch_product['status'] == 'active'){
                        echo "limegreen";
                    } else {
                        echo "coral";
                    };?>"><?= $fetch_product['status']; ?>
                    </div>
                    <?php if ($fetch_product['image'] != '') { ?>
                        <img src="../uploaded_files/<?= $fetch_product['image']; ?>" class="view-image">
                    <?php } ?>
                    <div class="price">$<?= $fetch_product['price']; ?></div>
                    <div class="title"><?= $fetch_product['name']; ?></div>
                    <div class="content"><?= $fetch_product['product_detail']; ?></div>
                    <div class="flex-btn">
                        <a href="edit_product.php?id=<?= $fetch_product['id']; ?>" class="btn">Edit</a>
                        <button type="submit" name="delete" class="btn btn-delete" onclick="return confirm('Delete the product?');">Delete</button>
                        <a href="view_product.php?post_id=<?= $fetch_product['id']; ?>" class="btn">Go back</a>
                    </div>
                </form>
                <?php
                        }
                    }else {
                        echo '<div class="empty">
                            <h1>No products found</h1>
                            <a href="add_products.php" class="btn et-btn">Add products</a> 
                        </div>';
                    }
                ?>
            </div>
        </section>
    </div>
    <!-- sweetalert cdn link -->
     <script src = "https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- sweetalert cdn link -->
    <?php include '../components/alert.php'; ?>
    <script src="../js//admin_script.js"></script>
</body>
</html>
