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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
        <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
        <link rel="icon" href="../jewelry-shop/public/assets/images/logoicon.png" type="image/x-icon">
        <style>
            body * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Times New Roman', serif;
                color: #5a5a5a;
                line-height: 1.6;
                background-color: #fff;
            }
            
            .header {
                background-color: #f5f3ea;
                padding: 80px 0;
                text-align: center;
                margin-top: 80px;
                margin-bottom: 50px;
            }
            
            .header .category {
                text-transform: uppercase;
                letter-spacing: 3px;
                font-size: 12px;
                color: #777;
                margin-bottom: 10px;
                margin: 0 auto;
            }
            
            .header h1 {
                font-size: 42px;
                font-weight: normal;
                color: #444;
                padding-bottom: 30px;
            }
            
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }
            
            .content-section {
                margin: 0 auto;
            }
            
            .content-section .text-content {
                max-width: 500px;
                padding: 0 40px;
                margin: 0 auto;
            }
            
            .content-section .image-content {
                max-width: 550px;
                margin: 0 auto;
            }
            
            .content-section .image-content img {
                width: 100%;
                display: block;
            }
            
            .content-section h2 {
                font-size: 20px;
                font-weight: normal;
                color: #777;
                margin: 30px 0 0px 0;
                color: #7A7A7A;
                font-weight: bold;
            }
            
            .content-section p {
                margin-bottom: 15px;
                font-size: 15px;
                color: #777;
            }
            
            @media (max-width: 900px) {
                .content-section {
                    flex-direction: column;
                    align-items: center;
                }
                
                .content-section .text-content {
                    padding: 0 20px 40px 20px;
                }
                
                .content-section .image-content {
                    order: -1;
                    margin-bottom: 30px;
                }
            }
        </style>
    </head>
<body>
    <?php include "public/assets/components/user_header.php"; ?>
    <main>
    <div class="header">
        <div class="container">
            <div class="category">KNOWLEDGE</div>
            <h1>The South Sea Pearl</h1>
        </div>
    </div>
    
    <div class="container">
        <div class="content-section">
            <div class="text-content">
                <p>The South Sea Pearls is one the most luxurious pearls in the world. Due to its beauty and rareness, the South Sea Pearl is desired to make fine pearl jewelry.</p>
            </div>
        </div>
        <div class="image-content">
            <img src="../jewelry-shop/public/assets/images/knowledge/2.jpg" alt="Freshwater pearl jewelry on dark background">
        </div>
        
        <div class="content-section">
            <div class="text-content">
                <h2>History</h2>
                <p>The South Seas are cultured pearls, produced by the Pinctada maxima pearl oyster in the Southern water regions and successfully being commercially produced in the 1950s. The South Sea pearls are well perceived as the top tier pearls as they are among the rarest and most valuable existing pearls.</p>
                
                <h2>Colours of the South Sea</h2>
                <p>Comparing to the Tahitians, the South Sea pearls generally come in lighter surface colour variations, ranging from white, pink, cream, champagne yellow to deep gold. Different colours also own different country origins, the white South Seas for instance, mainly come from Australia while the golden South Seas are largely cultured in the Philippines and Indonesia. The most valuable colours are deep gold and fine white that radiate on fine jewellery pieces, the South Sea pearls are in fact, a head-turner.</p>
                
                <h2>The South Sea pearls' shapes</h2>
                <p>The Tahitian pearls generally come in 8 different shapes, likewise, the South Seas are also expressed in round, semi-round, button, pear, drop, oval, baroque or ringed. The South Seas are perfectly created as the companion that makes you shine at any event.</p>
            </div>
            
        </div>
        
        <div class="content-section">
            <div class="text-content">
                <h2>What creates the value of the South Sea pearls?</h2>
                <p>Pinctada maxima – the oysters that produce the South Seas are in fact the largest pearl oyster in the world, this makes the South Sea pearls uniqueness with large sizes. It also takes an extended period of time, from 2 to 3 years to cultivate South Sea pearls, making them outstandingly rare and precious. The lustre quality of the South Seas is also remarkable for its' tone and depth. Shiny and reflective, the South Sea pearls would look extravagant on any jewellery pieces that makes the owner's beauty thrive.</p>
            </div>
        </div>
    </div>
    <?php include '../jewelry-shop/public/assets/components/user_footer.php'; ?>
    </main>
    <script src = "../jewelry-shop//public/assets/js/slider.js"></script>
</body>
</html>
