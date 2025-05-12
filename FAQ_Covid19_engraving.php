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
                <h1>Engraving FAQ</h1>
            </div>
        </div>
    
    <div class="container">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="FAQ_Covid19.php">Covid-19 Updates</a></li>
                <li><a href="FAQ_Covid19_shopping.php">Shopping FAQ</a></li>
                <li><a href="FAQ_Covid19_product.php">Product Repair FAQ</a></li>
                <li><a href="FAQ_Covid19_shipping.php">Shipping & Return FAQ</a></li>
                <li><a href="FAQ_Covid19_engraving.php" class="active">Engraving FAQ</a></li>
            </ul>
        </div>
        
        <div class="main-content">
            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>1. Is engraving available on Huongjewellery.vn?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Huong’s Jewellery is pleased to offer monogramming, engraving and hand engraving, especially engraving service for wedding bands. You may fill out “Order Notes” about the engraving request and select your preferred engraving method. Please note that we charge a fee for engraving service. Because it is optionally personalized request, there is no fixed fee to apply for your order. We will contact you via email to confirm and ask for extra payment for engraving service.</p>
                        <p>However, not every item can be engraved. Our engraving experts have determined in advance the most appropriate technique and we will confirm with you before placing the order. Please contact us via Hotline (84) 85 281 4372 or via email: sales@huongjewellery.vn before placing orders with engraving request.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>2. May I return or exchange an engraved item?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Unfortunately, engraved items cannot be returned or exchanged.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>3. How much does engraving cost?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Pricing for engraving services depends on the complexity of your engraved designs. We will estimate the prices when we get the designs from you.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>4. How long does engraving take?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Please allow an additional 1-2 days for delivery of standard engraved items and an additional 3-4 days for delivery of hand engraved items.</p>
                        <p>Please note that engraved items may not be returned or exchanged.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>5. Is engraving available in store?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>No, Huong’s Jewellery engraving process is not on-site service. We have to send the items to our workshop for our silversmiths and goldsmiths to engrave by hand or by laser machine.</p>
                        <p>Contact our Customer Service team at Hotline (84) 85 281 4372 to learn more.</p>
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
