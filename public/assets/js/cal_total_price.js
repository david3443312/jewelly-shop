document.addEventListener('DOMContentLoaded', () => {
    // Hành động cho các nút tăng và giảm số lượng
    document.querySelectorAll('.btn-increment, .btn-decrement').forEach(button => {
        button.addEventListener('click', function() {
            const tr = this.closest('tr');
            const productId = tr.dataset.productId;
            const quantityInput = tr.querySelector('.quantity-input');
            let currentQty = parseInt(quantityInput.value);

            if (this.classList.contains('btn-increment')) {
                currentQty++;
            } else if (this.classList.contains('btn-decrement') && currentQty > 1) {
                currentQty--;
            }

            quantityInput.value = currentQty;

            const priceEl = tr.querySelector('.product-price');
            let priceText = priceEl.dataset.price || priceEl.textContent;
            priceText = priceText.replace(/[^0-9.]/g, '');
            const price = parseFloat(priceText);
            const newSubTotal = price * currentQty;
            tr.querySelector('.product-subtotal').textContent = newSubTotal.toLocaleString() + "đ";

            fetch('public/assets/components/update_cart_quantity.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'product_id=' + encodeURIComponent(productId) + '&new_quantity=' + encodeURIComponent(currentQty)
            })
            .then(response => response.json())
            .then(data => {
                if(data.error) {
                    alert(data.error);
                } else {
                    console.log('Số lượng đã được cập nhật.');
                    updateGrandTotal();
                }
            })
            .catch(err => {
                console.error(err);
                alert('Có lỗi xảy ra, hãy thử lại.');
            });
        });
    });

    // Hàm cập nhật tổng tiền toàn giỏ hàng và cập nhật vào bảng "Tổng tiền sản phẩm"
    function updateGrandTotal(){
        let grandTotal = 0;
        document.querySelectorAll('tr[data-product-id]').forEach(row => {
            const priceEl = row.querySelector('.product-price');
            let priceText = priceEl.dataset.price || priceEl.textContent;
            priceText = priceText.replace(/[^0-9.]/g, '');
            const price = parseFloat(priceText);
            const quantity = parseInt(row.querySelector('.quantity-input').value);
            grandTotal += price * quantity;
        });
        
        // Cập nhật ô Tổng cộng ở bảng giỏ hàng bên trái
        const grandTotalCell = document.querySelector('.cart-total-row .product-subtotal');
        if(grandTotalCell){
            grandTotalCell.textContent = grandTotal.toLocaleString() + "đ";
        }
        
        // Cập nhật ô "Tổng tiền sản phẩm" ở bảng bên cột trái trong phần cart-totals
        const productTotalEl = document.querySelector('.cart-totals .totals-table tr:first-child .value');
        if(productTotalEl) {
            productTotalEl.textContent = grandTotal.toLocaleString() + "đ";
        }
        
        // Lấy giá trị phí vận chuyển hiện tại
        const shippingCostEl = document.querySelector('.shipping-cost');
        if(shippingCostEl) {
            const shippingText = shippingCostEl.textContent;
            const shippingCost = parseInt(shippingText.replace(/[^0-9]/g, '')) || 0;
            
            // Tính tổng cộng mới (sản phẩm + vận chuyển)
            const finalTotal = grandTotal + shippingCost;
            
            // Cập nhật tổng cộng
            const finalTotalEl = document.querySelector('.grand-total');
            if(finalTotalEl) {
                finalTotalEl.textContent = finalTotal.toLocaleString() + "đ";
            }
        }
    }
});