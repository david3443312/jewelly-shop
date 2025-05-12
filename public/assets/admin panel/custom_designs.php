<?php
include '../components/connect.php';

if(isset($_COOKIE['vendor_id'])){
    $vendor_id = $_COOKIE['vendor_id'];
} else {
    $vendor_id = '';
    header('location: login.php');
}

// Delete request
if(isset($_POST['delete'])){
    $delete_id = $_POST['delete_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
    
    $delete_request = $conn->prepare("DELETE FROM `custom_designs` WHERE id = ?");
    $delete_request->execute([$delete_id]);
    
    header('location: custom_designs.php');
}

// Update status
if(isset($_POST['update_status'])){
    $update_id = $_POST['update_id'];
    $update_id = filter_var($update_id, FILTER_SANITIZE_STRING);
    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);
    
    $update_status = $conn->prepare("UPDATE `custom_designs` SET status = ? WHERE id = ?");
    $update_status->execute([$status, $update_id]);
    
    header('location: custom_designs.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Design Requests</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
    </div>

    <section class="show-products">
        <h1 class="heading cs_heading">Custom Design Requests</h1>
        <div class="box-container">
            <?php
            $select_requests = $conn->prepare("SELECT * FROM `custom_designs` ORDER BY created_at DESC");
            $select_requests->execute();
            if($select_requests->rowCount() > 0){
                while($fetch_requests = $select_requests->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="box">
                <div class="details">
                    <p>Request ID: <span><?= $fetch_requests['id']; ?></span></p>
                    <p>Name: <span><?= $fetch_requests['name']; ?></span></p>
                    <p>Email: <span><?= $fetch_requests['email']; ?></span></p>
                    <p>Phone: <span><?= $fetch_requests['phone']; ?></span></p>
                    <p>Design Type: <span><?= $fetch_requests['design_type']; ?></span></p>
                    <p>Description: <span><?= $fetch_requests['description']; ?></span></p>
                    <p>Budget: <span><?= number_format($fetch_requests['budget'], 0, ',', '.') ?> VND</span></p>
                    <p>Deadline: <span><?= $fetch_requests['deadline']; ?></span></p>
                    <p>Status: <span><?= $fetch_requests['status']; ?></span></p>
                    <p>Created At: <span><?= $fetch_requests['created_at']; ?></span></p>
                </div>
                <div class="flex-btn">
                    <form action="" method="POST">
                        <input type="hidden" name="update_id" value="<?= $fetch_requests['id']; ?>">
                        <select name="status" class="box">
                            <option value="pending">Pending</option>
                            <option value="in progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <input type="submit" name="update_status" value="Update Status" class="option-btn">
                    </form>
                    <form action="" method="POST" class="flex-btn">
                        <input type="hidden" name="delete_id" value="<?= $fetch_requests['id']; ?>">
                        <button type="submit" name="delete" class="delete-btn" onclick="return confirm('Delete this request?');">Delete</button>
                    </form>
                </div>
            </div>
            <?php
                }
            } else {
                echo '<p class="empty">No requests found!</p>';
            }
            ?>
        </div>
    </section>

    <script src="../js/admin_script.js"></script>
</body>
</html> 