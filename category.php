<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Danh mục trang sức - Jewelry Shop</title>
        <link rel="stylesheet" href="public/assets/css/user_header.css">
        <link rel="stylesheet" href="public/assets/css/stylecategories.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
        <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
        <link rel="icon" href="images/logoicon.png" type="image/x-icon">
    </head>
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    <main>
        <div class="container">
            <div class="header">
                <h1>Nay tình yêu cần trang sức gì?</h1>
                <div class="jewelry-type">
                    <select name="jewelry-type" id="jewelry-type-select">
                        <option value="" disabled selected>Chọn loại trang sức</option>
                        <option value="nha">Nhẫn</option>
                        <option value="vongtay">Vòng tay</option>
                        <option value="vongco">Vòng cổ</option>
                        <option value="daychuyen">Dây chuyền</option>
                        <option value="khuyentai">Khuyên tai</option>
                        <option value="dongho">Đồng hồ</option>
                    </select>
                    <button type="button" onclick="redirectToProducts()">OK</button>
                </div>
                <script>
                function redirectToProducts() {
                    var select = document.getElementById('jewelry-type-select');
                    var type = select.value;
                    var path = '';
                    if (type) {
                        switch (type) {
                            case 'nha':
                                path = 'ring';
                                break;
                            case 'vongtay':
                                path = 'bracelet';
                                break;
                            case 'vongco':
                                path = 'necklace';
                                break;
                            case 'daychuyen':
                                path = 'neckchain';
                                break;
                            case 'khuyentai':
                                path = 'earring';
                                break;
                            case 'dongho':
                                path = 'watch';
                                break;
                            default:
                                alert('Loại trang sức không hợp lệ.');
                                return;
                        }
                        window.location.href = '/jewelry-shop/products.php?category=' + path;
                    } else {
                        alert('Vui lòng chọn loại trang sức');
                    }
                }
                </script>
                <div class="product-button">
                    <button type="button" class="all-btn" onclick="window.location.href='/jewelry-shop/products.php'">
                        Hay bạn xem tắt cả sản phẩm nha?
                    </button>
                </div>
                <div class="sort-container">
                    <select class="sort-select">
                        <option>Mặc định</option>
                        <option>Bảng chữ cái</option>
                        <option>Số lượng hàng</option>
                        <option>Chọn bừa ik =))</option>
                    </select>
                </div>
            </div>
    
            <div class="category-grid">
                <a href="/jewelry-shop/products.php?category=ring">
                    <div class="category-card">
                        <div class="category-image">
                            <img src="public/assets/images/categories/ring.jpg" alt="Nhẫn">
                        </div>
                        <div class="category-info">
                            <h2 class="category-title">Nhẫn</h2>
                            <p class="category-description">Khám phá bộ sưu tập nhẫn tinh tế và sang trọng.</p>
                        </div>
                    </div>
                </a>
            
                <a href="/jewelry-shop/products.php?category=bracelet">
                    <div class="category-card">
                        <div class="category-image">
                            <img src="public/assets/images/categories/bracelet.jpg" alt="Vòng tay">
                        </div>
                        <div class="category-info">
                            <h2 class="category-title">Vòng tay</h2>
                            <p class="category-description">Tìm cho mình chiếc vòng tay phong cách, cá tính.</p>
                        </div>
                    </div>
                </a>
            
                <a href="/jewelry-shop/products.php?category=necklace">
                    <div class="category-card">
                        <div class="category-image">
                            <img src="public/assets/images/categories/necklace.jpg" alt="Vòng cổ">
                        </div>
                        <div class="category-info">
                            <h2 class="category-title">Vòng cổ</h2>
                            <p class="category-description">Bộ sưu tập vòng cổ đẹp mắt, hoàn hảo cho mọi phong cách.</p>
                        </div>
                    </div>
                </a>
            
                <a href="/jewelry-shop/products.php?category=chain">
                    <div class="category-card">
                        <div class="category-image">
                            <img src="public/assets/images/categories/chain.jpg" alt="Dây chuyền">
                        </div>
                        <div class="category-info">
                            <h2 class="category-title">Dây chuyền</h2>
                            <p class="category-description">Dây chuyền độc đáo mang đậm nét hiện đại và truyền thống.</p>
                        </div>
                    </div>
                </a>
            
                <a href="/jewelry-shop/products.php?category=earring">
                    <div class="category-card">
                        <div class="category-image">
                            <img src="public/assets/images/categories/earring.jpg" alt="Khuyên tai">
                        </div>
                        <div class="category-info">
                            <h2 class="category-title">Khuyên tai</h2>
                            <p class="category-description">Khuyên tai sang trọng, tinh tế cho mọi phong cách.</p>
                        </div>
                    </div>
                </a>
            
                <a href="/jewelry-shop/products.php?category=watch">
                    <div class="category-card">
                        <div class="category-image">
                            <img src="public/assets/images/categories/watch.jpg" alt="Đồng hồ">
                        </div>
                        <div class="category-info">
                            <h2 class="category-title">Đồng hồ</h2>
                            <p class="category-description">Đồng hồ thời trang và đẳng cấp dành cho bạn.</p>
                        </div>
                    </div>
                </a>
            </div>
    </main>
</body>