document.addEventListener('DOMContentLoaded', () => {
    // Handle removal of items
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const row = this.closest('tr[data-product-id]');
            
            // Lấy số lượng sản phẩm cần xóa để cập nhật counter
            const removedQuantity = parseInt(row.querySelector('.quantity-input').value) || 1;
            
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                // Send AJAX request to delete item
                fetch('public/assets/components/remove_from_cart.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'product_id=' + encodeURIComponent(productId)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        // Remove the row from the table
                        row.remove();
                        
                        // Update totals
                        updateGrandTotal();
                        
                        // Update cart count in header
                        updateCartCountBadge(removedQuantity);
                        
                        // Check if cart is empty
                        const remainingItems = document.querySelectorAll('tr[data-product-id]');
                        if (remainingItems.length === 0) {
                            // Replace table body with empty message
                            const tbody = document.querySelector('.cart-table tbody');
                            tbody.innerHTML = '<tr><td colspan="5" class="cart-empty">Giỏ hàng của bạn đang trống</td></tr>';
                        }
                        
                        // Show success message
                        alert(data.message || 'Đã xóa sản phẩm khỏi giỏ hàng!');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Có lỗi xảy ra, hãy thử lại.');
                });
            }
        });
    });
    
    // Function to update cart count badge in header
    function updateCartCountBadge(removedQuantity) {
        const cartCountBadge = document.querySelector('.cart-count');
        
        if (cartCountBadge) {
            // Get current count
            const currentCount = parseInt(cartCountBadge.textContent);
            
            // Calculate new count
            const newCount = currentCount - removedQuantity;
            
            // Update or remove badge
            if (newCount <= 0) {
                // If no items left, remove badge
                cartCountBadge.remove();
            } else {
                // Update badge count
                cartCountBadge.textContent = newCount;
            }
        }
    }
});