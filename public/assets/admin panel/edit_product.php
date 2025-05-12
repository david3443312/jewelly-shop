<?php 
    include '../components/connect.php';
    if (isset($_COOKIE['vendor_id'])) {
        $vendor_id = $_COOKIE['vendor_id'];
    } else {
        $vendor_id = '';
        header('location: login.php');
    }

    if (isset($_POST['update'])) {
        $product_id = $_POST['product_id'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_SPECIAL_CHARS);
        
        // Lấy và sanitize tất cả giá trị từ form TRƯỚC KHI sử dụng
        $category = $_POST['category'];
        $category = filter_var($category, FILTER_SANITIZE_SPECIAL_CHARS);

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);

        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $description = $_POST['description'];
        $description = filter_var($description, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $stock = $_POST['stock'];
        $stock = filter_var($stock, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $status = $_POST['status'];
        $status = filter_var($status, FILTER_SANITIZE_SPECIAL_CHARS);

        $update_product = $conn->prepare("UPDATE `products` SET name = ?, price = ?, product_detail = ?, stock = ?, status = ?, category = ? WHERE id = ?");
        $update_product->execute([$name, $price, $description, $stock, $status, $category, $product_id]);
        $success_msg[] = 'Product updated successfully';

        $old_image = $_POST['old_image'];
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_SPECIAL_CHARS);
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name']; 
        $image_folder = '../uploaded_files/' . $image;
        
        $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? And vendor_id = ?");

        $select_image->execute([$image, $vendor_id]);

        if (!empty($image)) {
            if ($image_size > 2000000) {
                $warning_msg[] = 'Image size is too large';
            } elseif ($select_image->rowCount() > 0) {
                $warning_msg[] = 'Please rename your image';
            } else {
                $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
                $update_image->execute([$image, $product_id]);
                move_uploaded_file($image_tmp_name, $image_folder);
                if ($old_image != $image AND $old_image != '') {
                    unlink('../uploaded_files/'.$old_image);
                }
                $success_msg[] = 'Image updated successfully';
            }
        }
    }
    // Delete image
    if (isset($_POST['delete_image'])) {
        $empty_image = '';

        $product_id = $_POST['product_id'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $delete_image->execute([$product_id]);
        $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

        if ($fetch_delete_image['image'] != '') {
            unlink('../uploaded_files/'.$fetch_delete_image['image']);
        }
        $unset_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
        $unset_image->execute([$empty_image, $product_id]);
        $success_msg[] = 'Image deleted successfully';
    }

    // Delete product
    if (isset($_POST['cancel'])) {
        $product_id = $_POST['product_id'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_SPECIAL_CHARS);

        $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $delete_image->execute([$product_id]);
        $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

        if ($fetch_delete_image['image'] != '') {
            unlink('../uploaded_files/'.$fetch_delete_image['image']);
        }
        $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
        $delete_product->execute([$product_id]);
        $success_msg[] = 'Product deleted successfully';
        header('location: view_product.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm - Jewelry Shop</title>
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
        <section class="post-editor">
            <div class="heading">
                <h1>Edit product</h1>
            </div>
            <div class="box-container">
                <?php 
                    $product_id = $_GET['id'];
                    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND vendor_id = ?");
                    $select_product->execute([$product_id, $vendor_id]);
                    if ($select_product->rowCount() > 0) {
                        while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="form-container">
                    <form action="" method="post" enctype="multipart/form-data" class="edit-form">
                        <input type="hidden" name="old_image" value="<?= $fetch_product['image']; ?>">
                        <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
                        <div class="input-field">
                            <p>Product status <span>*</span></p>
                            <select name="status" class="box">
                                <option value="active" <?= ($fetch_product['status'] == 'active') ? 'selected' : ''; ?>>active</option>
                                <option value="deactive" <?= ($fetch_product['status'] == 'deactive') ? 'selected' : ''; ?>>deactive</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <p>Product Category <span>*</span></p>
                            <select name="category" class="box" required>
                                <option value="<?= $fetch_product['category']; ?>" selected><?= $fetch_product['category']; ?></option>
                                <option value="ring">Nhẫn</option>
                                <option value="bracelet">Vòng tay</option>
                                <option value="necklace">Vòng cổ</option>
                                <option value="chain">Dây chuyền</option>
                                <option value="earring">Khuyên tai</option>
                                <option value="watch">Đồng hồ</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <p>Product name <span>*</span></p>
                            <input type="text" name="name" value="<?= $fetch_product['name']; ?>" class="box">
                        </div>
                        <div class="input-field">
                            <p>Product price <span>*</span></p>
                            <input type="text" name="price" value="<?= $fetch_product['price']; ?>" class="box">
                        </div>
                        <div class="input-field">
                            <p>Product description <span>*</span></p>
                            <textarea name="description" class="box"><?= $fetch_product['product_detail']; ?></textarea>
                        </div>
                        <div class="input-field">
                            <p>Product stock <span>*</span></p>
                            <input type="text" name="stock" value="<?= $fetch_product['stock']; ?>" class="box" min="0" max="999999999" maxlength="10">
                        </div>
                        <div class="input-field">
                            <p>Product image <span>*</span></p>
                            <input type="file" name="image" accept="image/*" class="box">
                            <?php if ($fetch_product['image'] != '') { ?>
                                <img src="../uploaded_files/<?= $fetch_product['image']; ?>" class="edit-image">
                                <div class="button-container">
                                    <div class="button-group">
                                        <input type="submit" name="delete_image" value="Delete Image" class="btn btn-delete">
                                        <a href="view_product.php" class="btn">Go Back</a>
                                        <a href="view_product.php" class="btn">View Product</a>
                                        <a href="add_products.php" class="btn">Add Product</a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="button-container">
                            <input type="submit" name="update" value="Update" class="btn">
                            <input type="submit" name="cancel" value="Delete product" class="btn">
                    </form>
                    <?php 
                            }
                        } else {
                            echo '<div class="empty">
                                <h1>No products found</h1>
                                <a href="add_products.php" class="btn">Add products</a> 
                            </div>';
                        }
                    ?>
                </div>
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
