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
            <div class="category">KNOWLEDGE</div>
            <h1>The Tahitian Pearl</h1>
        </div>
    </div>
    
    <div class="container">
        <div class="content-section">
            <div class="text-content">
                <p>The Tahitian Pearls is one of the most luxurious pearls in the world. Because of its exclusive beauty and rareness, Tahitian Pearls are hunted for making fine jewelry.</p>
            </div>
        </div>
        <div class="image-content">
            <img src="../jewelry-shop/public/assets/images/knowledge/3.jpg" alt="Freshwater pearl jewelry on dark background">
        </div>
        
        <div class="content-section">
            <div class="text-content">
                <h2>History</h2>
                <p>The Tahitian pearl is formed from the black-lip oyster and own its’ name by being primarily cultivated around the islands of French Polynesia, around Tahiti. The pearls have been in experiment since as early as 1961, but only until 1972, they started being exported from their origin across the world. They are known as one of the most precious cultured pearls ever since.</p>
                
                <h2>The Black beauty</h2>
                <p>Although the Tahitian pearls come in a wide range of colours, from white to black with a variety of overtones that includes greenish, bluish, or purplish. They are renowned for its’ radiant lustre with natural dark colour – derives from the black lip oysters. Comparing to freshwater and akoya, which the colour black is often dyed or irradiated, the black Tahitians are unique among pearls as they are natural. Therefore, a true black Tahitian pearl is extremely rare and identified as one of the most valuable pearls in the world. The shimmering surfaces that shine as they refract the light is what makes a Tahitian pearl exotic and remarkable, adding values to the beauty of those who own it.</p>
                
                <h2>The Tahitian pearls’ shapes</h2>
                <p>The Tahitian pearls shapes are diverse and are often expressed in round, semi-round, button, pear, drop, oval, baroque or ringed. This makes them suitable for different occasions and crafted to any personal liking.</p>
            </div>
            
        </div>
        
        <div class="content-section">
            <div class="text-content">
                <h2>Why Tahitian pearls are valuable?</h2>
                <p>The black-lips are large oysters with over a foot in diameter, therefore, the pearls they produce are large in size which increases the value compared to smaller pearls. The culturing process that takes to produce the Tahitian pearls is also exclusive when it takes 2 years for an oyster to become mature and be ready to produce pearls. The rareness and unique beauty of the Tahitian pearls makes them desirable, especially when in use of crafting fine jewelries.</p>
            </div>
        </div>
    </div>
    <?php include '../jewelry-shop/public/assets/components/user_footer.php'; ?>
    </main>
    <script src = "../jewelry-shop//public/assets/js/slider.js"></script>
</body>
</html>
