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
                                path = 'rings';
                                break;
                            case 'vongtay':
                                path = 'bracelets';
                                break;
                            case 'vongco':
                                path = 'necklaces';
                                break;
                            case 'daychuyen':
                                path = 'neckchains';
                                break;
                            case 'khuyentai':
                                path = 'earrings';
                                break;
                            case 'dongho':
                                path = 'watches';
                                break;
                            default:
                                alert('Loại trang sức không hợp lệ.');
                                return;
                        }
                        window.location.href = '/jewelry-shop/products/' + path + '.php';
                    } else {
                        alert('Vui lòng chọn loại trang sức');
                    }
                }
                </script>
                <div class="product-button">
                    <a href="/jewelry-shop/products.php" class="btn">Hay bạn xem tắt cả sản phẩm nha?</a>
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
                <div class="category-card">
                    <div class="category-image">Hình danh mục</div>
                    <div class="category-info">
                        <h2 class="category-title">Text</h2>
                        <p class="category-description">Body text</p>
                    </div>
                </div>
                <div class="category-card">
                    <div class="category-image">Hình danh mục</div>
                    <div class="category-info">
                        <h2 class="category-title">Text</h2>
                        <p class="category-description">Body text</p>
                    </div>
                </div>
                <div class="category-card">
                    <div class="category-image">Hình danh mục</div>
                    <div class="category-info">
                        <h2 class="category-title">Text</h2>
                        <p class="category-description">Body text</p>
                    </div>
                </div>
                <div class="category-card">
                    <div class="category-image">Hình danh mục</div>
                    <div class="category-info">
                        <h2 class="category-title">Text</h2>
                        <p class="category-description">Body text</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>