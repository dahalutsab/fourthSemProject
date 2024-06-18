<style>
    .social-icon {
        margin-right: 8px;
    }
    .input-group {
        margin-bottom: 15px;
    }
</style>
<hr>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-10"><h1>User Profile</h1></div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="text-center">
                <form id="imageUploadForm" enctype="multipart/form-data">
                    <img src="<?=BASE_IMAGE_PATH?>default-profile.png" class="avatar img-circle img-thumbnail" id="dashboard-user-image" alt="avatar">
                    <h6>Upload a different photo...</h6>
                    <input type="file" class=" btn-success" name="profile_picture" id="profile_picture" alt="">
                    <button class="btn btn-success" type="submit"><i class="fas fa-upload me-2"></i>Upload</button>
                </form>
            </div>
            <hr>
            <div class="card">
                <div class="card-header">Social Media</div>
                <div class="card-body">
                    <form id="socialMediaForm">
                        <!-- Dynamic input fields will be appended here -->
                        <button type="submit" id="save-social-media" class="btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                        <i class="fas fa-user me-2"></i>Overview
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                        <i class="fas fa-key me-2"></i>Change Password
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <hr>
                    <div class="card">
                        <div class="card-header">
                            Profile Details
                        </div>
                        <div class="card-body">
                            <!-- Full Name -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Full Name:</strong>
                                </div>
                                <div class="col-sm-9" id="full_name"></div> <!-- Placeholder for full name -->
                            </div>
                            <!-- Stage Name -->
                            <div class="row mb-3 artist-specific">
                                <div class="col-sm-3">
                                    <strong>Stage Name:</strong>
                                </div>
                                <div class="col-sm-9" id="stage_name"></div> <!-- Placeholder for stage name -->
                            </div>
                            <!-- Phone -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Phone:</strong>
                                </div>
                                <div class="col-sm-9" id="phone"></div> <!-- Placeholder for phone -->
                            </div>
                            <!-- Address -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Address:</strong>
                                </div>
                                <div class="col-sm-9" id="address"></div> <!-- Placeholder for address -->
                            </div>

                            <!-- Address -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Gender:</strong>
                                </div>
                                <div class="col-sm-9" id="gender"></div> <!-- Placeholder for gender -->
                            </div>
                            <!-- Category -->
                            <div class="row mb-3 artist-specific">
                                <div class="col-sm-3">
                                    <strong>Category:</strong>
                                </div>
                                <div class="col-sm-9" id="categoryName"></div> <!-- Placeholder for category -->
                            </div>
                            <!-- Bio -->
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <strong>Bio:</strong>
                                </div>
                                <div class="col-sm-9" id="bio"></div> <!-- Placeholder for bio -->
                            </div>
<!--                            <-- Description -->
                            <div class="row mb-3 artist-specific">
                                <div class="col-sm-3">
                                    <strong>Description:</strong>
                                </div>
                                <div class="col-sm-9" id="description"></div> <!-- Placeholder for description -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <hr>
                    <!-- Edit Profile Content -->
                    <form class="form" id="registrationForm">
                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="full_name" id="full_name_edit" placeholder="Enter your full name" title="Enter your full name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-12 artist-specific">
                                <label for="stage_name" class="form-label">Stage Name</label>
                                <input type="text" class="form-control" name="stage_name" id="stage_name_edit" placeholder="Enter your stage name" title="Enter your stage name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone_edit" placeholder="Enter your phone number" title="Enter your phone number">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="address_edit" placeholder="Enter your address" title="Enter your address">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <label class="form-label">Gender</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                                    <label class="form-check-label" for="other">Other</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 artist-specific">
                            <div class="col-xs-12">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" name="category" id="category">
                                    <option value="">Select your category</option>
                                </select>
                            </div>
                        </div> <!-- Close the row div -->

                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <label for="bio_edit" class="form-label">Bio</label>
                                <textarea class="form-control" name="bio" id="bio_edit" rows="3" placeholder="Enter your bio"></textarea>
                            </div>
                            <div class="row mb-3 artist-specific">
                                <div class="col-xs-12">
                                    <label for="description_edit" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="description_edit" rows="5" placeholder="Enter your description"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xs-12">
                                    <button class="btn btn-success" type="submit"><i class="fas fa-check-circle me-2"></i>Save</button>
                                    <button class="btn btn-secondary" type="reset"><i class="fas fa-undo me-2"></i>Reset</button>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <hr>
                    <!-- Change Password Content -->
                    <form class="form" id="changePasswordForm">
                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Enter your current password" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter your new password" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <label for="confirm_password" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm your new password" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <button class="btn btn-success" type="submit"><i class="fas fa-check-circle me-2"></i>Change Password</button>
                                <button class="btn btn-secondary" type="reset"><i class="fas fa-undo me-2"></i>Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=BASE_JS_PATH?>dashboard_profile.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('socialMediaForm');
        let platformMap = {};
        fetchSocialMediaPlatforms();

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            // Check if platformMap is populated
            if (Object.keys(platformMap).length > 0) {
                const data = collectFormData(platformMap);
                saveSocialMediaLinks(data);
            } else {
                console.error('PlatformMap is empty or not populated yet.');
            }
        });

        function fetchSocialMediaPlatforms() {
            fetch('/api/social-media-links/get-all-social-media-platforms')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        platformMap = createPlatformMap(data.data);
                        renderInputFields(data.data);
                    } else {
                        console.error('Error fetching social media platforms:', data.message);
                    }
                })
                .catch(error => console.error('Error fetching social media platforms:', error));
        }

        function createPlatformMap(platforms) {
            const map = {};
            platforms.forEach(platform => {
                map[platform.platform_name.toLowerCase()] = platform.platform_id;
            });
            return map;
        }

        function renderInputFields(platforms) {
            const form = document.getElementById('socialMediaForm');
            platforms.forEach(platform => {
                const inputGroup = document.createElement('div');
                inputGroup.classList.add('input-group');

                const icon = document.createElement('i');
                icon.className = `${platform.icon_class} social-icon`;

                const input = document.createElement('input');
                input.type = 'text';
                input.name = platform.platform_name.toLowerCase(); // Convert platform name to lowercase
                input.placeholder = `${platform.platform_name} link`;
                input.classList.add('form-control');

                inputGroup.appendChild(icon);
                inputGroup.appendChild(input);
                form.insertBefore(inputGroup, form.lastElementChild);
            });
            fetchArtistSocialMediaLinks();
        }

        function collectFormData(platformMap) {
            const form = document.getElementById('socialMediaForm');
            const formData = new FormData(form);
            const socialMedia = [];

            // Iterate through keys in platformMap
            for (let key in platformMap) {
                if (platformMap.hasOwnProperty(key)) {
                    const value = formData.get(key);
                    if (value.trim() !== '') {
                        const platformId = platformMap[key];
                        socialMedia.push({
                            platform_id: platformId,
                            handle: key,
                            url: value
                        });
                    }
                }
            }

            if (socialMedia.length === 0) {
                console.log('No social media data collected. Check the form inputs and the platformMap:', platformMap);
            }

            return {
                artist_id: <?= $_SESSION[SESSION_USER_ID] ?>,
                social_media: socialMedia
            };
        }

        function saveSocialMediaLinks(data) {
            fetch('/api/artist/save-social-media', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ social_media_links: data.social_media })
            })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        toastr.success('Social media profiles saved successfully');
                        fetchArtistSocialMediaLinks();
                    } else {
                        console.error('Error saving social media profiles:', result.message);
                        alert('An error occurred while saving social media profiles');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while saving social media profiles');
                });
        }

        function fetchArtistSocialMediaLinks() {
            fetch('/api/artist/get-social-media-links')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        populateSocialMediaLinks(data.data);
                    } else {
                        console.error('Error fetching social media links:', data.message);
                    }
                })
                .catch(error => console.error('Error fetching social media links:', error));
        }

        function populateSocialMediaLinks(links) {
            const form = document.getElementById('socialMediaForm');

            links.forEach(link => {
                const platformName = link.platform.toLowerCase(); // Convert platform name to lowercase for input field name
                const url = link.url;

                setFieldValue(platformName, url);
            });

            function setFieldValue(platformName, url) {
                const inputField = form.querySelector(`input[name="${platformName}"]`);
                if (inputField) {
                    inputField.value = url;
                } else {
                    console.error(`Input field for ${platformName} not found.`);
                }
            }
        }

    });

</script>
