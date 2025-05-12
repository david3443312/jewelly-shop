<?php
include '../components/connect.php';

if (isset($_COOKIE['vendor_id'])) {
    $vendor_id = $_COOKIE['vendor_id'];
} else {
    $vendor_id = '';
    header('location: login.php');
}

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/'.$image;

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user->execute([$email]);

    if($select_user->rowCount() > 0) {
        $message[] = 'Email already exists!';
    } else {
        if($pass != $cpass) {
            $message[] = 'Password not matched!';
        } else {
            if($image_size > 2000000) {
                $message[] = 'Image size is too large!';
            } else {
                $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password, image) VALUES(?,?,?,?)");
                $insert_user->execute([$name, $email, $pass, $image]);
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'New user added successfully!';
                header('location: user_accounts.php');
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
    <title>Add User - Jewelry Shop</title>
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

    <section class="form-container" style="margin-left: 50rem;">
        <form action="" method="POST" enctype="multipart/form-data">
            <h3>Add New User</h3>
            <div class="inputBox">
                <label for="name">User Name</label>
                <input type="text" name="name" id="name" required placeholder="Enter user name" maxlength="50">
            </div>
            <div class="inputBox">
                <label for="email">User Email</label>
                <input type="email" name="email" id="email" required placeholder="Enter user email" maxlength="50">
            </div>
            <div class="inputBox">
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" required placeholder="Enter password" maxlength="50">
            </div>
            <div class="inputBox">
                <label for="cpass">Confirm Password</label>
                <input type="password" name="cpass" id="cpass" required placeholder="Confirm password" maxlength="50">
            </div>
            <div class="inputBox">
                <label for="image">Profile Image</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            </div>
            <input type="submit" name="submit" style="margin: 0 auto;" value="Add User" class="btn">
            <a href="user_accounts.php" style="margin: 0 auto;" class="btn">Go Back</a>
        </form>
    </section>

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- sweetalert cdn link -->
    <?php include '../components/alert.php'; ?>
    <script src="../js/admin_script.js"></script>
</body>
</html> 