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

        <button type="submit" class="btn calculate-cost btn-primary">Calculate Cost</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

            console.log('Performance Type ID:', performanceTypeId);

            fetch(`/api/artistPerformance/calculate-cost/${performanceTypeId}, {
                body: new FormData(this)`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Cost: NPR ${data.data.cost}`);
                    } else {
                        console.error('Failed to calculate cost:', data.message);
                    }
                })
                .catch(error => console.error('Error calculating cost:', error));
        });
    });

</script>
