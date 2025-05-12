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
                <h1>Product Repair FAQ</h1>
            </div>
        </div>
    
    <div class="container">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="FAQ_Covid19.php">Covid-19 Updates</a></li>
                <li><a href="FAQ_Covid19_shopping.php">Shopping FAQ</a></li>
                <li><a href="FAQ_Covid19_product.php" class="active">Product Repair FAQ</a></li>
                <li><a href="FAQ_Covid19_shipping.php">Shipping & Return FAQ</a></li>
                <li><a href="FAQ_Covid19_engraving.php">Engraving FAQ</a></li>
            </ul>
        </div>
        
        <div class="main-content">
            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>1. How can I get an item repaired?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>We repair all items made by Huong’s Jewellery. With customer owned jewelry, we need to make an assessment to decide whether we can accept or refuse to repair.</p>
                        <p>You may bring your item to our showroom which is nearest you. Our staff will discuss with you about the current status and estimate the solutions.</p>
                        <p>If you have any special request about repairing service, please contact us via Hotline (84) 85 281 4372.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>2. How can I check on the status of my repair?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>To check the status of your repair, please contact Customer Service at Hotline (84) 85 281 4372. Representatives are available 8:30AM – 8:30PM GMT Monday-Sunday.</p>
                        <p>If you leave a message after hours, a representative will contact you the next day.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>3. How much does it cost to repair my jewelry??</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>The cost to repair a product varies and is determined after an assessment is made. Repair pricing varies based on the type of product, material and gemstone. When the assessment is complete, we will send you an estimate. If you agree with the solutions and the price, we will process your repairing order.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>4. What cleaning and care services does Huong’s Jewellery offer?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Huong’s Jewellery offers a range of care services and resources to help you care for your jewelry.</p>
                        <p>Cleaning & Care services include:</p>
                        <p>- Professional cleaning offered on-site showroom by specialized staff</p>
                        <p>- Resizing</p>
                        <p>- Necklace restringing</p>
                        <p>- Engagement ring consultations</p>
                        <p>- Engraving</p>
                        <p>- Jewelry polishing and ultrasonic cleaning by professional silversmiths</p>
                        <p>- Strap & Clasps replacement</p>
                        <p>- Bracelet shortening</p>
                        <p>- Jewelry check-up</p>
                        <p>- Repairs</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>5. How often should I get my jewelry cleaned?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>We recommend customers bring jewelry in at least once every 6 months. Items worn daily and frequently should be cleaned and checked every 3 months.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>6. How often should I polish my silver?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Polishing silver is a process to remove tarnish and shine silver jewelry. Because some silver is removed in the process of polishing, silver jewelry should be polished only a few times in its lifetime.</p>
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
