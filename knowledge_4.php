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
    </head>
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    <main>
    <div class="header">
        <div class="container">
            <div class="category">KNOWLEDGE</div>
            <h1>Pearl – Purity, Generosity, & Integrity</h1>
        </div>
    </div>
    
    <div class="container">
        <div class="content-section">
            <div class="text-content">
                <p>Known as the one and only gem from a living creature, Pearl represents the “imperfect” perfection. A pearl symbolizes the purity, generosity, and integrity. Ancient people also believed that Pearl has the calming effect to balance the wearer. Moreover, you will never find a pearl which looks exactly like the other. Each pearl features different shape, size, and lustre. Hence, the uniqueness between Pearls creates a diversity that makes them valuable on their own way. That’s why we say the “imperfect” pearl makes it become a “perfect” beauty.</p>
            </div>
        </div>
        <br>
        <div class="image-content">
            <img src="../jewelry-shop/public/assets/images/knowledge/4_1.jpg" alt="Freshwater pearl jewelry on dark background">
        </div>
        <br>
        <div class="content-section">
            <div class="text-content">
                <p>Like Pearl, we as humanbeings are born to be a part of the diversity. We don’t look for comparison to one another because any simile is meaningless. We are unique individuals who carry different personalities. The flaws that we have are all parts of our uniqueness.</p>
            </div>
        </div>
        <br>
        <div class="image-content">
            <img src="../jewelry-shop/public/assets/images/knowledge/4_2.jpg" alt="Freshwater pearl jewelry on dark background">
            <img src="../jewelry-shop/public/assets/images/knowledge/4_3.jpg" alt="Freshwater pearl jewelry on dark background">
        </div>
        <br>
        <div class="content-section">
            <div class="text-content">
                <p>A piece of jewelry can speak its own words. Truly, each of us will choose different style of jewelry to signify who we are. Pearl represents the individuality that we can find it among human beings. If you have a pearl in your hand, would you make it into the jewelry that speaks out your own personality?</p>
            </div>
        </div>
        <br>
        <div class="image-content">
            <img src="../jewelry-shop/public/assets/images/knowledge/4_4.jpg" alt="Freshwater pearl jewelry on dark background">
        </div>
        <br>
        
    </div>
    <?php include '../jewelry-shop/public/assets/components/user_footer.php'; ?>
    </main>
    <script src = "../jewelry-shop//public/assets/js/slider.js"></script>
</body>
</html>
