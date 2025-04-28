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
        <link rel="stylesheet" href="../jewelry-shop//public/assets/css//styleshomepage.css">
        <link rel="stylesheet" href="../jewelry-shop//public/assets/css//stylessignup.css">
        <link rel="stylesheet" href="../jewelry-shop//public/assets/css//shop.css">
        <link rel="stylesheet" href="../jewelry-shop//public/assets/css//product.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
        <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
        <link rel="icon" href="../jewelry-shop/public/assets/images/logoicon.png" type="image/x-icon">
    </head>
<body>
    <?php include '../jewelry-shop/public/assets/components/user_header.php'; ?>
    <div class="container">     
        <!-- Product -->
        <div class="product-container">
            <div class="product-image">
                <img src="/api/placeholder/400/400" alt="Sterling Silver Dragonfly Pendant">
            </div>
            
            <div class="product-details">
                <h1 class="product-title">Sterling Silver Dragonfly Pendant</h1>
                <div class="product-price">$46.00</div>
                
                <div class="product-description">
                    Introducing our exquisite Sterling Silver Dragonfly Pendant, a true embodiment of elegance and grace. Crafted with utmost precision, this dainty pendant showcases a unique dragonfly design with intricately perforated wings, adding a touch of charm to its overall appeal. Made from high-quality sterling silver, this pendant exudes a timeless beauty that is suitable for individuals of any age. This pendant is a perfect accessory to enhance your style and make a statement of sophistication.
                </div>
                
                <div class="quantity-selector">
                    <button class="quantity-btn" id="decrease">-</button>
                    <input type="text" class="quantity-input" value="1" id="quantity">
                    <button class="quantity-btn" id="increase">+</button>
                </div>
                
                <button class="add-to-cart">Add to cart</button>
                
                <div class="safe-checkout">
                    <div class="safe-checkout-title">GUARANTEED SAFE CHECKOUT</div>
                    <div class="payment-icons">
                        <img src="/api/placeholder/80/40" alt="Visa">
                        <img src="/api/placeholder/80/40" alt="Mastercard">
                        <img src="/api/placeholder/80/40" alt="PayPal">
                    </div>
                </div>
                
                <div class="product-meta">
                    <div>SKU: 33015453</div>
                    <div>Categories: <a href="#">Jewellery</a>, <a href="#">Pendants</a>, <a href="#">Silver Pendants</a></div>
                </div>
            </div>
        </div>
        
        <!-- Tabs -->
        <div class="tabs">
            <div class="tab active" data-tab="description">Description</div>
        </div>
        
        <div class="tab-content active" id="description-content">
            <p>Introducing our exquisite Sterling Silver Dragonfly Pendant, a stunning piece that will add a touch of elegance to any outfit. Crafted with precision, this dainty pendant features a unique design with perforated wings, adding a touch of charm and cuteness. Made from high-quality sterling silver, this pendant is not only visually appealing but also durable. Its versatile style makes it suitable for individuals of any age, making it a perfect gift for yourself or a loved one.</p>
        </div>
        
        <!-- Related Products -->
        <div class="related-products">
            <h2 class="related-title">Related products</h2>
            
            <div class="products-grid">
                <a href="#" class="product-card">
                    <img src="/api/placeholder/250/250" alt="Cultured Pearl Swirl Pendant">
                    <h3 class="product-card-title">Cultured Pearl Swirl Pendant</h3>
                    <div class="product-card-price">$153.00</div>
                </a>
                
                <a href="#" class="product-card">
                    <img src="/api/placeholder/250/250" alt="Tahitian Pearl Ring">
                    <h3 class="product-card-title">Tahitian Pearl Ring</h3>
                    <div class="product-card-price">$0.00</div>
                </a>
                
                <a href="#" class="product-card">
                    <img src="/api/placeholder/250/250" alt="Adjustable Floral Clasp Pearl Necklace">
                    <h3 class="product-card-title">Adjustable Floral Clasp Pearl Necklace</h3>
                    <div class="product-card-price">$0.00</div>
                </a>
                
                <a href="#" class="product-card">
                    <img src="/api/placeholder/250/250" alt="U Shape Silver Pearl Ball Ring">
                    <h3 class="product-card-title">U Shape Silver Pearl Ball Ring</h3>
                    <div class="product-card-price">$55.00</div>
                </a>
            </div>
        </div>
    </div>
    
    <script>
        // Quantity selector
        const decreaseBtn = document.getElementById('decrease');
        const increaseBtn = document.getElementById('increase');
        const quantityInput = document.getElementById('quantity');
        
        decreaseBtn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                quantityInput.value = value - 1;
            }
        });
        
        increaseBtn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            quantityInput.value = value + 1;
        });
        
        // Add to cart button
        const addToCartBtn = document.querySelector('.add-to-cart');
        addToCartBtn.addEventListener('click', () => {
            const quantity = parseInt(quantityInput.value);
            alert(`Added ${quantity} Sterling Silver Dragonfly Pendant(s) to your cart!`);
        });
        
        // Tabs
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked tab
                tab.classList.add('active');
                
                // Hide all tab contents
                const tabContents = document.querySelectorAll('.tab-content');
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Show the corresponding tab content
                const tabId = tab.getAttribute('data-tab');
                document.getElementById(`${tabId}-content`).classList.add('active');
            });
        });
    </script>
</body>
</html>