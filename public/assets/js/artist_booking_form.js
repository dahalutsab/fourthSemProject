document.addEventListener('DOMContentLoaded', function() {
    // don't allow past dates for event date
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('eventDate').setAttribute('min', today);



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
    document.getElementById('province').addEventListener('change', function () {
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
    document.getElementById('district').addEventListener('change', function () {
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
    document.getElementById('eventForm').addEventListener('submit', function (event) {
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

    // Handle save booking button click
    document.getElementById('proceedToPayment').addEventListener('click', function() {
        const path = window.location.pathname;
        const pathComponents = path.split('/');
        const performanceTypeId = pathComponents[pathComponents.length - 1];

        fetch(`/api/artistPerformance/book/${performanceTypeId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                province_id: document.getElementById('province').value,
                district_id: document.getElementById('district').value,
                municipality_id: document.getElementById('municipality').value,
                local_area: document.getElementById('localArea').value,
                event_date: document.getElementById('eventDate').value,
                event_start_time: document.getElementById('eventStartTime').value,
                event_end_time: document.getElementById('eventEndTime').value,
                total_cost: document.getElementById('totalCost').textContent,
                advance_amount: document.getElementById('advanceAmount').textContent,
                remaining_amount: document.getElementById('remainingAmount').textContent
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const bookingId = data.data.bookingId;

                    window.location = '/dashboard/payment/' + bookingId;
                } else {
                    toastr.error( data.error);
                    console.error('Failed to save booking:', data.message);
                }
            })
            .catch(error => console.error('Error saving booking:', error));
    });

});