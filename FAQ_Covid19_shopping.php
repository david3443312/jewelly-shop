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
                <h1>Shopping FAQ</h1>
            </div>
        </div>
    
    <div class="container">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="FAQ_Covid19.php">Covid-19 Updates</a></li>
                <li><a href="FAQ_Covid19_shopping.php" class="active">Shopping FAQ</a></li>
                <li><a href="FAQ_Covid19_product.php">Product Repair FAQ</a></li>
                <li><a href="FAQ_Covid19_shipping.php">Shipping & Return FAQ</a></li>
                <li><a href="FAQ_Covid19_engraving.php">Engraving FAQ</a></li>
            </ul>
        </div>
        
        <div class="main-content">
            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>1. How do I place an order on Huongjewellery.vn?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Ordering on Huongjewellery.vn is fast and convenient. Once you have found the item you would like to purchase, click on the "Add to Bag" button to place it in your Shopping Bag. Follow the directions through the checkout process to complete your order.</p>
                        <p>Your order will not be placed until the end of the checkout process when you will be asked for your credit card information or your PayPal account.</p>
                        <p>You may also order over the phone by calling Hotline (+84) 85 281 4372.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>2. Can I include a personalized gift message with my purchase?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, you will be given the opportunity to create a personalized message at checkout. The message will be written in a white card which includes Huong's Jewellery Logo. We will follow your notes to decide whether put the buyer's name in the package or not. For this reason, we suggest you enter your name on the gift message and make a detailed instruction for us in the "Order Note" section.</p>
                        <p>Please contact Customer Service at Hotline (+84) 85 281 4372 if you have any questions regarding change of personalized message.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>3. What payment methods does Huongjewellery.vn accept?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Huong's Jewellery accepts all major credit cards, direct bank transfer and PayPal. For information on alternate payment methods, please contact Customer Service at Hotline (+84) 85 281 4372, or email us at sales@huongjewellery.vn</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>4. Is it safe to order on Huongjewellery.vn?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, it is safe to order on Huongjewellery.vn. We encrypt order information for your protection using industry-standard SSL encryption. SSL encrypts your personal account information and secures your purchase and credit card information.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>5. How can I find out if an item sold online is available at my local store?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Please contact Customer Service at Hotline (84) 85 281 4372 to check availability of products. Please note that the availability of products is subject to change.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>6. Is in-store pickup available for online items purchased on Huongjewellery.vn?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Please contact us via Email: sales@huongjewellery.vn or Hotline (84) 85 281 4372 to check which showroom where your ordered items are located.</p>
                        <p>In-store pickup of items ordered online is available at our showrooms:</p>
                        <p>- Huong's Jewellery - 123 Nguyễn Thị Minh Khai, P. Bến Nghé, Q.1, TP.HCM</p>
                        <p>- Huong's Jewellery - 123 Nguyễn Thị Minh Khai, P. Bến Nghé, Q.1, TP.HCM</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>7. Are prices on Huongjewellery.vn subject to change?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Prices on Huongjewellery.vn are subject to change without notice. Please expect to be charged the price for the merchandise you buy as it is listed on the day of purchase.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>8. Does Huong's Jewellery offer resizing?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Huong's Jewellery offers resizing for selected items. Please contact Customer Service at Hotline (+84) 85 281 4372 to learn more.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>9. Does Huong's Jewellery have a ring size conversion chart?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Yes. Huong's Jewellery has a ring size conversion chart available online to help you determine your ring size. Please click here to view chart.</p>
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
