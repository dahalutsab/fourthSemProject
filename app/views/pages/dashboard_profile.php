<?php


use App\repository\implementation\CategoryRepository;

$categoriesRepo = new CategoryRepository();
$categories = $categoriesRepo->getAllCategories();

// Check if there are any errors
$errors = $_SESSION['signup_errors'] ?? [];
unset($_SESSION['signup_errors']); // Clear errors from session
?>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-10"><h1>User Profile</h1></div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="text-center">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar rounded-circle img-thumbnail" alt="avatar">
                <h6>Upload a different photo...</h6>
                <input type="file" class="text-center form-control file-upload">
            </div>
            <hr>
            <div class="card">
                <div class="card-header">Social Media</div>
                <div class="card-body">
                    <i class="fab fa-facebook me-2"></i>
                    <i class="fab fa-github me-2"></i>
                    <i class="fab fa-twitter me-2"></i>
                    <i class="fab fa-pinterest me-2"></i>
                    <i class="fab fa-google"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-user me-2"></i>Overview</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-edit me-2"></i>Edit Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-key me-2"></i>Change Password</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <hr>
                    <!-- Overview Content -->
                    <div class="card">
                        <div class="card-header">
                            Profile Details
                        </div>
                        <div class="card-body">
                            <?php if ($userProfile !== null) : ?>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <strong>Full Name:</strong>
                                    </div>
                                    <div class="col-sm-9">
                                        <?= $userProfile->getFullName() !== null ? $userProfile->getFullName() : 'N/A' ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <strong>Stage Name:</strong>
                                    </div>
                                    <div class="col-sm-9">
                                        <?= $userProfile->getStageName() !== null ? $userProfile->getStageName() : 'N/A' ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <strong>Phone:</strong>
                                    </div>
                                    <div class="col-sm-9">
                                        <?= $userProfile->getPhone() !== null ? $userProfile->getPhone() : 'N/A' ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <strong>Address:</strong>
                                    </div>
                                    <div class="col-sm-9">
                                        <?= $userProfile->getAddress() !== null ? $userProfile->getAddress() : 'N/A' ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <strong>Talent Type:</strong>
                                    </div>
                                    <div class="col-sm-9">
                                        <?= $userProfile->getCategoryID() !== null ? $userProfile->getCategoryID() : 'N/A' ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <strong>Bio:</strong>
                                    </div>
                                    <div class="col-sm-9">
                                        <?= $userProfile->getBio() !== null ? $userProfile->getBio() : 'N/A' ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <strong>Description:</strong>
                                    </div>
                                    <div class="col-sm-9">
                                        <?= $userProfile->getDescription() !== null ? $userProfile->getDescription() : 'N/A' ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <p>User profile not found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <hr>
                    <!-- Edit Profile Content -->
                    <form class="form" action="/edit-profile" method="post" id="registrationForm">
                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="fullName" id="full_name" placeholder="Enter your full name" title="Enter your full name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <label for="stage_name" class="form-label">Stage Name</label>
                                <input type="text" class="form-control" name="stageName" id="stage_name" placeholder="Enter your stage name" title="Enter your stage name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" title="Enter your phone number">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Enter your address" title="Enter your address">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="row mb-3">
                                <div class="col-xs-12">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select" name="categoryID" id="category">
                                        <option value="">Select your category</option>
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" name="bio" id="bio" rows="3" placeholder="Enter your bio"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xs-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter your description"></textarea>
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
                    <form class="form" action="##" method="post" id="changePasswordForm">
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.querySelector('.file-upload');
        const avatarImg = document.querySelector('.avatar');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    avatarImg.src = reader.result;
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
