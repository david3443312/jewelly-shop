<?php 
    include '../components/connect.php';

    if (isset($_POST['submit'])) {

        $id = unique_id();
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);

        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_SPECIAL_CHARS);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        $phone = $_POST['phone'];
        $phone = filter_var($phone, FILTER_SANITIZE_SPECIAL_CHARS);

        $cpass = sha1($_POST['cpass']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_SPECIAL_CHARS);

        $select = $conn->prepare("SELECT * FROM `vendors` WHERE email = ?");
        $select->execute([$email]);

        if ($select->rowCount() > 0) {
            $warning_msg[] = "Email already exists";
        } else {
            if ($pass != $cpass) {
               $warning_msg[] = "Password does not match";
            } else {
                $insert_vendor = $conn->prepare("INSERT INTO `vendors`(`id`, `name`, `password`, `email`, `phone` ) VALUES (?,?,?,?,?)");
                $insert_vendor->execute([$id, $name, $cpass, $email, $phone]);
                $success_msg[] = "Registration successful";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng ký - Jewelry Shop</title>
        <link rel="stylesheet" href="../css//stylessignup.css">
        <link rel="stylesheet" href="../css//admin_style.css">
        <link rel="stylesheet" href="../css//styleshomepage.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
        <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
        <link rel="icon" href="../images/logoicon.png" type="image/x-icon">
    </head>
<body>
<main>
        <!-- <div class="breadcrumb" styles="margin-top: 2000px;">
            <a href="#"><i class="fas fa-home"></i> / Đăng ký tài khoản</a>
        </div> -->
        <div class="meetings">
            <h1>Xin chào!</h1>
            <h2>Vui lòng đăng ký tài khoản mới tại đây:</h2>
        </div>
        <form method="post" class="signup-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="username">Tên đăng nhập:</label>
                    <input type="text" required name="name" placeholder="Tên đăng nhập">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" required name="pass" placeholder="Mật khẩu">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" required name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại:</label>
                    <input type="tel" required name="phone" placeholder="Số điện thoại">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Nhập lại mật khẩu:</label>
                    <input type="password" required name="cpass" placeholder="Nhập lại mật khẩu">
                </div>
            </div>
            <div class="form-row">
                <button type="submit" name="submit" class="signup-btn">Đăng ký</button>
            </div>
        </form>
        <div class="login-link">
            <h2>Bạn đã có tài khoản:</h2>
            <a href="login.php">Đăng nhập</a>
        </div>
        <!-- <img src="images/signup/signup1.jpg" alt="Đăng ký tài khoản" class="signup-image"> -->
    </main>

    <script src = "https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

         <!-- sweetalert cdn link -->
    <?php include '../components/alert.php' ?>
    
</body>
</html>