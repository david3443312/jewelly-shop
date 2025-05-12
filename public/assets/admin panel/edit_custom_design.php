<?php
include '../components/connect.php';

if (!isset($_COOKIE['vendor_id'])) {
    header('location: login.php');
    exit;
}

// Lấy id request
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location: custom_designs.php');
    exit;
}

$id = filter_var($_GET['id'], FILTER_SANITIZE_STRING);

// Xử lý cập nhật
if (isset($_POST['update'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $design_type = filter_var($_POST['design_type'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $budget = filter_var($_POST['budget'], FILTER_SANITIZE_NUMBER_INT);
    $deadline = filter_var($_POST['deadline'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

    $update = $conn->prepare("UPDATE `custom_designs` SET name=?, email=?, phone=?, design_type=?, description=?, budget=?, deadline=?, status=? WHERE id=?");
    $update->execute([$name, $email, $phone, $design_type, $description, $budget, $deadline, $status, $id]);
    header('location: custom_designs.php');
    exit;
}

// Lấy thông tin hiện tại
$get = $conn->prepare("SELECT * FROM `custom_designs` WHERE id = ?");
$get->execute([$id]);
if ($get->rowCount() == 0) {
    echo '<p class="empty">Request not found!</p>';
    exit;
}
$data = $get->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Custom Design Request</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
    </div>
    <section class="show-products">
        <h1 class="heading cs_heading">Edit Custom Design Request</h1>
        <div class="box-container">
            <form action="" method="POST" class="edit-form-container">
                <div class="input-feild">
                    <p>Name:</p>
                    <input type="text" name="name" class="box" value="<?= htmlspecialchars($data['name']) ?>" required>
                </div>
                <div class="input-feild">
                    <p>Email:</p>
                    <input type="email" name="email" class="box" value="<?= htmlspecialchars($data['email']) ?>" required>
                </div>
                <div class="input-feild">
                    <p>Phone:</p>
                    <input type="text" name="phone" class="box" value="<?= htmlspecialchars($data['phone']) ?>" required>
                </div>
                <div class="input-feild">
                    <p>Design Type:</p>
                    <input type="text" name="design_type" class="box" value="<?= htmlspecialchars($data['design_type']) ?>" required>
                </div>
                <div class="input-feild">
                    <p>Description:</p>
                    <textarea name="description" class="box" required><?= htmlspecialchars($data['description']) ?></textarea>
                </div>
                <div class="input-feild">
                    <p>Budget (VND):</p>
                    <input type="number" name="budget" class="box" value="<?= htmlspecialchars($data['budget']) ?>" required>
                </div>
                <div class="input-feild">
                    <p>Deadline:</p>
                    <input type="date" name="deadline" class="box" value="<?= htmlspecialchars($data['deadline']) ?>" required>
                </div>
                <div class="input-feild">
                    <p>Status:</p>
                    <select name="status" class="box">
                        <option value="pending" <?= $data['status']=='pending'?'selected':''; ?>>Pending</option>
                        <option value="in progress" <?= $data['status']=='in progress'?'selected':''; ?>>In Progress</option>
                        <option value="completed" <?= $data['status']=='completed'?'selected':''; ?>>Completed</option>
                        <option value="cancelled" <?= $data['status']=='cancelled'?'selected':''; ?>>Cancelled</option>
                    </select>
                </div>
                <input type="submit" name="update" value="Update" class="option-btn">
                <a href="custom_designs.php" class="btn">Back</a>
            </form>
        </div>
    </section>
    <script src="../js/admin_script.js"></script>
</body>
</html>
