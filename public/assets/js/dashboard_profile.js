let role;
document.addEventListener('DOMContentLoaded', function() {
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
                console.log('User details:', userDetails);

                if (role === 2) {
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

                    fetch('/api/artistDetails/getUserDetails')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data && data.success) {
                                populateArtistDetails(data.data);
                            } else {
                                console.error('Unexpected response format:', data);
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching artist details:', error);
                        });
                } else {
                    document.querySelectorAll('.artist-specific').forEach(element => {
                        element.style.display = 'none';
                    });
                    fetch('/api/userDetails/getUserDetails')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data && data.success) {
                                populateUserDetails(data.data);
                            } else {
                                console.error('Unexpected response format:', data);
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching user details:', error);
                        });
                }
            }
        })
        .catch(error => {
            console.error('There was a problem fetching user details:', error);
        });

    function populateCategoriesDropdown(categories) {
        const categorySelect = document.getElementById('category');

        categories.forEach((category, index) => {
            const option = document.createElement('option');
            option.value = category.id;
            option.textContent = category.name;
            // Set the first category as the default selected option
            if (index === 0) {
                option.selected = true;
            }
            categorySelect.appendChild(option);
        });
    }

    function populateArtistDetails(details) {
        populateArtistOverview(details);
        populateArtistEditProfile(details);
    }

    function populateUserDetails(details) {
        populateOverview(details);
        populateEditProfile(details);
    }

    function populateArtistOverview(profileDetails) {
        document.getElementById('dashboard-user-image').src = profileDetails.profilePicture || '/assets/images/default-profile.png';
        document.getElementById('full_name').textContent = profileDetails.fullName || '';
        document.getElementById('stage_name').textContent = profileDetails.stageName || '';
        document.getElementById('phone').textContent = profileDetails.phone || '';
        document.getElementById('address').textContent = profileDetails.address || '';
        document.getElementById('categoryName').textContent = profileDetails.category || '';
        document.getElementById('bio').textContent = profileDetails.bio || '';
        document.getElementById('description').textContent = profileDetails.description || '';

        fetch(`/api/categories/getCategoryById?id=${profileDetails.category}`)
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

    function populateArtistEditProfile(profileDetails) {
        document.getElementById('full_name_edit').value = profileDetails.fullName || '';
        document.getElementById('stage_name_edit').value = profileDetails.stageName || '';
        document.getElementById('phone_edit').value = profileDetails.phone || '';
        document.getElementById('address_edit').value = profileDetails.address || '';
        document.getElementById('category').value = profileDetails.category || '';
        document.getElementById('bio_edit').value = profileDetails.bio || '';
        document.getElementById('description_edit').value = profileDetails.description || '';
    }

    function populateOverview(profileDetails) {
        document.getElementById('dashboard-user-image').src = profileDetails.profilePicture || '/assets/images/default-profile.png';
        document.getElementById('full_name').textContent = profileDetails.fullName || '';
        document.getElementById('phone').textContent = profileDetails.phone || '';
        document.getElementById('address').textContent = profileDetails.address || '';
        document.getElementById('bio').textContent = profileDetails.bio || '';
    }

    function populateEditProfile(profileDetails) {
        document.getElementById('full_name_edit').value = profileDetails.fullName || '';
        document.getElementById('phone_edit').value = profileDetails.phone || '';
        document.getElementById('address_edit').value = profileDetails.address || '';
        document.getElementById('bio_edit').value = profileDetails.bio || '';
    }

    // Event listener for form submission (registrationForm)
    const registrationForm = document.getElementById('registrationForm');
    registrationForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        let apiUrl;
        if (role === 2) {
            apiUrl = '/api/artistDetails/updateProfile';
        } else {
            apiUrl = '/api/userDetails/updateProfile';
        }
        // console.log('Form data:', formData.forEach((value, key) => console.log(key, value)));

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
                reloadOverviewTab();
            })
            .catch(error => {
                console.error('Error updating profile:', error);
            });
    });

    // event listener for image uploads
    const imageUploadForm = document.getElementById('imageUploadForm');
        imageUploadForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        let apiUrl;
        if (role === 2) {
            apiUrl = '/api/artistDetails/updateProfilePicture';
        } else {
            apiUrl = '/api/userDetails/updateProfilePicture';
        }
        console.log('Form data:', formData);
        console.log('API URL:', apiUrl);
        console.log('Role:', role);

        fetch(apiUrl, {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to uploads image');
                }
                return response.json();
            })
            .then(data => {
                reloadOverviewTab();
            })
            .catch(error => {
                console.error('Error uploading image:', error);
            });
    });


    function reloadOverviewTab() {
        const overviewTab = document.getElementById('home-tab');
        overviewTab.click();
        let apiUrl;
        if (role === 2) {
            apiUrl = '/api/artistDetails/getUserDetails';
        } else {
            apiUrl = '/api/userDetails/getUserDetails';
        }

        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    if (role === 2) {
                        populateArtistDetails(data.data);
                    } else {
                        populateUserDetails(data.data);
                    }
                } else {
                    console.error('Unexpected response format:', data);
                }
            })
            .catch(error => {
                console.error('Error fetching user details:', error);
            });
    }
});
