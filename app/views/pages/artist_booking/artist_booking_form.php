<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <form method="post" id="eventForm">
        <div class="mb-3">
            <label for="province" class="form-label">Province</label>
            <select class="form-select" id="province" name="province" required>
                <option value="" disabled selected>Select your province</option>
                <!-- Options will be populated dynamically -->
            </select>
        </div>

        <div class="mb-3">
            <label for="district" class="form-label">District</label>
            <select class="form-select" id="district" name="district" required>
                <option value="" disabled selected>Select your district</option>
                <!-- Options will be populated dynamically -->
            </select>
        </div>

        <div class="mb-3">
            <label for="municipality" class="form-label">Municipality</label>
            <select class="form-select" id="municipality" name="municipality" required>
                <option value="" disabled selected>Select your municipality</option>
                <!-- Options will be populated dynamically -->
            </select>
        </div>

        <div class="mb-3">
            <label for="localArea" class="form-label">Tole/Local Area</label>
            <input type="text" class="form-control" id="localArea" name="localArea" required>
        </div>

        <div class="mb-3">
            <label for="eventDate" class="form-label">Event Date</label>
            <input type="date" class="form-control" id="eventDate" name="eventDate" required>
        </div>

        <div class="mb-3">
            <label for="eventStartTime" class="form-label">Event Start Time</label>
            <input type="time" class="form-control" id="eventStartTime" name="eventStartTime" required>
        </div>

        <div class="mb-3">
            <label for="eventEndTime" class="form-label">Event End Time</label>
            <input type="time" class="form-control" id="eventEndTime" name="eventEndTime" required>
        </div>

        <button type="submit" class="btn calculate-cost btn-primary">Calculate Cost</button>
    </form>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="costModal" tabindex="-1" aria-labelledby="costModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="costModalLabel">Cost Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Total Cost: NPR <span id="totalCost"></span></p>
                <p>Advance Amount: NPR <span id="advanceAmount"></span></p>
                <p>Remaining Amount: NPR <span id="remainingAmount"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="proceedToPayment">Proceed to Payment</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
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

            // Sample data for eSewa integration (use actual data in production)
            const paymentData = {
                amount: amount,
                failure_url: 'https://google.com',
                product_delivery_charge: '0',
                product_service_charge: '0',
                product_code: 'EPAYTEST',
                signature: 'YVweM7CgAtZW5tRKica/BIeYFvpSj09AaInsulqNKHk=',
                signed_field_names: 'total_amount,transaction_uuid,product_code',
                success_url: 'openmichub.com',
                tax_amount: '10',
                total_amount: parseFloat(amount) + 10,
                transaction_uuid: 'ab14a8f2b02c3' // Replace with actual unique transaction ID
            };

            // Create a form element
            const form = document.createElement('form');
            form.action = 'https://uat.esewa.com.np/epay/main'; // Use appropriate URL for production
            form.method = 'POST';
            form.style.display = 'none';


            for (const key in paymentData) {
                if (paymentData.hasOwnProperty(key)) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = paymentData[key];
                    form.appendChild(input);
                }
            }

            // Append the form to the body and submit
            document.body.appendChild(form);
            form.submit();
        });

    });
</script>
</body>
</html>
