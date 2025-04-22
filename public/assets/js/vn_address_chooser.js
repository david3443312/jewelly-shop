document.addEventListener('DOMContentLoaded', function() {
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    
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
            if(this.value != ""){
                const result = data.filter(n => n.Id === this.value);
                
                for (const k of result[0].Districts) {
                    district.options[district.options.length] = new Option(k.Name, k.Id);
                }
            }
        };
        
        district.onchange = function () {
            ward.length = 1;
            const dataCity = data.filter((n) => n.Id === citis.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;
                
                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Id);
                }
            }
        };
    }
    
    // Add event listener to the shipping-calculate button to get full address
    document.querySelector('.shipping-calculate').addEventListener('click', function(e) {
        e.preventDefault();
        
        // Get selected values
        const cityText = citis.options[citis.selectedIndex].text;
        const districtText = districts.options[districts.selectedIndex].text;
        const wardText = wards.options[wards.selectedIndex].text;
        const specificAddress = document.getElementById('specific-address').value;
        
        // Calculate shipping based on location
        let shippingCost = 0;
        
        // Example shipping logic
        if (cityText.includes("Hà Nội") || cityText.includes("Hồ Chí Minh")) {
            shippingCost = 30000;
        } else {
            shippingCost = 50000;
        }
        
        // Update shipping cost display
        document.querySelector('.shipping-cost').textContent = shippingCost.toLocaleString() + 'đ';
        
        // Recalculate grand total
        updateGrandTotal();
    });
});