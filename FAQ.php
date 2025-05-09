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
        <link rel="stylesheet" href="public/assets/css/FAQ.css">
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
                <h1>Frequently Asked Questions</h1>
            </div>
        </div>
        
        <div class="container">
            <div class="faq-grid">
                <a href="FAQ_Covid19.php">
                    <div class="faq-item">
                        <div class="faq-icon">
                            <i class="fa-solid fa-shield-virus"></i>
                        </div>
                        <div class="faq-title">Covid-19 Updates FAQ</div>
                    </div>
                </a>
                <a href="FAQ_Covid19_shopping.php">
                    <div class="faq-item">
                        <div class="faq-icon">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>
                        <div class="faq-title">Shopping FAQ</div>
                    </div>
                </a>
                <a href="FAQ_Covid19_product.php">
                    <div class="faq-item">
                        <div class="faq-icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <circle cx="12" cy="12" r="4"></circle>
                                <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                                <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                                <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                                <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                            </svg>
                        </div>
                        <div class="faq-title">Product Repair FAQ</div>
                    </div>
                </a>
            </div>
            
            <div class="faq-grid-2">
                <a href="FAQ_Covid19_shipping.php">
                    <div class="faq-item">
                        <div class="faq-icon">
                            <i class="fa-solid fa-truck-moving"></i>
                        </div>
                        <div class="faq-title">Shipping & Return FAQ</div>
                    </div>
                </a>
                <a href="FAQ_Covid19_engraving.php">
                    <div class="faq-item">
                        <div class="faq-icon">
                            <i class="fa-solid fa-feather-pointed"></i>
                        </div>
                        <div class="faq-title">Engraving FAQ</div>
                    </div>
                </a>
            </div>
        </div>
        <br>
    </main>
    <?php include '../jewelry-shop/public/assets/components/user_footer.php'; ?>
    <script src = "../jewelry-shop//public/assets/js/slider.js"></script>
</body>
</html>
