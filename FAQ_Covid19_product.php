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
                <h1>Câu hỏi về Sửa chữa Sản phẩm</h1>
            </div>
        </div>
    
    <div class="container">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="FAQ_Covid19.php"">Cập Nhật Covid-19</a></li>
                <li><a href="FAQ_Covid19_shopping.php">Câu Hỏi về Mua Sắm</a></li>
                <li><a href="FAQ_Covid19_product.php"  class="active">Câu Hỏi về Sửa Chữa Sản Phẩm</a></li>
                <li><a href="FAQ_Covid19_shipping.php">Câu Hỏi về Vận Chuyển & Đổi Trả</a></li>
                <li><a href="FAQ_Covid19_engraving.php">Câu Hỏi về Khắc Chữ</a></li>
            </ul>
        </div>
        
        <div class="main-content">
            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>1. Làm thế nào để sửa chữa một sản phẩm?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Chúng tôi sửa chữa tất cả các sản phẩm được làm bởi Ptit's Jewellery. Đối với trang sức của khách hàng, chúng tôi cần đánh giá để quyết định có thể chấp nhận hoặc từ chối sửa chữa hay không.</p>
                        <p>Bạn có thể mang sản phẩm đến showroom gần nhất. Nhân viên của chúng tôi sẽ thảo luận với bạn về tình trạng hiện tại và ước tính các giải pháp.</p>
                        <p>Nếu bạn có yêu cầu đặc biệt về dịch vụ sửa chữa, vui lòng liên hệ với chúng tôi qua Hotline (84) 85 281 4372.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>2. Làm thế nào để kiểm tra tình trạng sửa chữa của tôi?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Để kiểm tra tình trạng sửa chữa, vui lòng liên hệ Dịch vụ Khách hàng qua Hotline (84) 85 281 4372. Nhân viên tư vấn có mặt từ 8:30 sáng đến 8:30 tối GMT từ thứ Hai đến Chủ nhật.</p>
                        <p>Nếu bạn để lại tin nhắn ngoài giờ làm việc, nhân viên sẽ liên hệ với bạn vào ngày hôm sau.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>3. Chi phí sửa chữa trang sức là bao nhiêu?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Chi phí sửa chữa sản phẩm khác nhau và được xác định sau khi đánh giá. Giá sửa chữa thay đổi dựa trên loại sản phẩm, chất liệu và đá quý. Khi hoàn thành đánh giá, chúng tôi sẽ gửi cho bạn báo giá. Nếu bạn đồng ý với các giải pháp và giá cả, chúng tôi sẽ xử lý đơn sửa chữa của bạn.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>4. Ptit's Jewellery cung cấp những dịch vụ làm sạch và chăm sóc nào?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Ptit's Jewellery cung cấp nhiều dịch vụ chăm sóc và tài nguyên để giúp bạn chăm sóc trang sức của mình.</p>
                        <p>Dịch vụ Làm sạch & Chăm sóc bao gồm:</p>
                        <p>- Làm sạch chuyên nghiệp tại showroom bởi nhân viên chuyên môn</p>
                        <p>- Điều chỉnh kích thước</p>
                        <p>- Làm mới dây chuyền</p>
                        <p>- Tư vấn nhẫn đính hôn</p>
                        <p>- Khắc</p>
                        <p>- Đánh bóng và làm sạch siêu âm trang sức bởi thợ bạc chuyên nghiệp</p>
                        <p>- Thay thế khóa và móc</p>
                        <p>- Rút ngắn vòng tay</p>
                        <p>- Kiểm tra trang sức</p>
                        <p>- Sửa chữa</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>5. Tôi nên làm sạch trang sức bao lâu một lần?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Chúng tôi khuyến nghị khách hàng mang trang sức đến ít nhất 6 tháng một lần. Các sản phẩm được đeo hàng ngày và thường xuyên nên được làm sạch và kiểm tra mỗi 3 tháng.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>6. Tôi nên đánh bóng bạc bao lâu một lần?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Đánh bóng bạc là quá trình loại bỏ vết xỉn và làm sáng trang sức bạc. Vì một số bạc bị mất trong quá trình đánh bóng, trang sức bạc chỉ nên được đánh bóng vài lần trong suốt vòng đời của nó.</p>
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
