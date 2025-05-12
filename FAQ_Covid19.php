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
        <link rel="stylesheet" href="public/assets/css/FAQ_child.css">
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
                <h1>Cập Nhật & Câu Hỏi Thường Gặp về Covid-19</h1>
            </div>
        </div>
    
    <div class="container">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="FAQ_Covid19.php" class="active">Cập Nhật Covid-19</a></li>
                <li><a href="FAQ_Covid19_shopping.php">Câu Hỏi về Mua Sắm</a></li>
                <li><a href="FAQ_Covid19_product.php">Câu Hỏi về Sửa Chữa Sản Phẩm</a></li>
                <li><a href="FAQ_Covid19_shipping.php">Câu Hỏi về Vận Chuyển & Đổi Trả</a></li>
                <li><a href="FAQ_Covid19_engraving.php">Câu Hỏi về Khắc Chữ</a></li>
            </ul>
        </div>
        
        <div class="main-content">
            <div class="intro">
                <p>Các showroom của chúng tôi đã hoạt động bình thường trở lại. Chúng tôi rất mong được chào đón quý khách.</p>
            </div>
            
            <div class="safety-measures">
                <h2>Biện Pháp An Toàn Phòng Chống Covid-19</h2>
                <p>Chúng tôi tuân thủ hướng dẫn từ các cơ quan quản lý để đảm bảo an toàn cho đội ngũ nhân viên, khách hàng và cộng đồng của Ptit's Jewellery trong đại dịch Covid-19. Ptit's Jewellery đang thực hiện nghiêm túc các biện pháp an toàn, bao gồm:</p>
                <ul>
                    <li>Tất cả nhân viên đều đeo khẩu trang</li>
                    <li>Duy trì khoảng cách an toàn giữa nhân viên và khách hàng</li>
                    <li>Showroom của Ptit's Jewellery được vệ sinh hàng ngày</li>
                    <li>Chúng tôi cung cấp khẩu trang và nước rửa tay khử khuẩn tại các showroom</li>
                </ul>
            </div>
            
            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>1. Tôi Có Thể Nhận Hàng Tại Cửa Hàng Sau Bao Lâu?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Ptit's Jewellery đang cung cấp dịch vụ nhận hàng tại cửa hàng. Khách hàng địa phương có thể đặt hàng qua điện thoại. Đội ngũ cửa hàng của chúng tôi sẽ xác nhận tình trạng sản phẩm, xử lý thanh toán và thông báo khi hàng đã sẵn sàng để nhận.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>2. Ptit's Jewellery Có Kiểm Tra Sức Khỏe Hàng Ngày Cho Nhân Viên Không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Có, tất cả nhân viên của chúng tôi đều được kiểm tra sức khỏe hàng ngày trước khi bắt đầu ca làm việc. Điều này bao gồm kiểm tra nhiệt độ và bảng câu hỏi sức khỏe để đảm bảo mọi người trong cửa hàng đều khỏe mạnh và an toàn để phục vụ quý khách.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>3. Covid-19 Đã Ảnh Hưởng Đến Dịch Vụ Chăm Sóc Và Sửa Chữa Như Thế Nào?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Dịch vụ chăm sóc và sửa chữa của chúng tôi hiện đang hoạt động bình thường với các quy trình an toàn được tăng cường. Tất cả các sản phẩm được nhận để sửa chữa đều được khử trùng kỹ lưỡng trước và sau khi phục vụ. Xin lưu ý rằng do các biện pháp an toàn của chúng tôi, thời gian sửa chữa có thể lâu hơn bình thường một chút.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>4. Ptit's Jewellery Đảm Bảo An Toàn Cho Các Sản Phẩm Được Khách Hàng Chạm Vào, Thử Hoặc Trả Lại Như Thế Nào?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Tất cả các sản phẩm được thử trong cửa hàng đều được làm sạch và khử trùng kỹ lưỡng sau mỗi lần sử dụng. Đối với các sản phẩm bị trả lại, chúng tôi thực hiện thời gian cách ly 48 giờ, sau đó làm sạch và khử trùng chi tiết trước khi đưa trở lại trưng bày hoặc kho.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="public/assets/js/faq.js"></script>
        <br>
    </main>
    <?php include '../jewelry-shop/public/assets/components/user_footer.php'; ?>
    <script src = "../jewelry-shop//public/assets/js/slider.js"></script>
</body>
</html>
