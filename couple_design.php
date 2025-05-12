<?php
// Bắt đầu session nếu chưa được bắt đầu
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra đăng nhập
$user_id = null;
if (isset($_COOKIE['user_id']) && !empty($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} elseif (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

// Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
if (!$user_id) {
    header('Location: login.php');
    exit();
}

// Xử lý form khi submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once 'public/assets/components/connect.php';
    
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $design_type = $_POST['design_type'] ?? '';
    $description = $_POST['description'] ?? '';
    $budget = $_POST['budget'] ?? '';
    $deadline = $_POST['deadline'] ?? '';
    
    try {
        // Tạo ID ngẫu nhiên cho couple design
        $id = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 20);
        
        $stmt = $conn->prepare("INSERT INTO couple_designs (id, user_id, name, email, phone, design_type, description, budget, deadline, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
        $stmt->execute([$id, $user_id, $name, $email, $phone, $design_type, $description, $budget, $deadline]);
        
        $success_message = "Yêu cầu thiết kế trang sức đôi của bạn đã được gửi thành công! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.";
    } catch(PDOException $e) {
        $error_message = "Có lỗi xảy ra, vui lòng thử lại sau.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Trang Sức Đôi - Jewelry Shop</title>
    <link rel="stylesheet" href="public/assets/css/user_header.css">
    <link rel="stylesheet" href="public/assets/css/styleshomepage.css">
    <link rel="stylesheet" href="public/assets/css/FAQ_child.css">
    <link rel="stylesheet" href="public/assets/css/group_design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'public/assets/components/user_header.php'; ?>

    <div class="container">
        <div class="custom-design-form">
            <h1>Đặt Trang Sức Đôi</h1>
            
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            
            <?php if (isset($error_message)): ?>
                <div class="alert alert-error"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Họ và tên *</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Số điện thoại *</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="design_type">Loại trang sức đôi *</label>
                    <select id="design_type" name="design_type" required>
                        <option value="">Chọn loại trang sức</option>
                        <option value="couple_ring">Nhẫn đôi</option>
                        <option value="couple_bracelet">Vòng tay đôi</option>
                        <option value="couple_necklace">Vòng cổ đôi</option>
                        <option value="couple_earring">Khuyên tai đôi</option>
                        <option value="other">Khác</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Mô tả chi tiết yêu cầu *</label>
                    <textarea id="description" name="description" rows="5" required 
                        placeholder="Vui lòng mô tả chi tiết về thiết kế bạn mong muốn, bao gồm: kiểu dáng, chất liệu, kích thước, màu sắc, và các yêu cầu đặc biệt khác..."></textarea>
                </div>

                <div class="form-group">
                    <label for="budget">Ngân sách dự kiến</label>
                    <input type="number" id="budget" name="budget" placeholder="VND">
                </div>

                <div class="form-group">
                    <label for="deadline">Thời gian cần hoàn thành</label>
                    <input type="date" id="deadline" name="deadline">
                </div>

                <div class="form-group">
                    <label for="reference_images">Hình ảnh tham khảo (nếu có)</label>
                    <input type="file" id="reference_images" name="reference_images[]" multiple accept="image/*">
                </div>

                <button type="submit" class="submit-btn">Gửi yêu cầu thiết kế</button>
            </form>
        </div>
    </div>
    </style>
</body>
</html> 