<?php
    session_start(); // Start session before any output
    include '../jewelry-shop/public/assets/components/connect.php';

    $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;
    $success = false;
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = trim($_POST['firstName'] ?? '');
        $lastName = trim($_POST['lastName'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $message = trim($_POST['message'] ?? '');
        $name = $firstName . ' ' . $lastName;
        $subject = '';
        $msg_id = unique_id();
        if ($name && $email && $message) {
            $sql = "INSERT INTO message (id, user_id, name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$msg_id, $user_id ?? '', $name, $email, $phone, $subject, $message]);
            if ($result) {
                $success = true;
            } else {
                $error = 'Đã xảy ra lỗi khi gửi tin nhắn.';
            }
        } else {
            $error = 'Vui lòng điền đầy đủ các trường bắt buộc.';
        }
    }
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trang chủ - Jewelry Shop</title>
        <link rel="stylesheet" href="public/assets/css/user_header.css">
        <link rel="stylesheet" href="public/assets/css/styleshomepage.css">
        <link rel="stylesheet" href="public/assets/css/slider.css">
        <link rel="stylesheet" href="public/assets/css/shop.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
        <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
        <link rel="icon" href="../jewelry-shop/public/assets/images/logoicon.png" type="image/x-icon">
        <link rel="stylesheet" href="public/assets/css/contact.css">
    </head>
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    <main>
    <div class="container">
        <div class="form-section">
            <div class="passion-text">Chúng tôi rất mong nhận được chia sẻ<br>từ đam mê của bạn.</div>
            
            <form method="POST" action="">
                <div style="display: flex; gap: 20px;">
                    <div class="form-group" style="flex: 1;">
                        <label for="firstName">Tên</label>
                        <input type="text" id="firstName" name="firstName" required>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label for="lastName">Họ</label>
                        <input type="text" id="lastName" name="lastName" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Địa chỉ Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại (Tùy chọn)</label>
                    <input type="tel" id="phone" name="phone" placeholder="VD: +84852814372">
                </div>
                <div class="form-group">
                    <label for="message">Bình luận/Câu hỏi</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit">Gửi</button>
            </form>
            <?php if ($success): ?>
                <div style="color: green; margin-top: 10px;">Gửi thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.</div>
            <?php elseif ($error): ?>
                <div style="color: red; margin-top: 10px;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
        </div>
        
        <div class="info-section">
            <div class="contact-info">
                <h3 class="info-heading">ĐƯỜNG DÂY NÓNG</h3>
                <p class="info-text">(+84) 85 281 4372</p>
                
                <h3 class="info-heading">EMAIL</h3>
                <p class="info-text">sales@ptitjewellery.vn</p>
                
                <h3 class="info-heading">MẠNG XÃ HỘI</h3>
                <div class="social-icons">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <?php include '../jewelry-shop/public/assets/components/user_footer.php'; ?>
    <?php include "public/assets/components/toast_message.php"; ?>
    </main>
    <script src="../jewelry-shop/public/assets/js/slider.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('new-arrivals-slider');
        const prevBtn = document.getElementById('new-arrivals-prev');
        const nextBtn = document.getElementById('new-arrivals-next');
        const scrollAmount = 280; // px, tùy chỉnh theo min-width sản phẩm
    
        prevBtn.addEventListener('click', () => {
            slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });
        nextBtn.addEventListener('click', () => {
            slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });

        // Xử lý toast cho form thêm giỏ hàng và yêu thích trong slider
        slider.querySelectorAll('form[action*="add_to_cart.php"]').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(form);
                formData.append('add_to_cart', '1'); // thêm dòng này!
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.text())
                .then(() => {
                    showToast('cart');
                });
            });
        });
        slider.querySelectorAll('form[action*="add_to_wishlist.php"]').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(form);
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.text())
                .then(() => {
                    showToast('wishlist');
                });
            });
        });
    });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('new-arrivals-slider');
        const prevBtn = document.getElementById('new-arrivals-prev');
        const nextBtn = document.getElementById('new-arrivals-next');
        const scrollAmount = 280;

        prevBtn.addEventListener('click', () => {
            slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });
        nextBtn.addEventListener('click', () => {
            slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });

        // Kéo ngang bằng chuột hoặc cảm ứng
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 1.2; // tốc độ kéo
            slider.scrollLeft = scrollLeft - walk;
        });

        // Hỗ trợ cảm ứng trên mobile
        slider.addEventListener('touchstart', (e) => {
            isDown = true;
            startX = e.touches[0].pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('touchend', () => {
            isDown = false;
        });
        slider.addEventListener('touchmove', (e) => {
            if (!isDown) return;
            const x = e.touches[0].pageX - slider.offsetLeft;
            const walk = (x - startX) * 1.2;
            slider.scrollLeft = scrollLeft - walk;
        });
    });
    </script>
</body>
</html>
