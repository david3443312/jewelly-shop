<?php 
    include '../components/connect.php';
    if (isset($_COOKIE['vendor_id'])) {
        $vendor_id = $_COOKIE['vendor_id'];
    } else {
        $vendor_id = '';
        header('location: login.php');
    }

    // Add product
    if (isset($_POST['publish'])) {
        $id = unique_id();
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);

        $category = $_POST['category'];
        $category = filter_var($category, FILTER_SANITIZE_SPECIAL_CHARS);

        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $description = $_POST['description'];
        $description = filter_var($description, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $stock = $_POST['stock'];
        $stock = filter_var($stock, FILTER_SANITIZE_SPECIAL_CHARS);
        $status = 'active';

        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_SPECIAL_CHARS);
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name']; 
        $image_folder = '../uploaded_files/' . $image;
        
        $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? And vendor_id = ?");
        
        $select_image->execute([$image, $vendor_id]);
        if (isset($image)) {
            if ($select_image->rowCount() > 0) {
                $warning_msg[] = 'This image already exists';
            } elseif ($image_size > 2000000) {
                $warning_msg[] = 'Image size is too large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
            }
        }else {
            $image = '';
        }
        if ($select_image->rowCount() > 0 AND $image != '') {
            $warning_msg[] = 'Please rename your image';
        } else {
            $insert_product = $conn->prepare("INSERT INTO `products` (id, vendor_id, name, price, image, stock, product_detail, status, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_product->execute([$id, $vendor_id, $name, $price, $image, $stock, $description, $status, $category]);
            $success_msg[] = 'Product added successfully';
        }
    }

    if (isset($_POST['draft'])) {
        $id = unique_id();
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);

        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $description = $_POST['description'];
        $description = filter_var($description, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $stock = $_POST['stock'];
        $stock = filter_var($stock, FILTER_SANITIZE_SPECIAL_CHARS);
        $status = 'deactive';

        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_SPECIAL_CHARS);
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name']; 
        $image_folder = '../uploaded_files/' . $image;
        
        $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? And vendor_id = ?");
        
        $select_image->execute([$image, $vendor_id]);
        if (isset($image)) {
            if ($select_image->rowCount() > 0) {
                $warning_msg[] = 'This image already exists';
            } elseif ($image_size > 2000000) {
                $warning_msg[] = 'Image size is too large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
            }
        }else {
            $image = '';
        }
        if ($select_image->rowCount() > 0 AND $image != '') {
            $warning_msg[] = 'Please rename your image';
        } else {
            $insert_product = $conn->prepare("INSERT INTO `products` (id, vendor_id, name, price, image, stock, product_detail, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_product->execute([$id,$vendor_id, $name, $price, $image, $stock, $description, $status]);
            $success_msg[] = 'Product saved as draft successfully';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm - Jewelry Shop</title>
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
        <section class="post-editor">
            <div class="heading mt-xxl-5 ">
                <h1>Add products</h1>
            </div>
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data" class="register">
                    <div class="input-feild">
                        <p>Product name <span>*</span></p>
                        <input type="text" name="name" maxlength="100" placeholder="Add product name" required class="box">
                    </div>
                    <div class="input-feild">
                        <p>Product Category <span>*</span></p>
                        <select name="category" class="box" required>
                            <option value="" disabled selected>-- Chọn loại sản phẩm --</option>
                            <option value="ring">Nhẫn</option>
                            <option value="bracelet">Vòng tay</option>
                            <option value="necklace">Vòng cổ</option>
                            <option value="chain">Dây chuyền</option>
                            <option value="earring">Khuyên tai</option>
                            <option value="watch">Đồng hồ</option>
                        </select>
                    </div>
                    <div class="input-feild">
                        <p>Product price <span>*</span></p>
                        <input type="number" name="price" placeholder="Add product price" required class="box">
                    </div>
                    <div class="input-feild">
                        <p>Product detail <span>*</span></p>
                        <textarea name="description" required maxlength="1000" placeholder="Add product detail" class="box"></textarea>
                    </div>
                    <div class="input-feild">
                        <p>Product stock <span>*</span></p>
                        <input type="number" name="stock" maxlength="10" max="999999999" placeholder="Add product stock" required class="box">
                    </div>
                    
                    <div class="input-feild">
                        <p>Product image <span>*</span></p>
                        <input type="file" name="image" accept="image/*" required class="box">
                    </div>
                    <div class="flex-btn">
                        <input type="submit" name="publish" value="Add product" class="btn">
                        <input type="submit" name="draft" value="Save draft" class="btn">
                    </div>
                </form>
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
