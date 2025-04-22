<!-- Replace the static order list in user_profile.php -->
<div id="orders" class="section hidden">
    <h2>Đơn mua</h2>
    <?php
    // Query to get user's orders
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
    $stmt->execute([$user_id]);
    
    if ($stmt->rowCount() > 0) {
    ?>
    <ul class="order-list">
        <?php while ($order = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <li class="order-item">
            <div class="order-header">
                <p><strong>Mã đơn hàng:</strong> #<?= $order['id']; ?></p>
                <p><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($order['order_date'])); ?></p>
                <p><strong>Trạng thái:</strong> <span class="order-status <?= $order['status']; ?>"><?= $order['status']; ?></span></p>
                <p><strong>Tổng tiền:</strong> <?= number_format($order['total_price']); ?>đ</p>
                <button class="toggle-details" onclick="toggleOrderDetails('order-<?= $order['id']; ?>')">Chi tiết</button>
            </div>
            
            <div class="order-details" id="order-<?= $order['id']; ?>">
                <h4>Thông tin giao hàng:</h4>
                <p><strong>Người nhận:</strong> <?= $order['name']; ?></p>
                <p><strong>Số điện thoại:</strong> <?= $order['phone']; ?></p>
                <p><strong>Địa chỉ:</strong> <?= $order['address']; ?></p>
                
                <h4>Sản phẩm:</h4>
                <table class="order-products">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Get order items
                        $items_stmt = $conn->prepare("
                            SELECT oi.*, p.name, p.image
                            FROM order_items oi
                            JOIN products p ON oi.product_id = p.id
                            WHERE oi.order_id = ?
                        ");
                        $items_stmt->execute([$order['id']]);
                        
                        while ($item = $items_stmt->fetch(PDO::FETCH_ASSOC)):
                            $item_total = $item['price'] * $item['quantity'];
                        ?>
                        <tr>
                            <td>
                                <img src="public/assets/uploaded_files/<?= $item['image']; ?>" alt="<?= $item['name']; ?>" class="product-thumbnail">
                                <?= $item['name']; ?>
                            </td>
                            <td><?= number_format($item['price']); ?>đ</td>
                            <td><?= $item['quantity']; ?></td>
                            <td><?= number_format($item_total); ?>đ</td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Phí vận chuyển:</td>
                            <td><?= number_format($order['shipping_cost']); ?>đ</td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>Tổng cộng:</strong></td>
                            <td><strong><?= number_format($order['total_price']); ?>đ</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </li>
        <?php endwhile; ?>
    </ul>
    <?php } else { ?>
    <p class="no-orders">Bạn chưa có đơn hàng nào.</p>
    <?php } ?>
</div>


function toggleOrderDetails(orderId) {
    const detailsElement = document.getElementById(orderId);
    if (detailsElement.style.display === 'block') {
        detailsElement.style.display = 'none';
    } else {
        detailsElement.style.display = 'block';
    }
}