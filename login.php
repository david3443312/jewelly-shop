<?php
    include '../jewelry-shop/public/assets/components/connect.php';

    $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;

    if (isset($_POST['submit'])) {

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        $pass = sha1($_POST['password']);
        $pass = filter_var($pass, FILTER_SANITIZE_SPECIAL_CHARS);

        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
        $select_user->execute([$email, $pass]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if ($select_user->rowCount() > 0) {
            setcookie('user_id', $row['id'], time() + 86400, '/');
            header('location: home.php');
            exit; // Thêm exit để đảm bảo không có mã nào chạy sau khi chuyển hướng
        } else {
            $warning_msg[] = "Incorrect email or password";
        }
    }

?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng nhập - Jewelry Shop</title>
        <link rel="stylesheet" href="public/assets/css/user_header.css">
        <link rel="stylesheet" href="public/assets/css/stylessignup.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
        <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
        <link rel="icon" href="../jewelry-shop//public//assets/images/logoicon.png" type="image/x-icon">
    </head>
<body>
    <?php include '../jewelry-shop//public//assets//components//user_header.php'; ?>
    <main>
        <div class="meetings">
            <h1>Chào mừng trở lại:</h1>
            <h2>Vui lòng đăng nhập tài khoản của bạn ở đây:</h2>
        </div>
        
        <form class="signup-form" method="POST">
            <div class="form-row">
                
                <div class="form-group">
                    <label for="username">Email:</label>
                    <input type="email" required name="email" placeholder="Email">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" required name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-row">
                <button type="submit" name="submit" class="signup-btn1">Đăng nhập</button>
            </div>
        </form>
        <div class="fd-ps" style="text-align: right; margin-right: 950px;">
            <a class="privacy-link" href="#">Quên mật khẩu?</a>
        </div>
        <div class="signup-link">
            <h2>Bạn chưa có tài khoản:</h2>
            <a href="signup.php">Đăng ký</a>
        </div>
        
    </main>
    <img src="../jewelry-shop//public//assets/images/signup/signup1.jpg" alt="Đăng ký tài khoản" class="signup-image">
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- sweetalert cdn link -->
    <?php include '../jewelry-shop//public//assets/components/alert.php' ?>
</body>
</html>