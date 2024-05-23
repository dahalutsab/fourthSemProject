document.addEventListener('DOMContentLoaded', function() {
    // Fetch provinces from backend and populate the province dropdown
    fetch('/api/getProvinces')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const provinces = data.data;
                const provinceSelect = document.getElementById('province');
                provinces.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.province_id;
                    option.textContent = province.province_name;
                    provinceSelect.appendChild(option);
                });
            } else {
                console.error('Failed to fetch provinces:', data.message);
            }
        })
        .catch(error => console.error('Error fetching provinces:', error));

    // Fetch districts based on selected province
    document.getElementById('province').addEventListener('change', function() {
        const provinceId = this.value;
        fetch(`/api/getDistricts/${provinceId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const districts = data.data;
                    const districtSelect = document.getElementById('district');
                    districtSelect.innerHTML = '<option value="" disabled selected>Select your district</option>'; // Clear existing options
                    districts.forEach(district => {
                        const option = document.createElement('option');
                        option.value = district.district_id;
                        option.textContent = district.district_name;
                        districtSelect.appendChild(option);
                    });
                } else {
                    console.error('Failed to fetch districts:', data.message);
                }
            })
            .catch(error => console.error('Error fetching districts:', error));
    });

    // Fetch municipalities based on selected district
    document.getElementById('district').addEventListener('change', function() {
        const districtId = this.value;
        fetch(`/api/getMunicipalities/${districtId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const municipalities = data.data;
                    const municipalitySelect = document.getElementById('municipality');
                    municipalitySelect.innerHTML = '<option value="" disabled selected>Select your municipality</option>'; // Clear existing options
                    municipalities.forEach(municipality => {
                        const option = document.createElement('option');
                        option.value = municipality.municipality_id;
                        option.textContent = municipality.municipality_name;
                        municipalitySelect.appendChild(option);
                    });
                } else {
                    console.error('Failed to fetch municipalities:', data.message);
                }
            })
            .catch(error => console.error('Error fetching municipalities:', error));
    });

    // Handle form submission
    document.getElementById('eventForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const path = window.location.pathname;
        const pathComponents = path.split('/');
        const performanceTypeId = pathComponents[pathComponents.length - 1];

        fetch(`/api/artistPerformance/calculate-cost/${performanceTypeId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                province: document.getElementById('province').value,
                district: document.getElementById('district').value,
                municipality: document.getElementById('municipality').value,
                localArea: document.getElementById('localArea').value,
                eventDate: document.getElementById('eventDate').value,
                eventStartTime: document.getElementById('eventStartTime').value,
                eventEndTime: document.getElementById('eventEndTime').value
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('totalCost').textContent = data.data.totalCost;
                    document.getElementById('advanceAmount').textContent = data.data.advanceAmount;
                    document.getElementById('remainingAmount').textContent = data.data.remainingAmount;

                    // Show the modal
                    var costModal = new bootstrap.Modal(document.getElementById('costModal'));
                    costModal.show();
                } else {
                    console.error('Failed to calculate cost:', data.message);
                }
            })
            .catch(error => console.error('Error calculating cost:', error));
    });

    // Handle Proceed to Payment button click
    document.getElementById('proceedToPayment').addEventListener('click', function() {
        const amount = document.getElementById('advanceAmount').textContent;
        const tax_amount = 0;
        let total_amount = parseFloat(amount) + tax_amount;
        total_amount = total_amount.toFixed(0);
        const transaction_uuid = generateUniqueTransactionUuid();
        const product_code = 'EPAYTEST';
        const product_service_charge = 0;
        const product_delivery_charge = 0;
        const success_url = 'http://openmichub.com/dashboard/payment/success';
        const failure_url = 'http://openmichub.com/dashboard/payment/failure';
        const signed_field_names = "total_amount,transaction_uuid,product_code";


        fetch('/api/generate-signature', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                // total_amount=100,transaction_uuid=11-201-13,product_code=EPAYTEST
                message: `total_amount=${total_amount},transaction_uuid=${transaction_uuid},product_code=${product_code}`
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const signature = data.data;
                    console.log('Signature:', signature);

                    // Create a form dynamically
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'https://rc-epay.esewa.com.np/api/epay/main/v2/form';

                    // Enclose fields object within curly braces
                    const fields = {
                        tax_amount: tax_amount,
                        total_amount: total_amount,
                        amount: total_amount,
                        transaction_uuid: transaction_uuid,
                        product_code: product_code,
                        product_service_charge: product_service_charge,
                        product_delivery_charge: product_delivery_charge,
                        success_url: success_url,
                        failure_url: failure_url,
                        signed_field_names: signed_field_names,
                        signature: signature
                    };

                    // Loop through fields object and create hidden input fields
                    for (const [key, value] of Object.entries(fields)) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = key;
                        input.value = value;
                        form.appendChild(input);
                    }

                    // Append the form to the body and submit it
                    document.body.appendChild(form);
                    form.submit();
                }

                else {
                    console.error('Failed to generate signature:', data.message);
                }
            })
            .catch(error => console.error('Error generating signature:', error));
    });

    function generateUniqueTransactionUuid() {
        return 'openmichub' + Math.random().toString(36).substr(2, 9).toUpperCase();
    }
});