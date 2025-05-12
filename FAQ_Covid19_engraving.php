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
                <h1>Câu Hỏi về Khắc Chữ</h1>
            </div>
        </div>
    
    <div class="container">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="FAQ_Covid19.php">Cập Nhật Covid-19</a></li>
                <li><a href="FAQ_Covid19_shopping.php">Câu Hỏi về Mua Sắm</a></li>
                <li><a href="FAQ_Covid19_product.php">Câu Hỏi về Sửa Chữa Sản Phẩm</a></li>
                <li><a href="FAQ_Covid19_shipping.php">Câu Hỏi về Vận Chuyển & Đổi Trả</a></li>
                <li><a href="FAQ_Covid19_engraving.php"  class="active">Câu Hỏi về Khắc Chữ</a></li>
            </ul>
        </div>
        
        <div class="main-content">
            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>1. Dịch vụ khắc có sẵn trên Ptitjewellery.vn không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Ptit's Jewellery rất vui mừng cung cấp dịch vụ khắc chữ, khắc tên và khắc tay, đặc biệt là dịch vụ khắc cho nhẫn cưới. Bạn có thể điền vào "Ghi chú đơn hàng" về yêu cầu khắc và chọn phương pháp khắc ưa thích của bạn. Xin lưu ý rằng chúng tôi tính phí cho dịch vụ khắc. Vì đây là yêu cầu cá nhân hóa tùy chọn, không có mức phí cố định áp dụng cho đơn hàng của bạn. Chúng tôi sẽ liên hệ với bạn qua email để xác nhận và yêu cầu thanh toán thêm cho dịch vụ khắc.</p>
                        <p>Tuy nhiên, không phải mọi sản phẩm đều có thể khắc. Các chuyên gia khắc của chúng tôi đã xác định trước kỹ thuật phù hợp nhất và chúng tôi sẽ xác nhận với bạn trước khi đặt hàng. Vui lòng liên hệ với chúng tôi qua Hotline (84) 85 281 4372 hoặc qua email: sales@Ptitjewellery.vn trước khi đặt hàng có yêu cầu khắc.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>2. Tôi có thể trả lại hoặc đổi sản phẩm đã khắc không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Rất tiếc, các sản phẩm đã khắc không thể trả lại hoặc đổi.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>3. Chi phí khắc là bao nhiêu?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Giá dịch vụ khắc phụ thuộc vào độ phức tạp của thiết kế khắc của bạn. Chúng tôi sẽ ước tính giá khi nhận được thiết kế từ bạn.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>4. Khắc mất bao lâu?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Vui lòng cho phép thêm 1-2 ngày để giao các sản phẩm khắc tiêu chuẩn và thêm 3-4 ngày để giao các sản phẩm khắc tay.</p>
                        <p>Xin lưu ý rằng các sản phẩm đã khắc không thể trả lại hoặc đổi.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>5. Dịch vụ khắc có sẵn tại cửa hàng không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Không, quy trình khắc của Ptit's Jewellery không phải là dịch vụ tại chỗ. Chúng tôi phải gửi sản phẩm đến xưởng của chúng tôi để các thợ bạc và thợ kim hoàn khắc bằng tay hoặc bằng máy laser.</p>
                        <p>Liên hệ với đội ngũ Dịch vụ Khách hàng của chúng tôi qua Hotline (84) 85 281 4372 để biết thêm thông tin.</p>
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
