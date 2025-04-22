<?php
    include '../components/connect.php';
    if (isset($_POST['register'])) {

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        $pass = sha1($_POST['password']);
        $pass = filter_var($pass, FILTER_SANITIZE_SPECIAL_CHARS);

        $select_vendor = $conn->prepare("SELECT * FROM `vendors` WHERE email = ? AND password = ?");
        $select_vendor->execute([$email, $pass]);
        $row = $select_vendor->fetch(PDO::FETCH_ASSOC);

        if ($select_vendor->rowCount() > 0) {
        setcookie('vendor_id', $row['id'], time() + 86400, '/');
        header('location: dashboard.php');
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
                <button type="submit" name="register" class="signup-btn1">Đăng nhập</button>
            </div>
        </form>
        <div class="fd-ps">
            <a class="privacy-link" href="#">Quên mật khẩu?</a>
        </div>
        <div class="signup-link">
            <h2>Bạn chưa có tài khoản:</h2>
            <a href="register.php">Đăng ký</a>
        </div> 
        
        <!-- <img src="images/signup/signup1.jpg" alt="Đăng ký tài khoản" class="signup-image"> -->
    </main>
    
</body>
</html>