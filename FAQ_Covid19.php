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
                <h1>Covid-19 Updates & FAQ</h1>
            </div>
        </div>
    
    <div class="container">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="FAQ_Covid19.php" class="active">Covid-19 Updates</a></li>
                <li><a href="FAQ_Covid19_shopping.php">Shopping FAQ</a></li>
                <li><a href="FAQ_Covid19_product.php">Product Repair FAQ</a></li>
                <li><a href="FAQ_Covid19_shipping.php">Shipping & Return FAQ</a></li>
                <li><a href="FAQ_Covid19_engraving.php">Engraving FAQ</a></li>
            </ul>
        </div>
        
        <div class="main-content">
            <div class="intro">
                <p>Our showrooms already get back to normal operation. We are looking forward to welcoming you back.</p>
            </div>
            
            <div class="safety-measures">
                <h2>COVID-19 Safety Operational Measures</h2>
                <p>We follow guidance from regulatory authorities to ensure the safety of Huong's Jewellery teams, customers and social communities during COVID-19 pandemic. Huong's Jewellery are closely following safety measures, including:</p>
                <ul>
                    <li>All staffs wear mask</li>
                    <li>We maintain social distance between staffs and customers</li>
                    <li>Huong's Jewellery showrooms are cleaned up everyday</li>
                    <li>We provide masks and hand sanitizer dispensers at our showrooms</li>
                </ul>
            </div>
            
            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>1. How Soon Can I Pick Up My Order In-Store?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Huong's Jewellery is offering in-store pick-up. Local customers can place an order with us via phone. Our store teams will confirm product availability, process payment and provide confirmation once items are ready for pick-up.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>2. Does Huong's Jewellery Complete Daily Wellness Checks on Staff?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, all our staff members undergo daily wellness checks before starting their shifts. This includes temperature checks and health questionnaires to ensure everyone in our stores is healthy and safe to serve you.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>3. How has COVID-19 Impacted Care and Repair Services?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Our care and repair services are now operating normally with enhanced safety protocols. All items received for repair are thoroughly sanitized before and after service. Please note that due to our safety measures, repair times may be slightly longer than usual.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>4. How is Huong's Jewellery Ensuring Products Touched, Tried On or Returned by Clients are Safe?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>All products that are tried on in-store are thoroughly cleaned and sanitized after each use. For returned items, we implement a 48-hour quarantine period followed by detailed cleaning and sanitization before returning them to display or inventory.</p>
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
