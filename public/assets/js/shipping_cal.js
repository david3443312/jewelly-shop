document.querySelector('.shipping-calculate').addEventListener('click', async function(e) {
    e.preventDefault();

    // Reference point - PTIT Hà Đông
    const REFERENCE_POINT = { lat: 20.981127280039136, lng: 105.78747626240298 };

    // Mapbox token
    const MAPBOX_TOKEN = "pk.eyJ1IjoiZHVja2hvaTA0IiwiYSI6ImNtYWp5czhwdjB5Mjcya3ExMnphYmg4bTYifQ.iWecHdvJh9DaN0UTcLDpdQ";

    // Price threshold for free shipping (1 million VND)
    const FREE_SHIPPING_THRESHOLD = 1000000;
    const BASE_SHIPPING_COST = 15000;
    const COST_PER_10KM = 10000;
    const INITIAL_DISTANCE = 20; // in kilometers

    // Get address fields
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

    // Build full address
    const cityText = city.options[city.selectedIndex].text;
    const districtText = district.options[district.selectedIndex].text;
    const wardText = ward.options[ward.selectedIndex].text;
    const specificAddressText = specificAddress.value;
    const fullAddress = `${specificAddressText}, ${wardText}, ${districtText}, ${cityText}, Việt Nam`;

    const shippingCostEl = document.querySelector('.shipping-cost');
    shippingCostEl.textContent = "Đang tính...";

    // Geocode địa chỉ khách hàng sang tọa độ
    let destLat = null, destLng = null;
    try {
        const geoRes = await fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(fullAddress)}.json?access_token=${MAPBOX_TOKEN}&limit=1&country=VN`);
        const geoData = await geoRes.json();
        if (geoData.features && geoData.features.length > 0) {
            destLng = geoData.features[0].center[0];
            destLat = geoData.features[0].center[1];
        } else {
            throw new Error("Không tìm thấy địa chỉ.");
        }
    } catch (err) {
        shippingCostEl.textContent = "Không xác định được vị trí!";
        alert("Không tìm thấy địa chỉ giao hàng. Vui lòng kiểm tra lại.");
        return;
    }

    // Gọi Mapbox Directions API để lấy quãng đường
    let distanceValue = 0;
    try {
        const directionsRes = await fetch(
            `https://api.mapbox.com/directions/v5/mapbox/driving/${REFERENCE_POINT.lng},${REFERENCE_POINT.lat};${destLng},${destLat}?access_token=${MAPBOX_TOKEN}&overview=false`
        );
        const directionsData = await directionsRes.json();
        if (
            directionsData.routes &&
            directionsData.routes.length > 0 &&
            directionsData.routes[0].distance
        ) {
            distanceValue = directionsData.routes[0].distance / 1000; // convert m to km
        } else {
            throw new Error("Không tính được khoảng cách.");
        }
    } catch (err) {
        shippingCostEl.textContent = "Không tính được phí!";
        alert("Không tính được khoảng cách vận chuyển. Vui lòng thử lại.");
        return;
    }

    // Hiển thị khoảng cách (nếu có phần shipping-distance)
    const distanceEl = document.querySelector('.shipping-distance');
    if (distanceEl) {
        distanceEl.textContent = distanceValue.toFixed(1) + " km";
    } else {
        // Nếu chưa có phần tử, chèn vào sau phí vận chuyển
        const shippingRow = document.querySelector('.totals-table .shipping-cost')?.parentElement;
        if (shippingRow && !document.querySelector('.shipping-distance')) {
            const distanceTd = document.createElement('td');
            distanceTd.className = 'value shipping-distance';
            distanceTd.colSpan = 2;
            distanceTd.style.textAlign = 'right';
            distanceTd.style.fontSize = '18px';
            distanceTd.style.color = '#888';
            distanceTd.textContent = `(${distanceValue.toFixed(1)} km)`;
            shippingRow.appendChild(distanceTd);
        }
    }

    // Tính phí vận chuyển
    let shippingCost = 0;
    if (distanceValue <= INITIAL_DISTANCE) {
        shippingCost = productTotal >= FREE_SHIPPING_THRESHOLD ? 0 : BASE_SHIPPING_COST;
    } else {
        const additionalDistance = distanceValue - INITIAL_DISTANCE;
        const additionalChunks = Math.ceil(additionalDistance / 10);
        if (productTotal >= FREE_SHIPPING_THRESHOLD) {
            shippingCost = additionalChunks * COST_PER_10KM;
        } else {
            shippingCost = BASE_SHIPPING_COST + (additionalChunks * COST_PER_10KM);
        }
    }

    shippingCostEl.textContent = shippingCost.toLocaleString() + 'đ';

    // Update grand total
    const finalTotal = productTotal + shippingCost;
    const finalTotalEl = document.querySelector('.grand-total');
    if (finalTotalEl) {
        finalTotalEl.textContent = finalTotal.toLocaleString() + 'đ';
    }
    // Cập nhật hidden input cho form submit
    const shippingCostInput = document.getElementById('shipping-cost-input');
    if (shippingCostInput) {
        shippingCostInput.value = shippingCost;
    }
});