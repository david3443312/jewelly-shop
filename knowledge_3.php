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
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    <main>
    <div class="header">
        <div class="container">
            <div class="category">KIẾN THỨC</div>
            <h1>Ngọc Trai Tahiti</h1>
        </div>
    </div>
    
    <div class="container">
        <div class="content-section">
            <div class="text-content">
                <p>Ngọc Trai Tahiti là một trong những loại ngọc trai sang trọng nhất thế giới. Với vẻ đẹp độc đáo và sự quý hiếm của mình, Ngọc Trai Tahiti được săn lùng để chế tác trang sức cao cấp.</p>
            </div>
        </div>
        <div class="image-content">
            <img src="../jewelry-shop/public/assets/images/knowledge/3.jpg" alt="Trang sức ngọc trai nước ngọt trên nền tối">
        </div>
        
        <div class="content-section">
            <div class="text-content">
                <h2>Lịch sử</h2>
                <p>Ngọc trai Tahiti được hình thành từ hàu môi đen và được đặt tên theo nơi chúng được nuôi cấy chủ yếu - xung quanh các đảo của Polynesia thuộc Pháp, gần Tahiti. Những viên ngọc trai này đã được thử nghiệm từ năm 1961, nhưng mãi đến năm 1972, chúng mới bắt đầu được xuất khẩu từ nơi khởi nguồn ra khắp thế giới. Kể từ đó, chúng được biết đến như một trong những loại ngọc trai nuôi cấy quý giá nhất.</p>
                
                <h2>Vẻ đẹp đen huyền</h2>
                <p>Mặc dù ngọc trai Tahiti có nhiều màu sắc khác nhau, từ trắng đến đen với nhiều tông màu phụ như xanh lá, xanh dương hoặc tím, chúng nổi tiếng với độ bóng lấp lánh tự nhiên và màu tối - bắt nguồn từ hàu môi đen. So với ngọc trai nước ngọt và akoya, nơi màu đen thường được nhuộm hoặc chiếu xạ, ngọc trai đen Tahiti là độc nhất vô nhị vì chúng hoàn toàn tự nhiên. Do đó, một viên ngọc trai Tahiti đen thật sự cực kỳ hiếm và được xác định là một trong những loại ngọc trai có giá trị nhất thế giới. Bề mặt lấp lánh phản chiếu ánh sáng là điều làm cho ngọc trai Tahiti trở nên kỳ lạ và đáng chú ý, tăng thêm giá trị cho vẻ đẹp của những người sở hữu nó.</p>
                
                <h2>Hình dạng của ngọc trai Tahiti</h2>
                <p>Hình dạng của ngọc trai Tahiti rất đa dạng và thường được thể hiện dưới dạng tròn, bán tròn, nút, hình quả lê, hình giọt, hình bầu dục, baroque hoặc có vòng. Điều này làm cho chúng phù hợp với nhiều dịp khác nhau và có thể được chế tác theo sở thích cá nhân.</p>
            </div>
            
        </div>
        
        <div class="content-section">
            <div class="text-content">
                <h2>Tại sao ngọc trai Tahiti có giá trị?</h2>
                <p>Hàu môi đen là loài hàu lớn với đường kính hơn một foot, do đó, những viên ngọc trai chúng tạo ra có kích thước lớn, làm tăng giá trị so với ngọc trai nhỏ hơn. Quá trình nuôi cấy để sản xuất ngọc trai Tahiti cũng rất độc đáo khi phải mất 2 năm để một con hàu trưởng thành và sẵn sàng tạo ra ngọc trai. Sự quý hiếm và vẻ đẹp độc đáo của ngọc trai Tahiti làm cho chúng trở nên đáng mong muốn, đặc biệt là khi được sử dụng để chế tác trang sức cao cấp.</p>
            </div>
        </div>
    </div>
    <?php include '../jewelry-shop/public/assets/components/user_footer.php'; ?>
    </main>
    <script src = "../jewelry-shop//public/assets/js/slider.js"></script>
</body>
</html>
