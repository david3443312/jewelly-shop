document.addEventListener('DOMContentLoaded', function() {
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    
    // Hidden fields for text values
    var cityText = document.getElementById("city_text");
    var districtText = document.getElementById("district_text");
    var wardText = document.getElementById("ward_text");
    
    // Fetch the data from GitHub repository
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json", 
        method: "GET", 
        responseType: "application/json", 
    };
    
    axios(Parameter)
        .then(function (result) {
            renderCity(result.data);
        })
        .catch(function(error) {
            console.error("Error loading administrative data:", error);
        });
    
    function renderCity(data) {
        for (const x of data) {
            citis.options[citis.options.length] = new Option(x.Name, x.Id);
        }
        
        citis.onchange = function () {
            district.length = 1;
            ward.length = 1;
            
            // Store city text value
            if (cityText) {
                cityText.value = this.options[this.selectedIndex].text;
            }
            
            // Reset district and ward text values
            if (districtText) districtText.value = "";
            if (wardText) wardText.value = "";
            
            if(this.value != ""){
                const result = data.filter(n => n.Id === this.value);
                
                for (const k of result[0].Districts) {
                    district.options[district.options.length] = new Option(k.Name, k.Id);
                }
            }
            document.getElementById('city_text').value = this.options[this.selectedIndex].text;
        };
        
        district.onchange = function () {
            ward.length = 1;
            
            // Store district text value
            if (districtText) {
                districtText.value = this.options[this.selectedIndex].text;
            }
            
            // Reset ward text value
            if (wardText) wardText.value = "";
            
            const dataCity = data.filter((n) => n.Id === citis.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;
                
                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Id);
                }
            }
            document.getElementById('district_text').value = this.options[this.selectedIndex].text;
        };
        
        // Add ward.onchange handler
        wards.onchange = function() {
            // Store ward text value
            if (wardText) {
                wardText.value = this.options[this.selectedIndex].text;
            }
            document.getElementById('ward_text').value = this.options[this.selectedIndex].text;
        };
    }
    
    // Add event listener to the shipping-calculate button to get full address
    document.querySelector('.shipping-calculate').addEventListener('click', function(e) {
        e.preventDefault();
        
        // Check if all fields are selected
        if (!citis.value || !districts.value || !wards.value || !document.getElementById('specific-address').value) {
            alert("Vui lòng điền đầy đủ thông tin địa chỉ");
            return;
        }
        
        // Get selected values - use stored text values if available, otherwise use dropdown text
        const cityValue = (cityText && cityText.value) ? cityText.value : citis.options[citis.selectedIndex].text;
        const districtValue = (districtText && districtText.value) ? districtText.value : districts.options[districts.selectedIndex].text;
        const wardValue = (wardText && wardText.value) ? wardText.value : wards.options[wards.selectedIndex].text;
        const specificAddress = document.getElementById('specific-address').value;
        
        // Reference point
        const REFERENCE_POINT = "Mỗ Lao, Hà Đông, Hà Nội, Việt Nam";
        
        // Price threshold for free shipping (1 million VND)
        const FREE_SHIPPING_THRESHOLD = 1000000;
        
        // Base shipping cost for orders below threshold (within 20km)
        const BASE_SHIPPING_COST = 15000;
        
        // Additional cost per 10km beyond initial 20km
        const COST_PER_10KM = 10000;
        
        // Initial free distance range
        const INITIAL_DISTANCE = 20; // in kilometers
        
        // Get product total
        const productTotalEl = document.querySelector('.cart-totals .totals-table tr:first-child .value');
        let productTotal = 0;
        if (productTotalEl) {
            const productTotalText = productTotalEl.textContent;
            productTotal = parseInt(productTotalText.replace(/[^0-9]/g, '')) || 0;
        }
        
        // Full address for distance calculation
        const fullAddress = `${specificAddress}, ${wardValue}, ${districtValue}, ${cityValue}, Việt Nam`;
        
        // Update shipping cost input value for form submission
        const shippingCostEl = document.querySelector('.shipping-cost');
        const shippingCostInput = document.getElementById('shipping-cost-input');
        
        // Try to use Google Maps API if available
        if (typeof google !== 'undefined' && google.maps) {
            shippingCostEl.textContent = "Đang tính...";
            
            const service = new google.maps.DistanceMatrixService();
            service.getDistanceMatrix({
                origins: [REFERENCE_POINT],
                destinations: [fullAddress],
                travelMode: 'DRIVING',
                unitSystem: google.maps.UnitSystem.METRIC
            }, function(response, status) {
                let shippingCost = 0;
                let distanceValue = 0;
                
                if (status === 'OK' && response.rows[0].elements[0].status === 'OK') {
                    // Get distance value in meters and convert to km
                    distanceValue = response.rows[0].elements[0].distance.value / 1000;
                    
                    // Display the distance
                    const distanceEl = document.querySelector('.shipping-distance');
                    if (distanceEl) {
                        distanceEl.textContent = distanceValue.toFixed(1) + " km";
                    }
                    
                    // Calculate shipping based on distance and order total
                    if (distanceValue <= INITIAL_DISTANCE) {
                        // Within 20km
                        shippingCost = productTotal >= FREE_SHIPPING_THRESHOLD ? 0 : BASE_SHIPPING_COST;
                    } else {
                        // Beyond 20km
                        const additionalDistance = distanceValue - INITIAL_DISTANCE;
                        const additionalChunks = Math.ceil(additionalDistance / 10);
                        
                        if (productTotal >= FREE_SHIPPING_THRESHOLD) {
                            shippingCost = additionalChunks * COST_PER_10KM;
                        } else {
                            shippingCost = BASE_SHIPPING_COST + (additionalChunks * COST_PER_10KM);
                        }
                    }
                } else {
                    // Fallback if API fails
                    useFallbackShipping(cityValue, districtValue);
                }
                
                // Update shipping cost display and hidden input
                shippingCostEl.textContent = shippingCost.toLocaleString() + 'đ';
                if (shippingCostInput) {
                    shippingCostInput.value = shippingCost;
                }
                
                // Update grand total
                updateGrandTotal();
            });
        } else {
            // Fallback if Google Maps API not available
            useFallbackShipping(cityValue, districtValue);
        }
        
        function useFallbackShipping(cityValue, districtValue) {
            let shippingCost = 0;
            let estimatedDistance = 0;
            
            if (cityValue.includes("Hà Nội")) {
                if (districtValue.includes("Hà Đông")) {
                    estimatedDistance = 5; 
                    shippingCost = productTotal >= FREE_SHIPPING_THRESHOLD ? 0 : BASE_SHIPPING_COST;
                } else {
                    estimatedDistance = 15;
                    shippingCost = productTotal >= FREE_SHIPPING_THRESHOLD ? COST_PER_10KM : BASE_SHIPPING_COST + COST_PER_10KM;
                }
            } else {
                estimatedDistance = 50; 
                shippingCost = productTotal >= FREE_SHIPPING_THRESHOLD ? COST_PER_10KM * 3 : BASE_SHIPPING_COST + (COST_PER_10KM * 3);
            }
            
            // Display the estimated distance
            const distanceEl = document.querySelector('.shipping-distance');
            if (distanceEl) {
                distanceEl.textContent = `~${estimatedDistance} km (ước tính)`;
            }
            
            // Update shipping cost display and hidden input
            shippingCostEl.textContent = shippingCost.toLocaleString() + 'đ';
            if (shippingCostInput) {
                shippingCostInput.value = shippingCost;
            }
            
            // Update grand total
            updateGrandTotal();
        }
    });
});