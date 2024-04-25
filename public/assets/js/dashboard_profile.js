let role;
let overviewDataCache = null;

document.addEventListener('DOMContentLoaded', function() {

    toastr.success('Welcome to your dashboard!');
    fetchUserDetail();
});

function fetchUserDetail() {
    fetch('/api/user/get-user')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data && data.success) {
                const userDetails = data.data;
                role = userDetails.role;

                if (role === 2) {
                    fetchCategories();
                    fetchArtistDetails();
                } else {
                    hideArtistSpecificElements();
                    fetchUserDetails();
                }
            }
        })
        .catch(error => {
            console.error('There was a problem fetching user details:', error);
        });
}

function fetchCategories() {
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
}

function fetchArtistDetails() {
    fetch('/api/artistDetails/getUserDetails')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data && data.success) {
                overviewDataCache = data.data;
                populateArtistDetails(data.data);
            } else {
                console.error('Unexpected response format:', data);
            }
        })
        .catch(error => {
            console.error('Error fetching artist details:', error);
        });
}

function fetchUserDetails() {
    fetch('/api/userDetails/getUserDetails')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data && data.success) {
                overviewDataCache = data.data;
                populateUserDetails(data.data);
            } else {
                console.error('Unexpected response format:', data);
            }
        })
        .catch(error => {
            console.error('Error fetching user details:', error);
        });
}

function hideArtistSpecificElements() {
    document.querySelectorAll('.artist-specific').forEach(element => {
        element.style.display = 'none';
    });
}

function populateCategoriesDropdown(categories) {
    const categorySelect = document.getElementById('category');
    categorySelect.innerHTML = ''; // Clear existing options

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = 'Select your category';
    categorySelect.appendChild(defaultOption);

    categories.forEach(category => {
        const option = document.createElement('option');
        option.value = category.id;
        option.textContent = category.name;
        categorySelect.appendChild(option);
    });
}

function populateArtistDetails(details) {
    populateOverview(details);
    populateEditProfile(details, true);
}

function populateUserDetails(details) {
    populateOverview(details);
    populateEditProfile(details, false);
}

function populateOverview(profileDetails) {
    document.getElementById('dashboard-user-image').src = profileDetails.profilePicture || '/assets/images/default-profile.png';
    document.getElementById('full_name').textContent = profileDetails.fullName || '';
    document.getElementById('stage_name').textContent = profileDetails.stageName || '';
    document.getElementById('phone').textContent = profileDetails.phone || '';
    document.getElementById('address').textContent = profileDetails.address || '';
    document.getElementById('categoryName').textContent = profileDetails.category || '';
    document.getElementById('bio').textContent = profileDetails.bio || '';
    document.getElementById('description').textContent = profileDetails.description || '';

    if (profileDetails.category) {
        fetchCategoryById(profileDetails.category);
    }
}

function populateEditProfile(profileDetails, isArtist) {
    document.getElementById('full_name_edit').value = profileDetails.fullName || '';
    document.getElementById('stage_name_edit').value = profileDetails.stageName || '';
    document.getElementById('phone_edit').value = profileDetails.phone || '';
    document.getElementById('address_edit').value = profileDetails.address || '';
    document.getElementById('category').value = profileDetails.category || '';
    document.getElementById('bio_edit').value = profileDetails.bio || '';
    document.getElementById('description_edit').value = profileDetails.description || '';

    document.querySelectorAll('.artist-specific').forEach(element => {
        element.style.display = isArtist ? 'block' : 'none';
    });
}

function fetchCategoryById(categoryId) {
    fetch(`/api/categories/getCategoryById?id=${categoryId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data && data.success) {
                document.getElementById('categoryName').textContent = data.data.name || 'N/A';
            } else {
                console.error('Unexpected response format:', data);
            }
        })
        .catch(error => {
            console.error('Error fetching category name:', error);
        });
}

const registrationForm = document.getElementById('registrationForm');
registrationForm.addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    let apiUrl = role === 2 ? '/api/artistDetails/updateProfile' : '/api/userDetails/updateProfile';

    fetch(apiUrl, {
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
            console.log(data);
            if (data && data.success) {
                toastr.success(data.message.message);
                fetchUserDetail(); // Re-fetch user details to update overview tab
                document.getElementById('home-tab').click(); // Trigger click event on overview tab button
            } else {
                toastr.error(data.message.error);
                console.error('Unexpected response format:', data);
            }
        })
        .catch(error => {
            console.error('Error updating profile:', error);
        });
});

const imageUploadForm = document.getElementById('imageUploadForm');
imageUploadForm.addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    let apiUrl = role === 2 ? '/api/artistDetails/updateProfilePicture' : '/api/userDetails/updateProfilePicture';

    fetch(apiUrl, {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to upload image');
            }
            return response.json();
        })
        .then(data => {
            if (data && data.success) {
                toastr.success(data.data.message)
                fetchUserDetail();
            } else {
                toastr.error(data.message.error)
                console.error('Unexpected response format:', data);
            }
        })
        .catch(error => {
            console.error('Error uploading image:', error);
        });
});
