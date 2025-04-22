document.querySelector('.shipping-calculate').addEventListener('click', function(e) {
    e.preventDefault();
    
    // Reference point - Mỗ Lao, Hà Đông, Hà Nội
    const REFERENCE_POINT = "Mỗ Lao, Hà Đông, Hà Nội, Việt Nam";
    
    // Price threshold for free shipping (1 million VND)
    const FREE_SHIPPING_THRESHOLD = 1000000;
    
    // Base shipping cost for orders below threshold (within 20km)
    const BASE_SHIPPING_COST = 15000;
    
    // Additional cost per 10km beyond initial 20km
    const COST_PER_10KM = 10000;
    
    // Initial free distance range
    const INITIAL_DISTANCE = 20; // in kilometers
    
    // Check if all required fields are filled
    const city = document.getElementById('city');
    const district = document.getElementById('district');
    const ward = document.getElementById('ward');
    const specificAddress = document.getElementById('specific-address');
    
    if (!city.value || !district.value || !ward.value || !specificAddress.value) {
        alert('Vui lòng điền đầy đủ thông tin địa chỉ');
        return;
    }
    
    // Get product total
    const productTotalEl = document.querySelector('.cart-totals .totals-table tr:first-child .value');
    let productTotal = 0;
    if (productTotalEl) {
        const productTotalText = productTotalEl.textContent;
        productTotal = parseInt(productTotalText.replace(/[^0-9]/g, '')) || 0;
    }
    
    // Get selected address components
    const cityText = city.options[city.selectedIndex].text;
    const districtText = district.options[district.selectedIndex].text;
    const wardText = ward.options[ward.selectedIndex].text;
    const specificAddressText = specificAddress.value;
    
    // Construct full address
    const fullAddress = `${specificAddressText}, ${wardText}, ${districtText}, ${cityText}, Việt Nam`;
    
    // Update shipping cost display to "Đang tính..."
    const shippingCostEl = document.querySelector('.shipping-cost');
    shippingCostEl.textContent = "Đang tính...";
    
    // Calculate distance using Google Maps API
    if (typeof google !== 'undefined' && google.maps) {
        const service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix({
            origins: [REFERENCE_POINT],
            destinations: [fullAddress],
            travelMode: 'DRIVING',
            unitSystem: google.maps.UnitSystem.METRIC
        }, function(response, status) {
            let shippingCost = 0;
            
            if (status === 'OK' && response.rows[0].elements[0].status === 'OK') {
                // Get distance value in meters and convert to km
                const distanceValue = response.rows[0].elements[0].distance.value / 1000;
                console.log("Khoảng cách tính được: " + distanceValue + " km");
                
                // Calculate shipping cost based on distance and product total
                if (distanceValue <= INITIAL_DISTANCE) {
                    // Within 20km
                    if (productTotal >= FREE_SHIPPING_THRESHOLD) {
                        shippingCost = 0; // Free shipping for orders >= 1 million VND
                    } else {
                        shippingCost = BASE_SHIPPING_COST; // 15,000đ for orders < 1 million VND
                    }
                } else {
                    // Beyond 20km
                    if (productTotal >= FREE_SHIPPING_THRESHOLD) {
                        // Start with 0đ for first 20km, then add 10,000đ per 10km
                        const additionalDistance = distanceValue - INITIAL_DISTANCE;
                        const additionalChunks = Math.ceil(additionalDistance / 10);
                        shippingCost = additionalChunks * COST_PER_10KM;
                    } else {
                        // Start with 15,000đ for first 20km, then add 10,000đ per 10km
                        const additionalDistance = distanceValue - INITIAL_DISTANCE;
                        const additionalChunks = Math.ceil(additionalDistance / 10);
                        shippingCost = BASE_SHIPPING_COST + (additionalChunks * COST_PER_10KM);
                    }
                }
                
                // Update shipping cost display
                shippingCostEl.textContent = shippingCost.toLocaleString() + 'đ';
                
                // Update grand total
                const finalTotal = productTotal + shippingCost;
                const finalTotalEl = document.querySelector('.grand-total');
                if (finalTotalEl) {
                    finalTotalEl.textContent = finalTotal.toLocaleString() + 'đ';
                }
                
            } else {
                console.error("Error calculating distance:", status);
                // Fall back to default shipping cost if API fails
                if (productTotal >= FREE_SHIPPING_THRESHOLD) {
                    shippingCost = 0;
                } else {
                    shippingCost = BASE_SHIPPING_COST;
                }
                
                shippingCostEl.textContent = shippingCost.toLocaleString() + 'đ';
                alert("Không thể tính khoảng cách chính xác. Đã áp dụng phí vận chuyển cơ bản.");
            }
        });
    } else {
        // Google Maps API not loaded - use fallback method
        let shippingCost = 0;
        if (cityText.includes("Hà Nội")) {
            if (districtText.includes("Hà Đông")) {
                shippingCost = productTotal >= FREE_SHIPPING_THRESHOLD ? 0 : BASE_SHIPPING_COST;
            } else {
                shippingCost = productTotal >= FREE_SHIPPING_THRESHOLD ? COST_PER_10KM : BASE_SHIPPING_COST + COST_PER_10KM;
            }
        } else {
            shippingCost = productTotal >= FREE_SHIPPING_THRESHOLD ? COST_PER_10KM * 3 : BASE_SHIPPING_COST + (COST_PER_10KM * 3);
        }
        
        shippingCostEl.textContent = shippingCost.toLocaleString() + 'đ';
        
        // Update grand total
        const finalTotal = productTotal + shippingCost;
        const finalTotalEl = document.querySelector('.grand-total');
        if (finalTotalEl) {
            finalTotalEl.textContent = finalTotal.toLocaleString() + 'đ';
        }
    }
});

// Keep your existing updateGrandTotal function
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