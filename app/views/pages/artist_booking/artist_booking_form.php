<div class="container mt-5">
    <form id="eventForm">
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
            <label for="eventTime" class="form-label">Event Time</label>
            <input type="time" class="form-control" id="eventTime" name="eventTime" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
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
                        option.value = province.id;
                        option.textContent = province.name;
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
            fetch(`/api/getDistricts?provinceId=${provinceId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const districts = data.data;
                        const districtSelect = document.getElementById('district');
                        districtSelect.innerHTML = '<option value="" disabled selected>Select your district</option>'; // Clear existing options
                        districts.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.id;
                            option.textContent = district.name;
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
            fetch(`/api/getMunicipalities?districtId=${districtId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const municipalities = data.data;
                        const municipalitySelect = document.getElementById('municipality');
                        municipalitySelect.innerHTML = '<option value="" disabled selected>Select your municipality</option>'; // Clear existing options
                        municipalities.forEach(municipality => {
                            const option = document.createElement('option');
                            option.value = municipality.id;
                            option.textContent = municipality.name;
                            municipalitySelect.appendChild(option);
                        });
                    } else {
                        console.error('Failed to fetch municipalities:', data.message);
                    }
                })
                .catch(error => console.error('Error fetching municipalities:', error));
        });
    });
</script>
