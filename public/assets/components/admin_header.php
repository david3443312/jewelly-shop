<header>
    <nav>
        <img src="/jewelry-shop/public/assets/images/logoicon.png" alt="Brand logo" class="logo" style = "width: 50px; height: 50px;">
        <button id="toggle-sidebar"><i class="fa-solid fa-bars"></i></button>

        <div class="icons">
            <div class="account-container">
                <div class="account-icon">
                    <a href="profile.php"><span class="iconify" data-icon="codicon:account" style="height: 95%; width: 95%;"></span></a>
                </div>
                <div class="dropdown-menu">
                    <div class="box-menu">
                        <a href="profile.php">Hồ sơ</a>
                        <a href="admin_logout.php">Đăng xuất</a>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="sidebar" id="sidebar">
            <div class="logo">
                <img src="/jewelry-shop/public/assets/images/logoicon.png" class="logo-img">
            </div>
            <h2>Jewelry - Shop</h2>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp"></span>
            </div>
            <?php $current_page = basename($_SERVER['PHP_SELF']); ?>

            <a href="dashboard.php" class="db-decorate <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                <span class="material-icons-sharp">grid_view</span>
                <h4>Dashboard</h4>
            </a>
            <a href="user_accounts.php" class="db-decorate <?php echo ($current_page == 'user_accounts.php') ? 'active' : ''; ?>">
                <span class="material-icons-sharp">person_outline</span>
                <h4>Customers</h4>                  
            </a>
            <a href="admin_order.php" class="db-decorate <?php echo ($current_page == 'admin_order.php') ? 'active' : ''; ?>">
                <span class="material-icons-sharp">receipt_long</span>
                <h4>Orders</h4>
            </a>
            <a href="#" class="db-decorate">
                <span class="material-icons-sharp">insights</span>
                <h4>Collection</h4>
            </a>
            <a href="admin_message.php" class="db-decorate <?php echo ($current_page == 'admin_message.php') ? 'active' : ''; ?>">
                <span class="material-icons-sharp">mail_outline</span>
                <h4>Messages</h4>
            </a>
            <a href="view_product.php" class="db-decorate <?php echo ($current_page == 'view_product.php') ? 'active' : ''; ?>">
                <span class="material-icons-sharp">inventory</span>
                <h4>Products</h4>
            </a>
            <a href="#" class="db-decorate">
                <span class="material-icons-sharp">report</span>
                <h4>Material</h4>
            </a>
            <a href="#" class="db-decorate">
                <span class="material-icons-sharp">settings</span>
                <h4>Special Occasion Jewelry</h4>
            </a>
            <a href="add_products.php" class="db-decorate <?php echo ($current_page == 'add_products.php') ? 'active' : ''; ?>">
                <span class="material-icons-sharp">add</span>
                <h4>Add Products</h4>
            </a>
            <a href="../components/admin_logout.php" onclick="return confirm('Logout from this website?');" class="db-decorate">
                <span class="material-icons-sharp">logout</span>
                <h4>Logout</h4>
            </a>   
        </div>
    </nav>
</header>
