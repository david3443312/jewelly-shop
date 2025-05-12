<?php
include '../components/connect.php';

if (isset($_COOKIE['vendor_id'])) {
    $vendor_id = $_COOKIE['vendor_id'];
} else {
    $vendor_id = '';
    header('location: login.php');
}

if(isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_user->execute([$user_id]);
    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
} else {
    header('location: user_accounts.php');
}

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/'.$image;

    if(!empty($image)) {
        if($image_size > 2000000) {
            $message[] = 'Image size is too large!';
        } else {
            $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $user_id]);
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    }

    $update_user = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
    $update_user->execute([$name, $email, $user_id]);
    $message[] = 'User updated successfully!';
    header('location: user_accounts.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User - Jewelry Shop</title>
    <link rel="stylesheet" href="../css/stylessignup.css">
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/styleshomepage.css">
    <link rel="stylesheet" href="../css/update_user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="icon" href="../images/logoicon.png" type="image/x-icon">
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'?>
    </div>

    <section class="form-container">
        <form action="" method="POST" enctype="multipart/form-data">
            <h3>Update User Profile</h3>
            <div class="inputBox">
                <label for="name">User Name</label>
                <input type="text" name="name" id="name" required placeholder="Enter user name" maxlength="50" value="<?= $fetch_user['name']; ?>">
            </div>
            <div class="inputBox">
                <label for="email">User Email</label>
                <input type="email" name="email" id="email" required placeholder="Enter user email" maxlength="50" value="<?= $fetch_user['email']; ?>">
            </div>
            <div class="inputBox">
                <label for="image">Profile Image</label>
                <input type="file" name="image" id="image" accept="image/*">
                <?php if(!empty($fetch_user['image'])): ?>
                    <img src="../uploaded_files/<?= $fetch_user['image']; ?>" alt="Current profile image">
                <?php endif; ?>
            </div>
            <input type="submit" name="submit" value="Update User" class="btn">
            <a href="user_accounts.php" class="btn">Go Back</a>
        </form>
    </section>

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- sweetalert cdn link -->
    <?php include '../components/alert.php'; ?>
    <script src="../js/admin_script.js"></script>
</body>
</html> 