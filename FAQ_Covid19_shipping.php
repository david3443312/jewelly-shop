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
                <h1>Câu hỏi về Vận chuyển & Đổi trả</h1>
            </div>
        </div>
    
    <div class="container">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="FAQ_Covid19.php">Cập Nhật Covid-19</a></li>
                <li><a href="FAQ_Covid19_shopping.php">Câu Hỏi về Mua Sắm</a></li>
                <li><a href="FAQ_Covid19_product.php">Câu Hỏi về Sửa Chữa Sản Phẩm</a></li>
                <li><a href="FAQ_Covid19_shipping.php"  class="active">Câu Hỏi về Vận Chuyển & Đổi Trả</a></li>
                <li><a href="FAQ_Covid19_engraving.php">Câu Hỏi về Khắc Chữ</a></li>
            </ul>
        </div>
        
        <div class="main-content">
            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>1. Ptitjewellery.vn có những phương thức vận chuyển nào?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Ptit's Jewellery cung cấp dịch vụ vận chuyển trong nước và quốc tế cho tất cả đơn hàng (đơn hàng trực tuyến và đơn hàng tại cửa hàng).</p>
                        <h2>Vận chuyển trong nước</h2>
                        <p>Lựa chọn 1: Nhận hàng tại Showroom của chúng tôi</p>
                        <p>- Showroom 1: 62 Hàng Ngang, Quận Hoàn Kiếm, Hà Nội, Việt Nam</p>
                        <p>- Showroom 1: 62 Hàng Ngang, Quận Hoàn Kiếm, Hà Nội, Việt Nam</p>
                        <p>Lựa chọn 2: Chúng tôi sử dụng dịch vụ EMS - VNPost để gửi hàng đến địa chỉ của bạn.</p>
                        <h2>Vận chuyển quốc tế</h2>
                        <p>Chúng tôi sử dụng dịch vụ vận chuyển quốc tế UPS cho tất cả đơn hàng quốc tế. Để đảm bảo việc giao hàng an toàn, Ptit's Jewellery không gửi hàng đến hộp thư bưu điện. Ptit's Jewellery có thể chấp nhận địa chỉ hộp thư bưu điện cho nhu cầu thanh toán của bạn.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>2. Tôi có thể theo dõi đơn hàng trực tuyến của mình không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Thông báo vận chuyển với chi tiết theo dõi sẽ được gửi qua email sau khi đơn hàng của bạn đã được gửi đi. Bạn có thể nhận được nhiều email xác nhận nếu bạn đặt nhiều đơn hàng vào các thời điểm khác nhau, dẫn đến nhiều lần gửi hàng.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>3. Đơn hàng trực tuyến của tôi có được gói quà không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Tất cả các sản phẩm từ Ptit's Jewellery đều được đóng trong hộp nâu đặc trưng của Ptit's Jewellery, được phủ bởi nắp màu kem với logo Ptit's Jewellery trên ruy-băng nâu. Trong quá trình thanh toán, có một ô "Ghi chú đơn hàng" tùy chọn mà bạn có thể điền các hướng dẫn đặc biệt về đơn hàng của mình: viết lời nhắn quà tặng hoặc hướng dẫn về phương thức giao hàng. Chúng tôi sẽ gửi email cho bạn khi nhận được "Ghi chú đơn hàng" để xác nhận thông tin với bạn.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>4. Tôi có thể gửi đơn hàng đến địa chỉ quốc tế không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Có, hiện tại chúng tôi có thể chấp nhận đơn hàng trực tuyến đến các địa chỉ giao hàng trên toàn thế giới với mức phí cố định được áp dụng cho từng quốc gia cụ thể trong quá trình thanh toán.</p>
                        <p>Nếu giá vận chuyển không được liệt kê cho quốc gia bạn chọn, vui lòng liên hệ với chúng tôi qua Email: sales@Ptitjewellery.vn trước khi đặt hàng để kiểm tra giá vận chuyển.</p>
                        <p>Đối với đơn hàng quốc tế, tùy thuộc vào điểm đến vận chuyển có thể phát sinh thuế nhập khẩu (hoặc thuế hải quan) - một loại thuế được thu bởi cơ quan hải quan đối với tất cả hàng hóa được bán qua biên giới. Người mua chịu trách nhiệm thanh toán thuế nhập khẩu và các loại thuế. Thuế được áp dụng bởi Hải quan của quốc gia nhập khẩu, không phải quốc gia xuất khẩu.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>5. Đơn hàng Ptit's Jewellery mất bao lâu để giao?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Chúng tôi sẽ gửi email cho bạn để xác nhận đơn hàng trước khi gửi gói hàng đến công ty vận chuyển (UPS cho đơn hàng quốc tế và EMS Vietnam Postal Service cho đơn hàng trong nước). Thời gian vận chuyển phụ thuộc vào thời điểm chúng tôi nhận được email phản hồi từ bạn về việc xác nhận.</p>
                        <p>- Vận chuyển trong nước: 1-3 ngày làm việc.</p>
                        <p>- Vận chuyển quốc tế: 5-7 ngày làm việc.</p>
                        <p>Xin lưu ý rằng do đại dịch Covid-19, thời gian vận chuyển có thể bị ảnh hưởng và có thể lâu hơn. Chúng tôi vẫn tiếp tục theo dõi để đảm bảo gói hàng đến nơi an toàn.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>6. Sản phẩm Ptit's Jewellery có được bảo hiểm khi vận chuyển không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Ptit's Jewellery chịu trách nhiệm về các đơn hàng cho đến khi gói hàng được giao đến khách hàng. Nếu gói hàng bị mất, Ptit's Jewellery có thể mở cuộc điều tra với đơn vị vận chuyển để xác định bên chịu trách nhiệm.</p>
                        <p>Vui lòng liên hệ với chúng tôi qua Hotline (+84) 85 281 4372 ngay lập tức nếu thông tin theo dõi đơn hàng của bạn cho thấy gói hàng đã được giao nhưng không nhận được gì.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>7. Phí vận chuyển là bao nhiêu?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Ptit's Jewellery cung cấp dịch vụ vận chuyển và đổi trả miễn phí cho các đơn hàng trực tuyến trong nội thành Hà Nội. Đối với đơn hàng trong nước, mức phí cố định $2.99 sẽ được áp dụng. Đối với đơn hàng quốc tế, mức phí cố định khác nhau và phí vận chuyển sẽ xuất hiện sau khi bạn điền địa chỉ giao hàng.</p>
                        <p>Ptit's Jewellery không chi trả phí vận chuyển cho bất kỳ lần đổi trả nào đối với cả đơn hàng trong nước và quốc tế.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>8. Tôi có thể đổi trả như thế nào?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Tất cả các đơn hàng của Ptit's Jewellery đều không được hoàn tiền. Tuy nhiên, nếu có bất kỳ lỗi sản xuất nào từ phía chúng tôi, chúng tôi sẽ chấp nhận đổi trả và hoàn tiền đầy đủ. Chúng tôi chỉ chấp nhận báo cáo lỗi sản xuất trong vòng 2 ngày kể từ khi nhận được gói hàng.</p>
                        <p>Ptit's Jewellery chấp nhận đổi trả cho đơn hàng trong nước trong vòng 7 ngày kể từ ngày nhận được gói hàng. Đổi trả quốc tế có thể được áp dụng nhưng người mua phải trả phí vận chuyển cho cả hai chiều.</p>
                        <p>Xin lưu ý rằng đối với bất kỳ sản phẩm đá quý nào, chúng tôi yêu cầu hình ảnh về tình trạng hiện tại của sản phẩm trước khi bạn trả lại gói hàng. Trong trường hợp đá quý bị vỡ trong quá trình vận chuyển và không phải do lỗi của chúng tôi, việc hoàn tiền đầy đủ sẽ không được áp dụng và chúng tôi sẽ hoàn lại một phần tiền.</p>
                        <p>Tất cả các sản phẩm được cá nhân hóa bằng khắc, khắc axit, dập nổi và các dịch vụ tùy chỉnh khác đều không được đổi trả.</p>
                        <p>Việc hoàn tiền sẽ được thực hiện cho người mua theo yêu cầu nếu đã nhận được thanh toán. Người nhận quà được quyền nhận tín dụng hàng hóa không hoàn tiền. Chỉ người mua trực tiếp đặt hàng từ Ptit's Jewellery mới có thể yêu cầu hoàn tiền. Không có hoàn tiền mặt cho các lần trả hàng tại các cửa hàng bán lẻ. Để trả hoặc đổi sản phẩm đã chọn, vui lòng liên hệ với chúng tôi qua Hotline (84) 85 281 4372 hoặc qua Email: sales@Ptitjewellery.vn</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>9. Tôi có thể đổi trả mà không có hóa đơn không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Ptit's Jewellery không hoàn tiền hoặc đổi trả mà không có hóa đơn bán hàng. Chúng tôi chấp nhận hoàn tiền cho lỗi sản xuất trong vòng 2 ngày và đổi trả trong vòng 7 ngày kể từ ngày mua hàng, kèm theo hóa đơn bán hàng. Một số trường hợp có thể được loại trừ. Xin lưu ý rằng các sản phẩm được cá nhân hóa bằng khắc, khắc axit, dập nổi và các dịch vụ tùy chỉnh khác có thể không được đổi trả.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>10. Tôi có thể trả lại sản phẩm đã khắc không?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Rất tiếc, các sản phẩm đã khắc không thể được trả lại hoặc đổi trả.</p>
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
