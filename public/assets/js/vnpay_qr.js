document.addEventListener('DOMContentLoaded', function() {
    const checkoutForm = document.getElementById('checkout-form');
    const paymentMethodInput = document.getElementById('payment-method-input');
    const vnpayQrButton = document.createElement('button');
    vnpayQrButton.textContent = 'Thanh toán bằng VNPay QR';
    vnpayQrButton.classList.add('checkout-button'); // Sử dụng class có sẵn để có style tương tự

    const paymentOptions = document.querySelector('.payment-options');
    if (paymentOptions) {
        paymentOptions.parentNode.insertBefore(vnpayQrButton, paymentOptions.nextSibling);
    }

    vnpayQrButton.addEventListener('click', function(event) {
        event.preventDefault();

        if (paymentMethodInput.value === 'VNPAY_QR') {
            const formData = new FormData(checkoutForm);
            formData.append('action', 'create_vnpay_qr'); // Thêm hành động để server biết cần tạo QR

            fetch('create_vnpay_qr.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Lỗi tạo mã QR: ' + data.message);
                } else if (data.qr_url) {
                    // Hiển thị mã QR
                    const qrContainer = document.createElement('div');
                    qrContainer.classList.add('qr-container');
                    const qrImage = document.createElement('img');
                    qrImage.src = data.qr_url;
                    qrImage.alt = 'Mã QR VNPay';
                    qrImage.classList.add('qr-image');
                    qrContainer.appendChild(qrImage);

                    // Thêm nút để quay lại giỏ hàng (tùy chọn)
                    const backButton = document.createElement('button');
                    backButton.textContent = 'Quay lại giỏ hàng';
                    backButton.classList.add('back-button');
                    backButton.addEventListener('click', function() {
                        qrContainer.remove();
                    });
                    qrContainer.appendChild(backButton);

                    checkoutForm.parentNode.insertBefore(qrContainer, checkoutForm.nextSibling);

                    // *(Tùy chọn)* Bắt đầu polling trạng thái thanh toán
                    startPaymentPolling(data.order_id);
                }
            })
            .catch(error => {
                console.error('Lỗi khi gửi yêu cầu tạo mã QR:', error);
                alert('Đã xảy ra lỗi khi tạo mã QR.');
            });
        } else {
            checkoutForm.submit(); // Nếu không phải VNPay QR, submit form thông thường (cho COD)
        }
    });

    function startPaymentPolling(orderId) {
        const pollingInterval = setInterval(function() {
            fetch('check_payment_status.php?order_id=' + orderId)
            .then(response => response.json())
            .then(data => {
                if (data.paid) {
                    clearInterval(pollingInterval);
                    alert('Thanh toán thành công!');
                    window.location.href = 'order_success.php?order_id=' + orderId; // Chuyển đến trang thành công
                } else if (data.error) {
                    clearInterval(pollingInterval);
                    alert('Lỗi kiểm tra trạng thái thanh toán: ' + data.message);
                }
                // *(Tùy chọn)* Thêm logic timeout nếu quá lâu mà không có kết quả
            })
            .catch(error => {
                console.error('Lỗi khi kiểm tra trạng thái thanh toán:', error);
            });
        }, 5000); // Kiểm tra mỗi 5 giây
    }
});