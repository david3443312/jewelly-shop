<!-- Update the checkout button section in cart.php -->
<form action="public/assets/components/process_order.php" method="post" id="checkout-form">
    <input type="hidden" name="shipping_cost" id="shipping-cost-input" value="0">
    <input type="hidden" name="payment_method" value="COD">
    
    <div class="shipping-info">
        <div class="form-group">
            <label for="full-name">Họ tên:</label>
            <input type="text" id="full-name" name="full_name" placeholder="Nhập họ tên của bạn" required>
        </div>
        <div class="form-group">
            <label for="phone-number">Số điện thoại:</label>
            <input type="tel" id="phone-number" name="phone_number" placeholder="Nhập số điện thoại của bạn" required>
        </div>
        <div class="form-group">
            <label for="city">Tỉnh/Thành phố:</label>
            <select class="form-select" id="city" name="city" required>
                <option value="" selected>Chọn tỉnh thành</option>
            </select>
        </div>
        <div class="form-group">
            <label for="district">Quận/Huyện:</label>
            <select class="form-select" id="district" name="district" required>
                <option value="" selected>Chọn quận huyện</option>
            </select>
        </div>
        <div class="form-group">
            <label for="ward">Xã/Phường:</label>
            <select class="form-select" id="ward" name="ward" required>
                <option value="" selected>Chọn phường xã</option>
            </select>
        </div>
        <div class="form-group">
            <label for="specific-address">Địa chỉ cụ thể (số nhà, toà nhà...):</label>
            <input type="text" id="specific-address" name="specific_address" placeholder="Nhập địa chỉ cụ thể" required>
        </div>
        <div><button type="button" class="shipping-calculate">Tính phí vận chuyển</button></div>
    </div>

    <table class="totals-table">
        <tr>
            <td class="label">Phí vận chuyển</td>
            <td class="value shipping-cost">0đ</td>
        </tr>
        <tr class="grand-total-row">
            <td class="label"><b>Tổng cộng</b></td>
            <td class="value grand-total"><?= number_format($grand_total); ?>đ</td>
        </tr>
    </table>

    <button type="submit" class="checkout-button">Đặt hàng</button>
</form>