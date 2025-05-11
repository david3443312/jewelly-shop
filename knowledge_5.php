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
            <h1>Select Pearl, Sterling Silver & Gold</h1>
        </div>
    </div>
    
    <div class="container">
        <h2>The quality of Pearl are commonly identified by a set of qualification of 2C and 4S</h2>
        <div class="content-section">
            <div class="text-content">
                <h2>Color & Coating</h2>
                <p>Color: Natural and cultured pearls have a wide range of hues. The most common hues are yellow, orange, and pink. Other cool tones are blue, violet, and green. Pearl colors frequently obtain soft and subtle quality. There are three components of pearl colors. Body color is the main color of the pearl. Overtone is another translucent color which lies over the body color. Orient is a shine color of iridescent rainbow colors on a pearl’s surface. Every pearl shows their body colors, but only some pearls display overtone and orient colors.</p>
                <p>Coating: or Luster of pearl. Coating or luster is the most important factor to determine the beauty of a pearl. The higher the luster, the more valuable and rarer of the pearl. High quality pearls acquire shiny luster along with clear overtone and orient colors.</p>
                
                <h2>Shape, Shine, Size & Spot</h2>
                <p>Shape: Pearls can come in different shapes. Cultured pearls usually appear in oval or pear shapes. Round is considered as a perfect shape for pearls since it is difficult for mussels to create it. However, baroque pearls in irregularly shapes are hunted by many pearl lovers because of its uniqueness.</p>
                <p>Shine: The more shiny of a pearl, the better it’s worth. Most pearls never achieve perfection. Some of them might show scratches on the surface, or a flattened section. However, real pearls never lose their shine and imperfections do not affect the pearls’s shapes.</p>
                <p>Size: Because of its subtleness, normally pearls are measured by millimeters. Size of pearls appear in various number, from small like 2mm to bigger ones like 20mm. Every other things are equal, larger pearls are more expensive than smaller pearls.</p>
                <p>Spot: It is quite rare to find a pearl without any spot. The spots are created during the period when mussels are forming pearls. However, when it comes to jewelries, spots won’t be appeared in the surface of products. Pearls themselves are gemstones that are refrained from chemical exposure. Moreover, they are vulnerable to the weather. There is sometime very high humidity in Hanoi, therefore they should be treated with care. After using them, please wipe them gently with soft cloth.</p>

                <h2>Sterling silver is our standard silver whereas gold is usually of 14k and 18k</h2>
                <p>You do not need fancy jewellery cleaner to get your silver to shine, your gold to gleam. Toothpaste can be excellent in cleaning gold and silver item. Mild, abrasive toothpaste is very good for loosening the dirt and grime of the items. Pls rinse them thoroughly with a soft cloth.</p>
            </div>  
        </div>
    </div>
    <?php include '../jewelry-shop/public/assets/components/user_footer.php'; ?>
    </main>
    <script src = "../jewelry-shop//public/assets/js/slider.js"></script>
</body>
</html>
