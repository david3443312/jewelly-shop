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
                <h1>Shipping & Return FAQ</h1>
            </div>
        </div>
    
    <div class="container">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="FAQ_Covid19.php">Covid-19 Updates</a></li>
                <li><a href="FAQ_Covid19_shopping.php">Shopping FAQ</a></li>
                <li><a href="FAQ_Covid19_product.php">Product Repair FAQ</a></li>
                <li><a href="FAQ_Covid19_shipping.php" class="active">Shipping & Return FAQ</a></li>
                <li><a href="FAQ_Covid19_engraving.php">Engraving FAQ</a></li>
            </ul>
        </div>
        
        <div class="main-content">
            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>1. What shipping options are available on Huongjewellery.vn?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Huong’s Jewellery offers both domestic and international for all orders (online orders and in store orders).</p>
                        <h2>Domestic Shipping</h2>
                        <p>Option 1: In-store Pickup at our Showrooms</p>
                        <p>- Showroom 1: 62 Hang Ngang Street, Hoan Kiem District, Hanoi, Vietnam</p>
                        <p>- Showroom 1: 62 Hang Ngang Street, Hoan Kiem District, Hanoi, Vietnam</p>
                        <p>Option 2: We use EMS – VNPost service to ship the items to your address.</p>
                        <h2>International Shipping</h2>
                        <p>We use the UPS international shipping service for all international orders. To ensure the secure delivery of your order, Huong’s Jewellery does not ship orders to post office boxes. Huong’s Jewellery is able to accept post office box addresses for your billing needs.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>2. Can I track my online order?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>A shipping notification with tracking details will be sent via email after your order has shipped. You may receive multiple email acknowledgements if your place your orders in different times, resulting in more than one shipment</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>3. Will my online purchase arrive gift-wrapped?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>All purchases from Huong’s Jewellery arrive in the signature Huong’s Jewellery brown boxes, covered by creamy lids with Huong’s Jewellery logo on brown ribbons. At the checkout process, there is an optional “Order Notes” box that you can fill out your special instructions about your order: writing a gift message or instructions for delivery methods. We will email you when we get the “Order Notes” to confirm the information with you.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>4. Can I ship my order to an international location?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, currently we are able to accept online orders to shipping addresses worldwide with a preset flat rate applied for specific country in the checkout process.</p>
                        <p>If the shipping price is not listed for the country that you choose, please contact us via Email: sales@huongjewellery.vn before placing the order to check the shipping price.</p>
                        <p>For international orders, depending on the shipping destinations there may be import duty (or customs duty) – a tax collected by customs authorities on all goods sold across borders. The buyers are responsible for paying import duties and taxes. Duties are imposed by the Customs of the importing country, not the exporting country. </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>5. How long does a Huong's Jewellery order take to ship?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>We will email you to confirm the order before we send the package to the shipping service company (the UPS for international orders and EMS Vietnam Postal Service for domestic orders). The time of shipping depends on when we get the reply email from you about the confirmation.</p>
                        <p>- Domestic Shipping: 1-3 business day(s).</p>
                        <p>- International Shipping: 5-7 business days.</p>
                        <p>Please note that due to Covid-19 pandemic, the shipping time may be affected and could be longer. We still keep on track to ensure the package is arrived safely.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>6. Are Huong’s Jewellery products insured when shipped?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Huong’s Jewellery is responsible for orders until the package is delivered to the customer.  If the package goes missing, Huong’s Jewellery may choose to open an investigation with the carrier to determine the responsible party.</p>
                        <p>Please contact us via Hotline (+84) 85 281 4372 immediately if your order tracking details indicate the package has been delivered but nothing was received.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>7. How much is shipping?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Huong’s Jewellery offers complimentary shipping and exchanges for online orders within Hanoi. For domestic orders, the flat rate $2.99 would be applied. For international orders, flat rate varies and the shipping fees will appear after you fill out your shipping address.</p>
                        <p>Huong’s Jewellery doesn’t cover the shipping fees with any exchanges for both domestic and international orders.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>8. How can I make returns or exchanges?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>All Huong’s Jewellery orders are nonrefundable. However, if there are any manufacturing defects from us, we offer returns and full refund will be applied. We only accept manufacturing defect reports within 2 days of receiving the packages.</p>
                        <p>Huong’s Jewellery accepts exchanges for domestic orders within 7 days from the date of receiving the package. International exchanges can be applied but buyers have to pay the shipping fees for 2-way delivery.</p>
                        <p>Please note that for any gemstone products, we require photos of status quo of the products before you return the package. In case the gemstones are broken during the shipment and not because of our faults, full refunds will not be applied and we will issue partial refunds.</p>
                        <p>All items that are personalized with engraving, etching, embossing and other customized services are not returned or exchanged.</p>
                        <p>A refund will be made to the purchaser upon request if payment has been received. Gift recipients are entitled to a nonrefundable merchandise credit. Only buyers who directly place the order from Huong’s Jewellery can request a refund. Cash refunds are not available for returns made at retail locations. To return or exchange your gift selection, please contact us via Hotline (84) 85 281 4372 or via Email: sales@huongjewellery.vn</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>9. How can I make returns or exchanges without a receipt?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Huong’s Jewellery does not issue refunds or exchanges without a sales receipt. We accept refunds for manufacturing defects within 2 days and exchanges for 7 days since the date of purchasing orders, accompanied by a sales receipt. Some exclusions may apply. Please note that items that are personalized with engraving, etching, embossing and other customized services may not be returned or exchanged.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>10. May I return an engraved item?</span>
                        <span class="toggle-btn">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Unfortunately, engraved items cannot be returned or exchanged.</p>
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
