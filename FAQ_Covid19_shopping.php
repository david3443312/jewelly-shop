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
                <h1>Câu hỏi mua sắm</h1>
            </div>
        </div>
    
    <div class="container">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="FAQ_Covid19.php">Cập Nhật Covid-19</a></li>
                <li><a href="FAQ_Covid19_shopping.php" class="active">Câu Hỏi về Mua Sắm</a></li>
                <li><a href="FAQ_Covid19_product.php">Câu Hỏi về Sửa Chữa Sản Phẩm</a></li>
                <li><a href="FAQ_Covid19_shipping.php">Câu Hỏi về Vận Chuyển & Đổi Trả</a></li>
                <li><a href="FAQ_Covid19_engraving.php">Câu Hỏi về Khắc Chữ</a></li>
            </ul>
        </div>
        
        <div class="main-content">
            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>1. Làm thế nào để đặt hàng trên Ptitjewellery.vn?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Đặt hàng trên Ptitjewellery.vn rất nhanh chóng và tiện lợi. Khi bạn đã tìm thấy sản phẩm muốn mua, hãy nhấp vào nút "Thêm vào giỏ hàng" để đặt vào Giỏ hàng của bạn. Làm theo hướng dẫn trong quá trình thanh toán để hoàn tất đơn hàng của bạn.</p>
                        <p>Đơn hàng của bạn sẽ không được đặt cho đến khi kết thúc quá trình thanh toán khi bạn được yêu cầu cung cấp thông tin thẻ tín dụng hoặc tài khoản PayPal.</p>
                        <p>Bạn cũng có thể đặt hàng qua điện thoại bằng cách gọi Hotline (+84) 85 281 4372.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>2. Tôi có thể thêm lời nhắn quà tặng cá nhân với đơn hàng của mình không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Có, bạn sẽ có cơ hội tạo lời nhắn cá nhân khi thanh toán. Lời nhắn sẽ được viết trên một tấm thiệp trắng có logo Ptit's Jewellery. Chúng tôi sẽ làm theo hướng dẫn của bạn để quyết định việc có đặt tên người mua trong gói hàng hay không. Vì lý do này, chúng tôi khuyên bạn nên nhập tên của bạn vào lời nhắn quà tặng và đưa ra hướng dẫn chi tiết cho chúng tôi trong phần "Ghi chú đơn hàng".</p>
                        <p>Vui lòng liên hệ Dịch vụ Khách hàng qua Hotline (+84) 85 281 4372 nếu bạn có bất kỳ câu hỏi nào về việc thay đổi lời nhắn cá nhân.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>3. Ptitjewellery.vn chấp nhận những phương thức thanh toán nào?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Ptit's Jewellery chấp nhận tất cả các loại thẻ tín dụng chính, chuyển khoản trực tiếp và PayPal. Để biết thông tin về các phương thức thanh toán khác, vui lòng liên hệ Dịch vụ Khách hàng qua Hotline (+84) 85 281 4372, hoặc gửi email cho chúng tôi tại sales@Ptitjewellery.vn</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>4. Đặt hàng trên Ptitjewellery.vn có an toàn không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Có, việc đặt hàng trên Ptitjewellery.vn rất an toàn. Chúng tôi mã hóa thông tin đơn hàng để bảo vệ bạn bằng cách sử dụng mã hóa SSL tiêu chuẩn ngành. SSL mã hóa thông tin tài khoản cá nhân của bạn và bảo mật thông tin mua hàng và thẻ tín dụng của bạn.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>5. Làm thế nào để biết một sản phẩm bán trực tuyến có sẵn tại cửa hàng địa phương của tôi không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Vui lòng liên hệ Dịch vụ Khách hàng qua Hotline (84) 85 281 4372 để kiểm tra tình trạng sẵn có của sản phẩm. Lưu ý rằng tình trạng sẵn có của sản phẩm có thể thay đổi.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>6. Có thể nhận hàng tại cửa hàng cho các sản phẩm mua trực tuyến trên Ptitjewellery.vn không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Vui lòng liên hệ với chúng tôi qua Email: sales@Ptitjewellery.vn hoặc Hotline (84) 85 281 4372 để kiểm tra showroom nào có sản phẩm bạn đã đặt hàng.</p>
                        <p>Nhận hàng tại cửa hàng cho các sản phẩm đặt trực tuyến có sẵn tại các showroom của chúng tôi:</p>
                        <p>- Ptit's Jewellery - 123 Nguyễn Thị Minh Khai, P. Bến Nghé, Q.1, TP.HCM</p>
                        <p>- Ptit's Jewellery - 123 Nguyễn Thị Minh Khai, P. Bến Nghé, Q.1, TP.HCM</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>7. Giá trên Ptitjewellery.vn có thể thay đổi không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Giá trên Ptitjewellery.vn có thể thay đổi mà không cần thông báo trước. Vui lòng chấp nhận thanh toán theo giá niêm yết của sản phẩm vào ngày mua hàng.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>8. Ptit's Jewellery có dịch vụ điều chỉnh kích thước không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Ptit's Jewellery cung cấp dịch vụ điều chỉnh kích thước cho một số sản phẩm được chọn. Vui lòng liên hệ Dịch vụ Khách hàng qua Hotline (+84) 85 281 4372 để biết thêm chi tiết.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>9. Ptit's Jewellery có bảng quy đổi kích thước nhẫn không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Có. Ptit's Jewellery có bảng quy đổi kích thước nhẫn trực tuyến để giúp bạn xác định kích thước nhẫn của mình. Vui lòng nhấp vào đây để xem bảng quy đổi.</p>
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
