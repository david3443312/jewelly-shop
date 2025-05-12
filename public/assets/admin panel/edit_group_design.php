<?php
include '../components/connect.php';

if(isset($_COOKIE['vendor_id'])){
    $vendor_id = $_COOKIE['vendor_id'];
} else {
    $vendor_id = '';
    header('location: login.php');
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_SANITIZE_STRING);
    $select = $conn->prepare("SELECT * FROM `group_designs` WHERE id = ?");
    $select->execute([$id]);
    if($select->rowCount() > 0){
        $fetch = $select->fetch(PDO::FETCH_ASSOC);
    } else {
        header('location: group_designs.php');
        exit;
    }
} else {
    header('location: group_designs.php');
    exit;
}

if(isset($_POST['update'])){
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $design_type = filter_var($_POST['design_type'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $budget = filter_var($_POST['budget'], FILTER_SANITIZE_NUMBER_INT);
    $deadline = filter_var($_POST['deadline'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

    $update = $conn->prepare("UPDATE `group_designs` SET name=?, email=?, phone=?, design_type=?, description=?, budget=?, deadline=?, status=? WHERE id=?");
    $update->execute([$name, $email, $phone, $design_type, $description, $budget, $deadline, $status, $id]);
    header('location: group_designs.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Group Design</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
    </div>
    <section class="form-container">
        <form action="" method="POST">
            <h3>Edit Group Design Request</h3>
            <input type="text" name="name" required maxlength="100" placeholder="Name" class="box" value="<?= htmlspecialchars($fetch['name']); ?>">
            <input type="email" name="email" required maxlength="100" placeholder="Email" class="box" value="<?= htmlspecialchars($fetch['email']); ?>">
            <input type="text" name="phone" required maxlength="20" placeholder="Phone" class="box" value="<?= htmlspecialchars($fetch['phone']); ?>">
            <input type="text" name="design_type" required maxlength="100" placeholder="Design Type" class="box" value="<?= htmlspecialchars($fetch['design_type']); ?>">
            <textarea name="description" required maxlength="1000" placeholder="Description" class="box"><?= htmlspecialchars($fetch['description']); ?></textarea>
            <input type="number" name="budget" required min="0" placeholder="Budget" class="box" value="<?= htmlspecialchars($fetch['budget']); ?>">
            <input type="date" name="deadline" required class="box" value="<?= htmlspecialchars($fetch['deadline']); ?>">
            <select name="status" class="box">
                <option value="pending" <?= $fetch['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="in progress" <?= $fetch['status'] == 'in progress' ? 'selected' : ''; ?>>In Progress</option>
                <option value="completed" <?= $fetch['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                <option value="cancelled" <?= $fetch['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
            </select>
            <input type="submit" name="update" value="Update" class="btn">
            <a href="group_designs.php" class="option-btn">Back</a>
        </form>
    </section>
</body>
</html>
