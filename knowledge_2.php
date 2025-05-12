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
        <style>
            body * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Times New Roman', serif;
                color: #5a5a5a;
                line-height: 1.6;
                background-color: #fff;
            }
            
            .header {
                background-color: #f5f3ea;
                padding: 80px 0;
                text-align: center;
                margin-top: 80px;
                margin-bottom: 50px;
            }
            
            .header .category {
                text-transform: uppercase;
                letter-spacing: 3px;
                font-size: 12px;
                color: #777;
                margin-bottom: 10px;
                margin: 0 auto;
            }
            
            .header h1 {
                font-size: 42px;
                font-weight: normal;
                color: #444;
                padding-bottom: 30px;
            }
            
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }
            
            .content-section {
                margin: 0 auto;
            }
            
            .content-section .text-content {
                max-width: 500px;
                padding: 0 40px;
                margin: 0 auto;
            }
            
            .content-section .image-content {
                max-width: 550px;
                margin: 0 auto;
            }
            
            .content-section .image-content img {
                width: 100%;
                display: block;
            }
            
            .content-section h2 {
                font-size: 20px;
                font-weight: normal;
                color: #777;
                margin: 30px 0 0px 0;
                color: #7A7A7A;
                font-weight: bold;
            }
            
            .content-section p {
                margin-bottom: 15px;
                font-size: 15px;
                color: #777;
            }
            
            @media (max-width: 900px) {
                .content-section {
                    flex-direction: column;
                    align-items: center;
                }
                
                .content-section .text-content {
                    padding: 0 20px 40px 20px;
                }
                
                .content-section .image-content {
                    order: -1;
                    margin-bottom: 30px;
                }
            }
        </style>
    </head>
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    <main>
    <div class="header">
        <div class="container">
            <div class="category">KIẾN THỨC</div>
            <h1>Ngọc Trai Biển Nam</h1>
        </div>
    </div>
    
    <div class="container">
        <div class="content-section">
            <div class="text-content">
                <p>Ngọc Trai Biển Nam là một trong những loại ngọc trai sang trọng nhất thế giới. Với vẻ đẹp và độ hiếm của mình, Ngọc Trai Biển Nam được ưa chuộng để làm trang sức ngọc trai cao cấp.</p>
            </div>
        </div>
        <div class="image-content">
            <img src="../jewelry-shop/public/assets/images/knowledge/2.jpg" alt="Trang sức ngọc trai nước ngọt trên nền tối">
        </div>
        
        <div class="content-section">
            <div class="text-content">
                <h2>Lịch sử</h2>
                <p>Ngọc Trai Biển Nam là loại ngọc trai nuôi cấy, được tạo ra bởi hàu ngọc Pinctada maxima ở các vùng biển phía Nam và được sản xuất thương mại thành công vào những năm 1950. Ngọc Trai Biển Nam được coi là loại ngọc trai cao cấp nhất vì chúng nằm trong số những loại ngọc trai hiếm và có giá trị nhất hiện nay.</p>
                
                <h2>Màu sắc của Ngọc Trai Biển Nam</h2>
                <p>So với ngọc trai Tahiti, Ngọc Trai Biển Nam thường có các biến thể màu sắc nhẹ nhàng hơn, từ trắng, hồng, kem, vàng champagne đến vàng đậm. Các màu sắc khác nhau cũng có nguồn gốc từ các quốc gia khác nhau, ví dụ như Ngọc Trai Biển Nam màu trắng chủ yếu đến từ Úc trong khi Ngọc Trai Biển Nam màu vàng chủ yếu được nuôi cấy ở Philippines và Indonesia. Những màu có giá trị nhất là vàng đậm và trắng tinh khiết tỏa sáng trên các món trang sức, thực sự, Ngọc Trai Biển Nam là điểm nhấn thu hút mọi ánh nhìn.</p>
                
                <h2>Hình dạng của Ngọc Trai Biển Nam</h2>
                <p>Ngọc trai Tahiti thường có 8 hình dạng khác nhau, tương tự, Ngọc Trai Biển Nam cũng được thể hiện dưới dạng tròn, bán tròn, nút, hình quả lê, hình giọt, hình bầu dục, baroque hoặc có vòng. Ngọc Trai Biển Nam được tạo ra hoàn hảo như một người bạn đồng hành giúp bạn tỏa sáng trong mọi sự kiện.</p>
            </div>
            
        </div>
        
        <div class="content-section">
            <div class="text-content">
                <h2>Điều gì tạo nên giá trị của Ngọc Trai Biển Nam?</h2>
                <p>Pinctada maxima – loài hàu tạo ra Ngọc Trai Biển Nam thực tế là loài hàu ngọc lớn nhất thế giới, điều này tạo nên sự độc đáo của Ngọc Trai Biển Nam với kích thước lớn. Nó cũng mất một khoảng thời gian dài, từ 2 đến 3 năm để nuôi cấy Ngọc Trai Biển Nam, khiến chúng trở nên cực kỳ hiếm và quý giá. Chất lượng ánh sáng của Ngọc Trai Biển Nam cũng đáng chú ý về tông màu và độ sâu. Sáng bóng và phản chiếu, Ngọc Trai Biển Nam sẽ trông lộng lẫy trên bất kỳ món trang sức nào, làm nổi bật vẻ đẹp của người sở hữu.</p>
            </div>
        </div>
    </div>
    <?php include '../jewelry-shop/public/assets/components/user_footer.php'; ?>
    </main>
    <script src = "../jewelry-shop//public/assets/js/slider.js"></script>
</body>
</html>
