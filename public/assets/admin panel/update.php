<?php
    include '../components/connect.php';

    if (isset($_COOKIE['vendor_id'])) {
        $vendor_id = $_COOKIE['vendor_id'];
    } else {
        $vendor_id = '';
        header('location:login.php');
    }

    $select_profile = $conn->prepare("SELECT * FROM `vendors` WHERE id = ?");
    $select_profile->execute([$vendor_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    
    if (!$fetch_profile) {
        header('location: login.php');
        exit;
    }

    if (isset($_POST['submit'])) {
        $select_vendor = $conn->prepare("SELECT * FROM `vendors` WHERE id = ? LIMIT 1" );
        $select_vendor->execute([$vendor_id]);
        $fetch_vendor = $select_vendor->fetch(PDO::FETCH_ASSOC);

        $prev_pass = $fetch_vendor['password'];
        $prev_image = $fetch_vendor['image'];

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);
    
        //update name
        if(!empty($name)) {
            $update_name = $conn->prepare("UPDATE `vendors` SET name = ? WHERE id = ?");
            $update_name->execute([$name, $vendor_id]);
            $success_msg[] = 'Username updated successfully';
        }

        //update email
        if(!empty($email)) {
            $select_email = $conn->prepare("SELECT * FROM `vendors` WHERE id = ? AND email = ?");
            $select_email->execute([$vendor_id, $email]);

            if ($select_email->rowCount() > 0) {
                $warning_msg[] = 'Email already exist';
            } else {
                $update_email = $conn->prepare("UPDATE `vendors` SET email = ? WHERE id = ?");
                $update_email->execute([$email, $vendor_id]);
                $success_msg[] = 'Email updated successfully';
            }
        }

        //update image
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_SPECIAL_CHARS);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_files/'.$rename;

        if (!empty($image)) {
            if ($image_size > 2000000) {
                $warning_msg[] = 'Image size is too large';
            }else {
                $update_image = $conn->prepare("UPDATE `vendors` SET image = ? WHERE id = ?");
                $update_image->execute([$rename, $vendor_id]);
                move_uploaded_file($image_tmp_name, $image_folder);

                if ($prev_image != '' AND $prev_image != $rename) {
                    unlink('../uploaded_files/'.$prev_image);
                }
                $success_msg[] = 'Image updated successfully';
            }
        }

        //update password
        $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';

        $old_pass = sha1($_POST['old_pass']);
        $old_pass = filter_var($old_pass, FILTER_SANITIZE_SPECIAL_CHARS);

        $new_pass = sha1($_POST['new_pass']);
        $new_pass = filter_var($new_pass, FILTER_SANITIZE_SPECIAL_CHARS);

        $cpass = sha1($_POST['cpass']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_SPECIAL_CHARS);

        if ($old_pass != $empty_pass) {
            if ($old_pass != $prev_pass) {
                $warning_msg[] = 'Old password does not match';
            } elseif ($new_pass != $cpass) {
                    $warning_msg[] = 'Confirm password does not match';
            } else {
                if($new_pass != $empty_pass) {
                    $update_pass = $conn->prepare("UPDATE `vendors` SET password = ? WHERE id = ?");
                    $update_pass->execute([$cpass, $vendor_id]);
                    $success_msg[] = 'Password updated successfully';
                }else {
                    $warning_msg[] = 'Please enter new password';
                }
            }
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
        <section class="form-container">
            <div class="heading">
                <h1>Update profile detail</h1>
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <div class="img-box">
                    <?php if(!empty($fetch_profile['image'])): ?>
                    <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" style="width:200px; height:200px; object-fit:cover; border-radius:50%;" >
                    <?php else: ?>
                    <img src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg" style="width:200px; height:200px; object-fit:cover; border-radius:50%;" alt="">
                    <?php endif; ?>
                </div>
                <div class="flex">
                    <div class="col">
                        <div class="input-feild">
                            <p>Your name <span>*</span></p>
                            <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" class="box">
                        </div>
                        <div class="input-feild">
                            <p>Your email <span>*</span></p>
                            <input type="text" name="email" placeholder="<?= $fetch_profile['email']; ?>" class="box">
                        </div>
                        <div class="input-feild">
                            <p>Select pic <span>*</span></p>
                            <input type="file" name="image" accept="image/*" class="box">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-feild">
                            <p>Old password <span>*</span></p>
                            <input type="password" name="old_pass" placeholder="Enter your old password" class="box">
                        </div>
                        <div class="input-feild">
                            <p>New password <span>*</span></p>
                            <input type="password" name="new_pass" placeholder="Enter your new password" class="box">
                        </div>
                        <div class="input-feild">
                            <p>Confirm password <span>*</span></p>
                            <input type="password" name="cpass" placeholder="Confirm your password" class="box">
                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" value="Update profile" class="s-btn">
            </form>
        </section>
    </div>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- sweetalert cdn link -->
    <?php include '../components/alert.php'; ?>
    <script src="../js//admin_script.js"></script>
</body>
</html>

