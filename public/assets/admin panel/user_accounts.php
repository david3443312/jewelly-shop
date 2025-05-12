<?php 
    include '../components/connect.php';
    if (isset($_COOKIE['vendor_id'])) {
        $vendor_id = $_COOKIE['vendor_id'];
    } else {
        $vendor_id = '';
        header('location: login.php');
    }

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        
        // Delete user's image if exists
        $select_image = $conn->prepare("SELECT image FROM `users` WHERE id = ?");
        $select_image->execute([$delete_id]);
        $fetch_image = $select_image->fetch(PDO::FETCH_ASSOC);
        
        if($fetch_image['image'] != ''){
            unlink('../uploaded_files/'.$fetch_image['image']);
        }
        
        // Delete user
        $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
        $delete_user->execute([$delete_id]);
        
        $message[] = 'User deleted successfully!';
        header('location: user_accounts.php');
    }
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm - Jewelry Shop</title>
    <link rel="stylesheet" href="../css//stylessignup.css">
    <link rel="stylesheet" href="../css//admin_style.css">
    <link rel="stylesheet" href="../css//styleshomepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <link rel="icon" href="../images/logoicon.png" type="image/x-icon">
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'?>
    </div>
    
    <section class="user-box">
        <div class="user">
            <div class="heading">
                <h1>Regestered users</h1>
            </div>
            <div class="box-container user-box-container">
                <?php
                    $select_users = $conn->prepare("SELECT * FROM `users`");
                    $select_users->execute();

                    if ($select_users->rowCount() > 0) {
                        while ($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)) {
                            $user_id = $fetch_users['id'];
                ?>
                <div class="box">
                    <?php if(!empty($fetch_users['image'])): ?>
                        <img src="../uploaded_files/<?= $fetch_users['image']; ?>" class="logo-img" style="width:200px; height:200px; object-fit:cover; border-radius:50%;" >
                        <?php else: ?>
                        <img src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg" style="width:200px; height:200px; object-fit:cover; border-radius:50%;" alt="">
                    <?php endif; ?>
                    <p>User id : <span><?= $user_id; ?></span></p>
                    <p>User name : <span><?= $fetch_users['name']; ?></span></p>
                    <p>User email : <span><?= $fetch_users['email']; ?></span></p>
                    <div class="flex-btn">
                        <a href="update_user.php?id=<?= $user_id; ?>" class="btn">Update profile</a>
                        <button><a href="user_accounts.php?delete=<?= $user_id; ?>" class="delete-btn" onclick="return confirm('Delete this user?');">Delete user</a></button>
                    </div>
                </div>
                <?php
                        }
                    }else{
                        echo "<div class='empty'>
                            <h4>No user regestered yet!</h4>
                        </div>";
                    }
                ?>
            </div>
            <a href="add_user.php" class="btn add_user">Add New User</a>
        </div>
    </section>
    <!-- sweetalert cdn link -->
     <script src = "https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- sweetalert cdn link -->
    <?php include '../components/alert.php'; ?>
    <script src="../js//admin_script.js"></script>
</body>
</html>
