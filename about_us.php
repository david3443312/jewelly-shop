<?php
// Trang Giới thiệu về Jewelry PTITshop
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về chúng tôi - Jewelry PTITshop</title>
    <link rel="stylesheet" href="public/assets/css/user_header.css">
    <link rel="stylesheet" href="public/assets/css/styleshomepage.css">
    <link rel="stylesheet" href="public/assets/css/shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="public/assets/images/logoicon.png" type="image/x-icon">
    <style>
        .about-container {
            max-width: 1100px;
            margin: 120px auto 40px auto;
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.06);
            padding: 40px 30px;
        }
        .about-title {
            text-align: center;
            font-size: 40px;
            color: #3A5F41;
            margin-bottom: 30px;
            font-family: 'Cormorant Upright', serif;
        }
        .about-section {
            margin-bottom: 36px;
        }
        .about-section h2 {
            color: #7D6E5D;
            font-size: 28px;
            margin-bottom: 10px;
        }
        .about-section p, .about-section li {
            font-size: 20px;
            color: #444;
            margin-bottom: 8px;
        }
        .showroom-list {
            list-style: none;
            padding: 0;
        }
        .showroom-list li {
            margin-bottom: 18px;
            background: #f9f9f4;
            border-radius: 12px;
            padding: 18px 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .showroom-list .showroom-title {
            font-weight: bold;
            color: #3A5F41;
            font-size: 22px;
        }
        .showroom-list .showroom-address {
            margin: 6px 0 8px 0;
            color: #555;
        }
        .showroom-list .showroom-btn {
            display: inline-block;
            background: #7D6E5D;
            color: #fff;
            border-radius: 8px;
            padding: 8px 18px;
            text-decoration: none;
            font-size: 17px;
            margin-top: 6px;
            transition: background 0.2s;
        }
        .showroom-list .showroom-btn:hover {
            background: #3A5F41;
        }
        .about-contact p {
            font-size: 20px;
            margin-bottom: 8px;
        }
        @media (max-width: 700px) {
            .about-container { padding: 18px 4vw; }
            .about-title { font-size: 30px; }
            .about-section h2 { font-size: 22px; }
            .showroom-list .showroom-title { font-size: 18px; }
        }
    </style>
</head>
<body>
<?php include "public/assets/components/user_header.php"; ?>
<div class="about-container">
    <div class="about-title">Về Jewelry PTITshop</div>
    <div class="about-section">
        <h2>Giới thiệu</h2>
        <p>Jewelry PTITshop là thương hiệu trang sức ngọc trai bạc tinh xảo, đá quý & sản phẩm bạc cao cấp tại Hà Nội, Việt Nam. Chúng tôi tự hào mang đến cho khách hàng những sản phẩm chất lượng, thiết kế tinh tế và dịch vụ tận tâm.</p>
    </div>
    <div class="about-section">
        <h2>Thông tin liên hệ</h2>
        <div class="about-contact">
            <p><i class="fas fa-phone"></i> Điện thoại: <b>(+84) 85 281 4372</b></p>
            <p><i class="fas fa-envelope"></i> Email: <b>sales@ptitshop.vn</b></p>
            <p><i class="fas fa-globe"></i> Website: <b>www.jewelry-ptitshop.vn</b></p>
        </div>
    </div>
    <div class="about-section">
        <h2>Hệ thống Showroom</h2>
        <ul class="showroom-list">
            <li>
                <div class="showroom-title">Showroom I</div>
                <div class="showroom-address">96A Mộ Lao, Hà Đông, Hà Nội, Việt Nam</div>
                <div><a class="showroom-btn" href="https://maps.app.goo.gl/YwWYcss6AZAs2LkX8" target="_blank"><i class="fas fa-map-marker-alt"></i> Chỉ đường</a></div>
            </li>
            <li>
                <div class="showroom-title">Showroom II</div>
                <div class="showroom-address">Số 310/3, Ngọc Đại, Xã Đại Mỗ, Huyện Từ Liêm, Đai Mễ, Nam Từ Liêm, Hà Nội, Vietnam</div>
                <div><a class="showroom-btn" href="https://maps.app.goo.gl/SF9AaFjEf7627kGV8" target="_blank"><i class="fas fa-map-marker-alt"></i> Chỉ đường</a></div>
            </li>
            <li>
                <div class="showroom-title">Showroom III</div>
                <div class="showroom-address">122 Hoàng Quốc Việt, Cổ Nhuế, Cầu Giấy, Hà Nội, Vietnam</div>
                <div><a class="showroom-btn" href="https://maps.app.goo.gl/XwSBx7DxzoH6Hb44A" target="_blank"><i class="fas fa-map-marker-alt"></i> Chỉ đường</a></div>
            </li>
            <li>
                <div class="showroom-title">Showroom IV</div>
                <div class="showroom-address">Đường Hồ Hoà Lạc, Hoa Lac Hi-tech Park, Tân Xã, Thạch Thất, Hà Nội, Vietnam</div>
                <div><a class="showroom-btn" href="https://maps.app.goo.gl/L18Yu8h9kNhs3fQV9" target="_blank"><i class="fas fa-map-marker-alt"></i> Chỉ đường</a></div>
            </li>
        </ul>
    </div>
    <div class="about-section">
        <h2>Kết nối với chúng tôi</h2>
        <div class="about-contact">
            <p><i class="fab fa-facebook-f"></i> <a href="https://fb.com/HocVienPTIT" target="_blank">fb.com/HocVienPTIT</a></p>
            <p><i class="fab fa-instagram"></i> <a href="https://instagram/HocVienPTIT" target="_blank">instagram/HocVienPTIT</a></p>
            <p><i class="fab fa-pinterest"></i> <a href="https://pinterest.com/HocVienPTIT" target="_blank">pinterest.com/HocVienPTIT</a></p>
        </div>
    </div>
</div>
<?php include "public/assets/components/user_footer.php"; ?>
</body>
</html>
