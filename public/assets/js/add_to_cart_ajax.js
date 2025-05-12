document.addEventListener('DOMContentLoaded', function() {
    // Lắng nghe sự kiện submit form thêm vào giỏ hàng
    document.querySelectorAll('form[action*="add_to_cart.php"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Thêm trường ajax=1 để PHP biết đây là request AJAX
            const formData = new FormData(this);
            formData.append('ajax', 1);
            
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Hiển thị thông báo
                showToast(data.message || 'Đã thêm vào giỏ hàng', 'success');
                
                // Cập nhật số đếm giỏ hàng
                updateCartCount(data.cart_count);
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Có lỗi xảy ra, vui lòng thử lại', 'error');
            });
        });
    });
    
    // Hàm cập nhật số đếm giỏ hàng
    function updateCartCount(count) {
        const cartCountElement = document.querySelector('.cart-count');
        
        if (count > 0) {
            // Nếu đã có element hiển thị số lượng
            if (cartCountElement) {
                cartCountElement.textContent = count;
            } 
            // Nếu chưa có, tạo mới
            else {
                const cartLink = document.querySelector('.cart-link');
                if (cartLink) {
                    const countBadge = document.createElement('span');
                    countBadge.className = 'cart-count';
                    countBadge.textContent = count;
                    cartLink.appendChild(countBadge);
                }
            }
        } else if (cartCountElement) {
            // Xóa badge nếu count = 0
            cartCountElement.remove();
        }
    }
    
    // Hiển thị thông báo toast
    function showToast(message, type = 'success') {
        // Nếu đã có toast message, sử dụng nó
        const existingToast = document.getElementById('toast-cart');
        if (existingToast) {
            existingToast.textContent = message;
            existingToast.style.display = 'block';
            existingToast.style.opacity = '1';
            existingToast.style.transform = 'translateY(0)';
            
            // Reset progress bar
            const progressBar = document.getElementById('toast-cart-progress');
            if (progressBar) {
                progressBar.style.width = '100%';
                setTimeout(() => {
                    progressBar.style.width = '0';
                }, 50);
            }
            
            // Ẩn sau 3 giây
            setTimeout(() => {
                existingToast.style.opacity = '0';
                existingToast.style.transform = 'translateY(40px)';
            }, 2500);
        } else {
            // Tạo toast message mới
            const toast = document.createElement('div');
            toast.id = 'toast-cart';
            toast.style.cssText = 'position: fixed; right: 30px; bottom: 80px; background: #4CAF50; color: #fff; padding: 16px 28px; border-radius: 8px; font-size: 18px; z-index: 9999; box-shadow: 0 2px 8px rgba(0,0,0,0.15); min-width: 280px; opacity: 0; transition: opacity 0.4s, transform 0.4s; transform: translateY(40px);';
            
            if (type === 'error') {
                toast.style.background = '#F44336';
            }
            
            toast.textContent = message;
            
            // Thêm progress bar
            const progressBar = document.createElement('div');
            progressBar.id = 'toast-cart-progress';
            progressBar.style.cssText = 'height: 4px; background: #fff; width: 100%; position: absolute; left: 0; bottom: 0; border-radius: 0 0 8px 8px; transition: width 2.5s linear;';
            toast.appendChild(progressBar);
            
            document.body.appendChild(toast);
            
            // Hiển thị toast
            setTimeout(() => {
                toast.style.opacity = '1';
                toast.style.transform = 'translateY(0)';
            }, 10);
            
            // Bắt đầu animation progress bar
            setTimeout(() => {
                progressBar.style.width = '0';
            }, 50);
            
            // Ẩn sau 3 giây
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(40px)';
                // Xóa khỏi DOM sau khi animation kết thúc
                setTimeout(() => {
                    toast.remove();
                }, 500);
            }, 2500);
        }
    }
});