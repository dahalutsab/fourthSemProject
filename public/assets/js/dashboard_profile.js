document.addEventListener('DOMContentLoaded', function() {
    // Fetch categories and populate dropdown
    fetch('/api/categories/getAllCategories')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data && data.success) {
                populateCategoriesDropdown(data.data);
            } else {
                console.error('Unexpected response format:', data);
            }
        })
        .catch(error => {
            console.error('Error fetching categories:', error);
        });

    // Fetch user profile details
    fetch('/api/userDetails/getUserDetails')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => { // Here, 'data' should contain the response object
            if (data && data.success) { // Check for both 'data' and 'success' property
                populateUserProfile(data.data); // Access 'data' property of the response
            } else {
                console.error('Unexpected response format:', data);
                // Handle unexpected response format (optional)
            }
        })
        .catch(error => {
            console.error('There was a problem fetching user profile details:', error);
            // If there is an error, populate all fields with "N/A"
            populateUserProfile({
                fullName: 'N/A',
                stageName: 'N/A',
                phone: 'N/A',
                address: 'N/A',
                category: 'N/A',
                bio: 'N/A',
                description: 'N/A'
            });
        });



    function populateCategoriesDropdown(categories) {
        const categorySelect = document.getElementById('category');

        // Iterate over the categories and create an option for each one
        categories.forEach(category => {
            const option = document.createElement('option');
            option.value = category.id;
            option.textContent = category.name;
            categorySelect.appendChild(option);
        });
    }

    // Function to populate user profile details into HTML for the Overview tab
    function populateOverview(profileDetails) {
        document.getElementById('full_name').textContent = profileDetails.fullName || '';
        document.getElementById('stage_name').textContent = profileDetails.stageName || '';
        document.getElementById('phone').textContent = profileDetails.phone || '';
        document.getElementById('address').textContent = profileDetails.address || '';
        document.getElementById('categoryName').textContent = profileDetails.category || '';
        document.getElementById('bio').textContent = profileDetails.bio || '';
        document.getElementById('description').textContent = profileDetails.description || '';

        // Fetch category name based on category ID
        fetch(`/api/categories/getCategoryById?id=${profileDetails.category}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    document.getElementById('categoryName').textContent = data.data.name || 'N/A'; // Update the category name
                } else {
                    console.error('Unexpected response format:', data);
                }
            })
            .catch(error => {
                console.error('Error fetching category name:', error);
            });
    }

    // Function to populate user profile details into HTML for the Edit Profile tab
    function populateEditProfile(profileDetails) {
        document.getElementById('full_name_edit').value = profileDetails.fullName ? profileDetails.fullName : ''; // Use an empty string as a placeholder
        document.getElementById('stage_name_edit').value = profileDetails.stageName ? profileDetails.stageName : ''; // Use an empty string as a placeholder
        document.getElementById('phone_edit').value = profileDetails.phone ? profileDetails.phone : '';
        document.getElementById('address_edit').value = profileDetails.address ? profileDetails.address : '';
        document.getElementById('category').value = profileDetails.category ? profileDetails.category : '';
        document.getElementById('bio_edit').value = profileDetails.bio ? profileDetails.bio : '';
        document.getElementById('description_edit').value = profileDetails.description ? profileDetails.description : '';
    }


    // Add event listener to the registration form
    const registrationForm = document.getElementById('registrationForm');

    registrationForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(this);

        fetch('/api/userDetails/updateProfile', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to update profile');
                }
                return response.json();
            })
            .then(data => {
                reloadOverviewTab();
            })
            .catch(error => {
                console.error('Error updating profile:', error);
            });
    });

    // Function to reload the overview tab
    function reloadOverviewTab() {
        // Simulate click on the overview tab to reload it with updated data
        const overviewTab = document.getElementById('home-tab');
        overviewTab.click();
    }

    // Populate the details on both tabs
    function populateUserProfile(profileDetails) {
        populateOverview(profileDetails);
        populateEditProfile(profileDetails);
    }
});