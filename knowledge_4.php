<?php
    include '../jewelry-shop/public/assets/components/connect.php';

    $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;

?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trang chủ - Jewelry Shop</title>
        <link rel="stylesheet" href="public/assets/css/user_header.css">
        <link rel="stylesheet" href="public/assets/css/styleshomepage.css">
        <link rel="stylesheet" href="public/assets/css/knowledge_1.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
        <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
        <link rel="icon" href="../jewelry-shop/public/assets/images/logoicon.png" type="image/x-icon">
    </head>
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    <main>
    <div class="header">
        <div class="container">
            <div class="category">KIẾN THỨC</div>
            <h1>Ngọc Trai – Thuần Khiết, Hào Phóng & Chính Trực</h1>
        </div>
    </div>
    
    <div class="container">
        <div class="content-section">
            <div class="text-content">
                <p>Được biết đến như loại đá quý duy nhất đến từ sinh vật sống, Ngọc Trai đại diện cho sự hoàn hảo "không hoàn hảo". Ngọc trai tượng trưng cho sự thuần khiết, hào phóng và chính trực. Người xưa cũng tin rằng Ngọc Trai có tác dụng làm dịu để cân bằng người đeo. Hơn nữa, bạn sẽ không bao giờ tìm thấy hai viên ngọc trai giống hệt nhau. Mỗi viên ngọc trai có hình dạng, kích thước và độ bóng khác nhau. Do đó, sự độc đáo giữa các viên Ngọc Trai tạo nên sự đa dạng khiến chúng có giá trị theo cách riêng. Đó là lý do tại sao chúng ta nói viên ngọc trai "không hoàn hảo" làm cho nó trở thành vẻ đẹp "hoàn hảo".</p>
            </div>
        </div>
        <br>
        <div class="image-content">
            <img src="../jewelry-shop/public/assets/images/knowledge/4_1.jpg" alt="Trang sức ngọc trai nước ngọt trên nền tối">
        </div>
        <br>
        <div class="content-section">
            <div class="text-content">
                <p>Giống như Ngọc Trai, chúng ta là con người được sinh ra để là một phần của sự đa dạng. Chúng ta không tìm kiếm sự so sánh với người khác vì bất kỳ sự so sánh nào cũng vô nghĩa. Chúng ta là những cá thể độc đáo mang những tính cách khác nhau. Những khiếm khuyết mà chúng ta có đều là một phần của sự độc đáo của chúng ta.</p>
            </div>
        </div>
        <br>
        <div class="image-content">
            <img src="../jewelry-shop/public/assets/images/knowledge/4_2.jpg" alt="Trang sức ngọc trai nước ngọt trên nền tối">
            <img src="../jewelry-shop/public/assets/images/knowledge/4_3.jpg" alt="Trang sức ngọc trai nước ngọt trên nền tối">
        </div>
        <br>
        <div class="content-section">
            <div class="text-content">
                <p>Một món trang sức có thể nói lên tiếng nói riêng của nó. Thực sự, mỗi người chúng ta sẽ chọn phong cách trang sức khác nhau để thể hiện con người của mình. Ngọc Trai đại diện cho cá tính mà chúng ta có thể tìm thấy giữa con người. Nếu bạn có một viên ngọc trai trong tay, bạn có muốn biến nó thành món trang sức thể hiện cá tính riêng của mình không?</p>
            </div>
        </div>
        <br>
        <div class="image-content">
            <img src="../jewelry-shop/public/assets/images/knowledge/4_4.jpg" alt="Trang sức ngọc trai nước ngọt trên nền tối">
        </div>
        <br>
        
    </div>
    <?php include '../jewelry-shop/public/assets/components/user_footer.php'; ?>
    </main>
    <script src = "../jewelry-shop//public/assets/js/slider.js"></script>
</body>
</html>
