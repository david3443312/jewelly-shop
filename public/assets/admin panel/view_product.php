<?php 
    include '../components/connect.php';
    if (isset($_COOKIE['vendor_id'])) {
        $vendor_id = $_COOKIE['vendor_id'];
    } else {
        $vendor_id = '';
        header('location: login.php');
    }

    // Delete product
    if (isset($_POST['delete'])) {
        $product_id = $_POST['product_id'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_SPECIAL_CHARS);
        $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
        $delete_product->execute([$product_id]);
        $success_msg[] = 'Product deleted successfully';
    }

    // Search product
    $search_keyword = '';
    if (isset($_POST['search_product'])) {
        $search_keyword = trim($_POST['search_keyword']);
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
    <div class="box-container">
        <section class="show_post">
            <div class="heading mt-xxl-5 ">
                <h1>Your products</h1>
            </div>
            <div class="search-container" style="margin: 20px 0;">
                <form method="post" action="" style="display:inline-block;">
                    <input type="text" name="search_keyword" placeholder="Tìm kiếm sản phẩm..." value="<?= htmlspecialchars($search_keyword) ?>" style="padding:8px; width:250px;">
                    <button type="submit" name="search_product" class="btn">Tìm kiếm</button>
                </form>
            </div>
            <div class="container">
                <?php 
                    if ($search_keyword != '') {
                        $select_product = $conn->prepare("SELECT * FROM `products` WHERE vendor_id = ? AND name LIKE ?");
                        $select_product->execute([$vendor_id, "%$search_keyword%"]);
                    } else {
                        $select_product = $conn->prepare("SELECT * FROM `products` WHERE vendor_id = ?");
                        $select_product->execute([$vendor_id]);
                    }
                    if ($select_product->rowCount() > 0) {
                        while ($fetch_products = $select_product->fetch(PDO::FETCH_ASSOC)) {
                                           
                ?>
                <form action="" method="post" class="box">
                        <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                        <?php if ($fetch_products['image'] != '') { ?>
                            <img src="../uploaded_files/<?= $fetch_products['image']; ?>" class="view-image">
                        <?php } ?>
                        <div class="status" style="color: <?php if($fetch_products['status'] == 'active'){
                            echo "limegreen";
                        } else {
                            echo "coral";
                        } ?>"><?= $fetch_products['status']; ?></div>
                        <div class="price"><?= $fetch_products['price']; ?></div>
                        <div class="content">
                            <div class="title"><?= $fetch_products['name']; ?></div>
                            <div class="flex-btn">
                            <a href="edit_product.php?id=<?= $fetch_products['id']; ?>" class="btn">Edit</a>
                            <button type="submit" name="delete" class="btn btn-delete" onclick="return confirm('Delete the product?');">Delete</button>
                            <a href="read_product.php?post_id=<?= $fetch_products['id']; ?>" class="btn">Read product</a>
                    </div>
                        </div>
                </form>
                <?php 
                        }
                    } else {
                        echo '<div class="empty">
                            <h1>No products found</h1>';
                        if ($search_keyword != '') {
                            echo '<a href="view_product.php" class="btn">Xem tất cả sản phẩm</a>';
                        } else {
                            echo '<a href="add_products.php" class="btn">Add products</a>';
                        }
                        echo '</div>';
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
