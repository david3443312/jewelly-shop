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
        <link rel="stylesheet" href="public/assets/css/knowledge_1.css">
        <link rel="stylesheet" href="public/assets/css/styleshomepage.css">
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
            <h1>The Freshwater Pearl</h1>
        </div>
    </div>
    
    <div class="container">
        <div class="content-section">
            <div class="text-content">
                <p>The freshwater pearls are cultured and formed by the freshwater mussels. The freshwater pearls are highly common as they are able to accommodate to any personal preferences with a wide range of shapes, sizes and colours. Compared to saltwater cultured pearls, the freshwaters is the top choice for your budget as a top-tier freshwater pearl could look identical to sea pearls such as akoya, however, at a much more affordable price range. With the pastel natural colours, the freshwaters are infamous for their modest price range while not sacrificing the versatile and glowing beauty on luxury jewelleries.</p>
            </div>
        </div>
        <div class="image-content">
            <img src="../jewelry-shop/public/assets/images/knowledge/1.jpg" alt="Freshwater pearl jewelry on dark background">
        </div>
        
        <div class="content-section">
            <div class="text-content">
                <h2>History</h2>
                <p>The freshwater pearls are cultured and formed by the freshwater mussels. They have been cultivated for hundreds of years. However, the pearl production industry officially started in the 1970's. The rapid improvement of freshwater pearl cultivation technology has resulted in smooth surface, bright lustre and round shape – which makes top-tier freshwaters comparable.</p>
                
                <h2>The colours of the freshwaters</h2>
                <p>Just like the akoyas, freshwater pearls are most commonly available in neutral tones such as white, cream, rose pink or silver. The subtleness in colours is one of the key factors that makes the freshwater pearls desirable as it reflects elegance in our daily looks, particularly on luxury jewellery designs.</p>
                
                <h2>The freshwater pearls' shapes</h2>
                <p>Just like other kinds of pearls, round freshwater pearl is set as the standard shape, followed by button, drop, off-round and baroque. The freshwater pearls also come in unique shapes such as stick or rice crispie shape, which creates exceptional jewellery designs. The evolution of cultured freshwaters is remarkable as they have come a long way from crinkled rice shapes to the perfected round pearls.</p>
            </div>
            <div class="image-content">
                <img src="../jewelry-shop/public/assets/images/knowledge/1_1.jpg" alt="Freshwater pearl rings and necklace on pink background">
            </div>
            
        </div>
        
        <div class="content-section">
            <div class="text-content">
                <h2>Why are the freshwaters valuable?</h2>
                <p>The freshwater pearls are favourably common as they are able to accommodate to any personal preferences with a wide range of shapes, sizes and colours. Compared to saltwater cultured pearls, the freshwaters is the top choice for your budget as a top-tier freshwater pearl could look identical to sea pearls such as akoya, however, at a much more affordable price range. With the pastel natural colours, the freshwaters are infamous for their modest price range while not sacrificing the versatile and glowing beauty on luxury jewelleries.</p>
            </div>
        </div>
    </div>
    <?php include '../jewelry-shop/public/assets/components/user_footer.php'; ?>
    </main>
    <script src = "../jewelry-shop//public/assets/js/slider.js"></script>
</body>
</html>
